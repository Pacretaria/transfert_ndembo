<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
 if($_SESSION['acces'] == 'admin'){

    if (isset($_GET['reference'])) {
        
        $reference = htmlspecialchars($_GET['reference']);

        $recuperation_infos_joueur = $db->prepare('SELECT * FROM `jouers` WHERE (reference = ?)');
        $recuperation_infos_joueur->execute(array($reference));
        $lignes_trouver = $recuperation_infos_joueur->rowCount();

        if ($lignes_trouver == 1) {
            
            $donnees = $recuperation_infos_joueur->fetch();

        }
        
    } else {
        header('location:index.php');
    }

    $error_sub_form = null;

    if (isset($_GET['bouton_envoi'])) {
        if (isset($_GET['nom'],$_GET['postnom'],$_GET['prenom'],$_GET['age'],$_GET['taille'],$_GET['position'],$_GET['club']) AND !empty($_GET['nom']) AND !empty($_GET['prenom']) AND !empty($_GET['postnom']) AND !empty($_GET['age']) AND !empty($_GET['taille']) ) {
            
            $nom = htmlspecialchars($_GET['nom']);
            $postnom = htmlspecialchars($_GET['postnom']);
            $prenom = htmlspecialchars($_GET['prenom']);
            $age = htmlspecialchars($_GET['age']);
            $taille = htmlspecialchars($_GET['taille']);
            $position = htmlspecialchars($_GET['position']);
            $club = htmlspecialchars($_GET['club']);
            
            $heure = date('H');
            $heure = $heure.date(':i');

            if (isset($_POST['bouton_envoi'])) {
                
                if (isset($_POST['pied'],$_POST['sexe'],$_POST['manager'],$_POST['contact'])) {
                    
                    $pied = htmlspecialchars($_POST['pied']);
                    $sexe = htmlspecialchars($_POST['sexe']);
                    $manager = htmlspecialchars($_POST['manager']);
                    $contact = htmlspecialchars($_POST['contact']);

                    $verification = $db->prepare('SELECT * FROM `jouers` WHERE (reference = ?)');
			        $verification->execute(array($reference));
                    
                    $nbr_verification = $verification->rowCount();

                    if ($nbr_verification == 1) {
                        
                        $enregistrement_jouer = $db->prepare('UPDATE `jouers` SET `nom`=?,`postnom`=?,`prenom`=?,`age`=?,`taille`=?,`position`=?,`club`=?,`pied`=?,`agent`=?,`sexe`=?,`prix`=?,`manager`=?,`contact`=?,`date_enregistrement`=?,`heure_enregistrement`=? WHERE (reference = ?)');
                        $enregistrement_jouer->execute(array($nom,$postnom,$prenom,$age,$taille,$position,$club,$pied,$donnees['agent'],$sexe,' ',$manager,$contact,date('Y-m-d'),$heure,$reference));

                        header('location:modification_profil.php?ref='.$reference);

                    } else {
                        echo 'bleme';
                        echo $nbr_verification;
                    }
                    

                } else {
                    $error_sub_form = "*recommencer une erreur se produite";
                }

            } else {
                $error_sub_form = "*Continuer";
            }

        }
        else {
            $error_sub_form = "*veuillez remplir toutes les champs du formulaire";
        }
    }else {
        //header('location:index.php');
        echo 'bleme 00';
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enregistrement des clients</title>
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
                width:85%;
                height:30px;
                margin-bottom:25px;
                margin-left: 6.5%;
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
            }
            @media screen and (max-width: 500px){
                #form_enregistrement{
                    width: 80%;
                    margin-left:7%;
                }
            }
            @media screen and (max-width: 350px){
                #form_enregistrement{
                    width: 90%;
                    margin-left:1%;
                }
            }
        </style>
    </head>
    <body>
        <form action="" method="post" id="form_enregistrement">

            <h1> (Etape 1) </h1>

            <div id="conteneur">
                <div class="portion">

                    <div>
                        <label for="pied"> Pied </label>
                        <select name="pied" required id="pied">
                            <option value="<?php echo $donnees['pied'] ?>"><?php echo $donnees['pied'] ?></option>
                            <option value="Droit">Droit</option>
                            <option value="Gauche">Gauche</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="sexe"> Sexe </label>
                        <select name="sexe" required id="sexe">
                            <option value="<?php echo $donnees['sexe'] ?>"><?php echo $donnees['sexe'] ?></option>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>

                    <div>
                        <label for="manager">Manager</label>
                        <input type="text" required required name="manager" id="manager" value="<?php echo $donnees['manager'] ?>">
                    </div>

                    <div>
                        <label for="contact"> Téléphone</label>
                        <input type="text" required required name="contact" id="contact" value="<?php echo $donnees['contact'] ?>">
                    </div>

                </div>


                <div class="portion">

                    <div>
                        <button name="bouton_envoi" id="bouton_suivant" >Suivant</button>
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
    }
    else {
        header('location:../');
    }
}
else {
    header('location:../');
}