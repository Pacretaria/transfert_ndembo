<?php
include('db.php');
$error = null;
if (isset($_POST['bouton_envoi'])) {
	if (isset($_POST['prenom'],$_POST['passe'],$_POST['mail'])) {
		$prenom = strip_tags($_POST['prenom']);
        $mail = strip_tags($_POST['mail']);
		$passe = strip_tags($_POST['passe']);

		if (isset($prenom,$mail,$passe)) {

			$recuperation_d_utilisateur = $db->prepare('SELECT * FROM `utilisateurs` WHERE (mot_passe = ?) and (prenom = ?) and ((contact = ?) or (mail = ?))');
			$recuperation_d_utilisateur->execute(array($passe,$prenom,$mail,$mail));
			$nbr_ligne = $recuperation_d_utilisateur->rowCount();

			if ($nbr_ligne == 1) {
				
				$donnees = $recuperation_d_utilisateur->fetch();

                $_SESSION['nom'] = $donnees['nom'];
                $_SESSION['prenom'] = $donnees['prenom'];
                $_SESSION['mail'] = $donnees['mail'];
                $_SESSION['reference'] = $donnees['reference'];
                $_SESSION['profil'] = $donnees['profil'];

				switch ($donnees['acces']) {

					case 'reception':

						$_SESSION['acces'] = 'reception';
                        $_SESSION['departement'] = $donnees['departement'];
                        $_SESSION['fonction'] = $donnees['fonction'];

						header('location:reception/');
                        
						break;

					case 'Agent':

                            $_SESSION['acces'] = 'agent';

                            header('location:agent/');

						break;

                    case 'admin':

                        $_SESSION['acces'] = 'admin';
                        $_SESSION['departement'] = $donnees['departement'];
                        $_SESSION['fonction'] = $donnees['fonction'];

                        header('location:admin/');

						break;

                    case 'Analyste':

                        $_SESSION['acces'] = 'Analyste';
                        $_SESSION['departement'] = $donnees['departement'];
                        $_SESSION['fonction'] = $donnees['fonction'];

                        header('location:analyste/');

                        break;

                    case 'Comptable':

                        $_SESSION['acces'] = 'Comptable';
                        $_SESSION['fonction'] = $donnees['fonction'];
    
                        header('location:compte/');
    
                        break;
                    
                        case 'joueur':

                            $_SESSION['acces'] = 'joueur';
                            $_SESSION['fonction'] = $donnees['fonction'];
        
                            header('location:joueur/');
        
                            break;
					
					default:
                        $error = '*accès refusé !';
                        break;
				}
			}
            else{
                $error = "*ce compte n'existe pas !";
            }
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
        <title>Identifiez-vous !</title>
        <link rel="stylesheet" href="css/style_form.css">
        <link rel="icon" href="logo/logo.png" type="image/png">
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

            <h1> CONNEXION </h1>

            <div>
                
                <div>
                    <label for="prenom">Prénom </label>
                    <input type="text" name="prenom" id="prenom" required>
                </div>

                <div>
                    <label for="mail">Adresse Email </label>
                    <input type="text" name="mail" id="mail" required>
                </div>

                <div>
                    <label for="passe">Mot de passe</label>
                    <input type="password" name="passe" id="passe" required>
                    <button id="affiche_password"> <img src="logo/view-simple-815-svgrepo-com.svg" alt=""> </button>
                </div>
                
                <div>
                    <button name="bouton_envoi" id="bouton_envoi" type="submit">Se connecter</button>
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