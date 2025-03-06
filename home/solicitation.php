<?php
include('db.php');
$error = null;

if (isset($_GET['joueur'])) {
    $reference = htmlspecialchars($_GET['joueur']);

    $recuperation_infos_joueur = $db->prepare('SELECT * FROM `jouers` WHERE (reference = ?)');
    $recuperation_infos_joueur->execute(array($reference));
    $lignes_trouver = $recuperation_infos_joueur->rowCount();

    if ($lignes_trouver === 1) {
        $donnees_joueurs = $recuperation_infos_joueur->fetch();
    }
    else {
        header('location:index.php');
    }
}
else {
    header('location:index.php');
}
if (isset($_POST['bouton_envoi'])) {
	if (isset($_POST['identite'],$_POST['contact'],$_POST['message'])) {
		$identite = strip_tags($_POST['identite']);
        $contact = strip_tags($_POST['contact']);
		$message = htmlspecialchars($_POST['message']);

		if (isset($identite,$contact,$message)) {

			$recuperation_d_utilisateur = $db->prepare('INSERT INTO `solicitation`(`noms_negociateur`, `contact_negociateur`, `message`, `joueur`, `reference_joueur`) VALUES (?, ?, ?, ?, ?)');
			$recuperation_d_utilisateur->execute(array($identite,$contact,$message,$donnees_joueurs['nom'].' '.$donnees_joueurs['prenom'],$donnees_joueurs['reference']));
            
            //header('location:index.php');
		}
        else {
            echo $error = "*remplissez tous les champs";
        }
	}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Soliciter </title>
        <link rel="stylesheet" href="css/style_form.css">
        <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
        <style>
            body{
                background-color : #ddd5d8;
                font-family: Arial, Helvetica, sans-serif;
            }
            form{
                background-color: white;
                width:30%;
                margin-left: 35%;
                margin-top: 5%;
                padding: 10px 15px;
                border-radius:2px;
            }
            form h1{
                text-align:center;
                font-family:arial black;
                color: #d87d16;
                font-size:18px;
            }
            form div div{
                margin:10px 0px;
            }
            input{
                height:40px;
                width:95%;
                margin: 2.5% 1.5%;
                border:1px solid #caccce;
                border-radius:3px;
            }
            textarea{
                height:90px;
                width:95%;
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
            #bouton_envoi{
                height:50px;
                width:95%;
                margin: 2.5% 1.5%;
                background-color: #720817;
                border-color: #720817;
                border-radius:2px;
                border:none;
                border:3px solid #720817;
                color:white;
                font-size:19px;
            }
            #bouton_envoi:hover{
                background-color: transparent;
                color: #720817;
            }
            #bouton_annuler{
                height:50px;
                width:95%;
                margin: 2.5% 1.5%;
                background-color: #d87d16;
                border-color: #d87d16;
                border-radius:2px;
                border:none;
                border:3px solid #d87d16;
                color:white;
                font-size:19px;
            }
            #bouton_annuler:hover{
                background-color: transparent;
                color: #d87d16;
            }
            .error{
                color: red;
                text-align: center;
            }


            @media screen and (max-width: 1000px){
                form{
                    width:35%;
                    margin-left: 32.5%;
                    margin-top: 8%;
                }
            }

            @media screen and (max-width: 900px){
                form{
                    width:80%;
                    margin-left: 8%;
                    margin-top: 8%;
                }        
            }
            
            @media screen and (max-width: 300px){
                form{
                    width:98%;
                    margin-left: -2%;
                    margin-top: 8%;
                }   
            }

            @media screen and (max-width: 500px){
                #logo_ndembo{
                    position: absolute;
                    left: 11%;
                    top: 4%;
                    width:18%;
                    height: 13%;
                }        
            }

            @media screen and (max-width: 400px){
                #logo_ndembo{
                    position: absolute;
                    left: 14%;
                    top: 4%;
                    width:18%;
                    height: 15%;
                }        
            }

            @media screen and (max-width: 300px){
                #logo_ndembo{
                    position: absolute;
                    left: 22%;
                    top: 4%;
                    width:18%;
                    height: 17%;
                }        
            }

            @media screen and (max-width: 200px){
                #logo_ndembo{
                    position: absolute;
                    left: 25%;
                    top: 4%;
                    width:18%;
                    height: 17%;
                }    
                form{
                    width:95%;
                    margin-left: -2%;
                    margin-top: 10%;
                }     
            }

            #passe{
                width: 75%;
            }
            #affiche_password{
                width: 15%;
                height: 45px;
                border: none;
                background: transparent;
            }
            form div button img{
                width: 75%;
            }
        </style>
    </head>
    <body>
        <form action="" method="post">

            <h1> Vous soliciter  <?php echo $donnees_joueurs['prenom'].' '.$donnees_joueurs['nom'] ?></h1>

            <div>
                
                <div>
                    <input type="text" name="identite" id="identite" placeholder="Ecrivez votre nom complet" required>
                </div>

                <div>
                    <input type="text" name="contact" id="contact" placeholder="Ecrivez votre votre mail ou numéro de téléphone" required>
                </div>

                <div>
                    <textarea name="message" placeholder="Ecrivez votre message  ici" cols="30" rows="10"></textarea>
                </div>
                
                <div>
                    <button name="bouton_envoi" id="bouton_envoi" type="submit">Envoyer</button>
                    <p class="error"> <?php echo $error; ?> </p>
                </div>
            </div>
        </form>

        <script>
            var champ = document.querySelector('input[type="password"]');
            var bouton = document.getElementById("affiche_password");

            bouton.addEventListener("click", function (e) {
                e.preventDefault();
                if(champ.type === "password"){
                    champ.type = "text";
                }
                else{
                    champ.type = "password";
                }
            })


        </script>
    </body>
</html>