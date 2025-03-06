<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    
    $error_sub_form = ' ';

    if(isset($_GET['ref'])){

        $reference = htmlspecialchars($_GET['ref']);

        $verification = $db->prepare('SELECT * FROM `utilisateurs` WHERE (reference = ?)');
        $verification->execute(array($reference));
        $nbr_ligne = $verification->rowCount();

        if ($nbr_ligne =! 1) {
            
            header('location:../');

        }
        
        $donnees_utilisateurs = $verification->fetch();

        if(isset($_POST['bouton_envoi'])){

            $categorie = htmlspecialchars($_POST['categorie']);

            $mise_jour = $db->prepare('UPDATE `jouers` SET `categorie`= ? WHERE (reference = ?)');
            $mise_jour->execute(array($categorie,$reference));

            if (isset($_FILES['fichier'])) {
                
                $dossier = "../media/";
                $check = getimagesize($_FILES['fichier']['tmp_name']);
                
                if($check ==! false){
                
                    $uploadirFile = $dossier . basename($_FILES['fichier']['name']);
                    
                    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadirFile)) {
                        
                        $mise_jour = $db->prepare('UPDATE `utilisateurs` SET `profil`= ? WHERE (reference = ?)');
                        $mise_jour->execute(array($_FILES['fichier']['name'],$reference));


                        $error_sub_form =" Succès !";

                        if ($error_sub_form === " Succès !") {

                            header('location:signal.php?message=modification');

                        }

                    } else {
                        $error_sub_form =" Echec de televersement !";
                    }
                }
                else {
                    $error_sub_form =" Choisissez une image svp !"; 
                }
            } else {
                $error_sub_form =" Recomencer !";
            }
        }
        
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Transfert Ndembo Succès</title>
                <style>
                    body{
                        background-color: #ddd5d8;
                        margin:0px;
                    }
                    #message{
                        background-color: white;
                        width:40%;
                        margin-top: 5%;
                        margin-left: 30%;
                        padding: 10px 15px;
                        border-radius:2px;
                        overflow: hidden;
                        padding:20px;
                    }
                    h1{
                        text-align:center;
                        font-family:arial black;
                        color: #d87d16;
                        font-size:20px;
                        margin-bottom: 30px;
                    }
                    .click{
                        text-decoration: none;
                        background-color: #ddd5d8;
                        padding: 15px;
                        color: #3f3f41;
                        transition-property: background-color;
                        transition-duration: 0.3s;
                        transition-delay: 0s;
                        display: block;
                        width: 40%;
                        text-align: center;
                        font-family: arial;
                    }
                    .click{
                        margin-left:26%;
                    }
                    .click:hover{
                        background-color: #d87d16;
                        color: white;
                    }

                    .portion{
                        width:90%;
                        margin-left:5%;
                    }
                    input{
                        height:40px;
                        width:95%;
                        margin: 2.5% 1.5%;
                        border:1px solid #caccce;
                        border-radius:3px;
                    }
                    select{
                        height:45px;
                        width:97%;
                        margin: 2.5% 1.5%;
                        border:1px solid #caccce;
                        border-radius:3px;
                    }
                    label{
                        margin-left:5px;
                        font-family: arial;
                        font-size: 14px;
                        font-weight: bold;
                        opacity:0.8;
                    }
                    #bouton_suivant{
                        display: block;
                        height:50px;
                        width:95%;
                        margin: 6% 1.5% 5% 1.5%;
                        background-color: #720817;
                        border-color: #720817;
                        border-radius:2px;
                        border:none;
                        border:3px solid #720817;
                        color:white;
                        font-size:19px;
                    }
                    #bouton_suivant:hover{
                        background-color: transparent;
                        color: #720817;
                    }
                    #redirection{
                        width:95%;
                        height:30px;
                        margin-bottom:25px;
                        margin-left: 1.5%;
                        background-color:#d87d16;
                        color:white;
                        border:none;
                        border:3px solid #d87d16;
                        border-radius:2px;
                        font-size:17px;
                        display: block;
                        text-align: center;
                        padding-top: 10px;
                        text-decoration: none;
                    }
                    #redirection:hover{
                        background-color: transparent;
                        color: #d87d16;
                    }
                    #conteneur{
                        display: flex;
                    }
                    .error{
                        color: red;
                        text-align: center;
                    }
                    @media screen and (max-width: 850px){
                        #message{
                            width: 70%;
                            margin-left:13%;
                        }
                        #bouton_suivant{
                            width:90%;
                        }
                    }
                    @media screen and (max-width: 500px){
                        #message{
                           width: 90%;
                           margin-left:2%;
                        }
                        .portion{
                           width:100%;
                           margin-left:0%;
                        }
                    }
                    @media screen and (max-width: 350px){
                        #message{
                            width: 90%;
                            margin-left:1%;
                        }
                        .portion{
                            width:100%;
                            margin-left:0%;
                        }
                    }
                </style>
            </head>
            <body>
                <div id="message">
                    <h1> Televerser un profil </h1>
                    <form id="form_enregistrement" action="?ref=<?php echo $reference?>" enctype="multipart/form-data" method="post">
                        <div class="portion">
                            <div>
                                <label for="fichier"> Profil </label>
                                <input type="file" name="fichier" required accept="image/" id="nom">
                            </div>

                            <div>
                                <p class="error"> <?php echo $error_sub_form; ?> </p>
                            </div>

                            <div>
                                <button name="bouton_envoi" id="bouton_suivant" >Enregistrer</button>
                            </div>

                            <div>
                                <a href="index.php" id="redirection"> Quitter </a>
                            </div>
                        </div>
                    </form>
                </div>
            </body>
            <script>
                //onload() = function(){
                    //setTimeOut("2000", window.reload());
                //};
            </script>
            </html>
            <?php
    }
    else {
        echo 'error1';
    }
}
else {
    echo 'veillez vous reconnecter !';
}