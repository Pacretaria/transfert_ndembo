<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    
    $error_sub_form = ' ';

    if(isset($_GET['ref']) && !empty($_GET['ref'])){

        $reference = htmlspecialchars($_GET['ref']);

        $verification = $db->prepare('SELECT * FROM `utilisateurs` WHERE (reference = ?)');
        $verification->execute(array($reference));
        $nbr_ligne = $verification->rowCount();

        if ($nbr_ligne =! 1) {
            
            header('location:../');

        }
        
        $donnees_utilisateurs = $verification->fetch();

        if(isset($_POST['bouton_envoi'])){

            $legende = htmlspecialchars($_POST['legende']);

            if (isset($_FILES['fichier'])) {
                
                $dossier_images = "../media/";
                $dossier_videos = "../publications_videos/";
                $check = getimagesize($_FILES['fichier']['tmp_name']);

                $extension_utiliser_image = ['JPG','jpg','JPEG','jpeg','PNG','png'];
                $extension_utiliser_video = ['MP4','mp4','AVI','avi','MOV','mov'];

                $extension_fichier = strtolower(pathinfo($_FILES['fichier']['name'],PATHINFO_EXTENSION));
                
                
                    if(in_array($extension_fichier, $extension_utiliser_image)){

                        $signal = "desactivé";

                        $uploadirFile = $dossier_images . basename($_FILES['fichier']['name']);

                        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadirFile)) {
    
                            $error_sub_form =" Succès !";
    
                            if ($error_sub_form === " Succès !") {
    
                                $sauvegarde = $db->prepare('INSERT INTO `media`(`reference_joueur`, `fichier`, `type`,`reference_fichier`,`legende`) VALUES (?, ?, ?, ?, ?)');
                                $sauvegarde->execute(array($reference,$_FILES['fichier']['name'],'image',uniqid(),$legende));

                               // header('location:enregistrement_performance.php?joueur='.$reference);
    
                            }
    
                        } else {
                            $error_sub_form =" Echec de televersement !";
                        }
                    }else {

                        $signal = "desactivé";
                        $error_sub_form = " *Choisissez une image ! ";
                    }

                    //Upload video

                    if(in_array($extension_fichier, $extension_utiliser_video)){

                        $uploadirFile = $dossier_videos . basename($_FILES['fichier']['name']);

                        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadirFile)) {
                        
                            $error_sub_form =" Succès !";
    
                            if ($error_sub_form === " Succès !") {

                                $sauvegarde = $db->prepare('INSERT INTO `media`(`reference_joueur`, `fichier`, `type`,`reference_fichier`,`legende`) VALUES (?, ?, ?, ?, ?)');
                                $sauvegarde->execute(array($reference,$_FILES['fichier']['name'],'video',uniqid(),$legende));
    
                               // header('location:enregistrement_performance.php?joueur='.$reference);
    
                            }
    
                        } else {
                            $error_sub_form =" Echec de televersement !";
                        }
                    }else {
                        if (isset($signal) AND ($signal === "desactivé")) {
                            # code...
                        } else {
                            $error_sub_form = " *Choisissez une vidéo ! ";
                        }
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
                    textarea{
                        height:80px;
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
                        width:100%;
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
                    <h1> Publication </h1>
                    <form id="form_enregistrement" action="?ref=<?php echo $reference?>" enctype="multipart/form-data" method="post">
                        <div class="portion">
                            <div>
                                <label for="fichier"> Choisissez un Média </label>
                                <input type="file" name="fichier" required id="nom">
                            </div>

                            <div>
                                <label for="legende"> Légende </label>
                                <textarea name="legende" id="legende" placeholder="Ecrivez quelque chose..."></textarea>
                            </div>

                            <div>
                                <p class="error"> <?php echo $error_sub_form; ?> </p>
                            </div>

                            <div>
                                <button name="bouton_envoi" id="bouton_suivant" >Publier</button>
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
    echo header('location:login.php');
}