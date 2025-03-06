<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
 if($_SESSION['acces'] == 'admin'){

    $recuperation_departement = $db->prepare('SELECT * FROM `departement`');
    $recuperation_departement->execute(array());

    $error_sub_form = null;

    if (isset($_POST['bouton_envoi'])) {
        if (isset($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['acces'],$_POST['departement'],$_POST['fonction']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['acces']) AND !empty($_POST['departement']) AND !empty($_POST['fonction'])) {
            
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $mail = htmlspecialchars($_POST['mail']);
            $acces = htmlspecialchars($_POST['acces']);
            $departement = htmlspecialchars($_POST['departement']);
            $fonction = htmlspecialchars($_POST['fonction']);
            
            $heure = date('H');
            $heure = $heure.date(':i');

            $verification_compte = $db->prepare('SELECT * FROM `utilisateur` WHERE (mail = ?) and (prenom = ?)');
			$verification_compte->execute(array($mail,$prenom));

            $ligne_comptes = $verification_compte->rowCount();

            if ($ligne_comptes == 0) {

                $recuperation_departement = $db->prepare('SELECT * FROM `departement` WHERE (reference = ?)');
                $recuperation_departement->execute(array($departement));
                $donnees = $recuperation_departement->fetch();
                
                $enregistrement_client = $db->prepare('INSERT INTO `utilisateur`(`nom`, `prenom`, `mail`, `mot_passe`, `acces`, `departement`, `reference_departement`, `fonction`, `reference`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $enregistrement_client->execute(array($nom,$prenom,$mail,'000000',$acces,$donnees['nom'],$donnees['reference'],$fonction,uniqid()));

                header('location:signal_compte.php?message=enregistrement');

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
                width:50%;
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
                margin: 2.5% 1.5%;
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
        </style>
    </head>
    <body>
        <form action="" method="post">

            <h1> Nouvel utilisateur </h1>

            <div id="conteneur">
                <div class="portion">
                    <div>
                        <label for="nom"> Nom </label>
                        <input type="text" name="nom" id="nom">
                    </div>

                    <div>
                        <label for="prenom">Prenom</label>
                        <input type="tel" name="prenom" id="prenom">
                    </div>

                    <div>
                        <label for="mail"> Adresse email</label>
                        <input type="mail" name="mail" id="mail">
                    </div>

                </div>


                <div class="portion"">
                    
                    <div>
                        <label for="acces"> Rôle </label>
                        <select name="acces" id="acces">
                            <option value="admin">Administrateur</option>
                            <option value="personnel">Personnel</option>
                            <option value="reception">Receptionniste grande porte</option>
                            <option value="salle attente">Receptionniste salle d'attente</option>
                        </select>
                    </div>

                    <div>
                        <label for="departement">Departement</label>
                        <select name="departement" id="departement">
                            <?php while($donnees = $recuperation_departement->fetch()){ ?>
                            <option value="<?php echo $donnees['reference']; ?>"><?php echo $donnees['nom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div>
                        <label for="fonction">Fonction</label>
                        <input type="text" name="fonction" id="fonction">
                    </div>
                </div>
            </div>
                
            <div>
                <button name="bouton_envoi" id="bouton_suivant" >Enregistrer</button>
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