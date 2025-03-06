<?php
include('../db.php');

    $error_sub_form = null;

    if (isset($_POST['bouton_envoi'])) {
        if (isset($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['acces'],$_POST['contact'],) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['acces']) AND !empty($_POST['contact']) ) {
            
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);
            $acces = htmlspecialchars($_POST['acces']);
            $contact = htmlspecialchars($_POST['contact']);
            
            $heure = date('H');
            $heure = $heure.date(':i');

            $verification_compte = $db->prepare('SELECT * FROM `utilisateurs` WHERE (mail = ?) and (prenom = ?)');
			$verification_compte->execute(array($mail,$prenom));

            $ligne_comptes = $verification_compte->rowCount();

            if ($ligne_comptes == 0) {
                
                $reference = uniqid();

                $enregistrement_client = $db->prepare('INSERT INTO `utilisateurs`(`nom`, `prenom`, `mail`, `mot_passe`, `acces`, `contact`, `reference`, `profil`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)');
                $enregistrement_client->execute(array($nom,$prenom,$mail,'000000',$acces,$contact,$reference,'user.jpg'));

                header('location:signal_compte.php?ref='.$reference);
                

            } else {
                $error_sub_form = "*Cette comptes existe déjà";
            }

        }
        else {
            $error_sub_form = "*veuillez remplir toutes les champs du formulaire";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscrivez-vous !</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
        <style>
            body{
                background-color: #ddd5d8;
            }
            form{
                background-color: white;
                width:60%;
                margin-left: 20%;
                padding: 10px 15px;
                border-radius:2px;
                overflow: hidden;
                padding-top:20px;
            }
            form h1{
                text-align:center;
                font-family:arial black;
                color: #d87d16;
                font-size:20px;
                margin-bottom: 30px;
            }
            .portion{
                width:100%;
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
                margin: 6% 1.5% 0% 1.5%;
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
            .error{
                color: red;
                text-align: center;
            }
            

            @media screen and (max-width: 850px){
                #form_enregistrement{
                    width: 70%;
                    margin-left:13%;
                }
                #bouton_suivant{
                    width:90%;
                }
            }
            @media screen and (max-width: 500px){
                #form_enregistrement{
                    width: 90%;
                    margin-left:2%;
                }
                .portion{
                    width:100%;
                    margin-left:0%;
                }
            }
            @media screen and (max-width: 350px){
                #form_enregistrement{
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
        <form action="" enctype="multi/form-data" method="post" id="form_enregistrement">

            <h1> NOUVEL COMPTE </h1>

            <div id="conteneur">
                <div class="portion">
                    <div>
                        <label for="nom"> Nom </label>
                        <input type="text" name="nom" id="nom">
                    </div>

                    <div>
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom">
                    </div>

                    <div>
                        <label for="mail"> Adresse Email</label>
                        <input type="mail" name="mail" id="mail">
                    </div>

                </div>


                <div class="portion">

                    <div>
                            <label for="fonction">Téléphone</label>
                            <input type="text" name="contact" id="contact">
                    </div>
                    

                    <div>
                        <button name="bouton_envoi" id="bouton_suivant" >Enregistrer</button>
                    </div>
                </div>
            </div>
                
            <div>
                <p class="error"> <?php echo $error_sub_form; ?> </p>
            </div>

            <div>
                <a href="index.php" id="redirection"> Quitter </a>
            </div>
        </form>
        <script>
            function menu(){
                document.getElementById("menu").style.marginLeft = "0%";
            }
        </script>
    </body>
</html>
<?php