<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'admin'){

        $error = null;
        $nom = null;
        $rensponsable = null;

        if (isset($_POST['bouton_envoi'])) {
            if (isset($_POST['nom'],$_POST['rensponsable']) AND !empty($_POST['nom'])) {
                
                $nom = strip_tags($_POST['nom']);
                $rensponsable = strip_tags($_POST['rensponsable']);
                $reference = uniqid();

                $nouvelle_departement = $db->prepare('INSERT INTO `departement` (`nom` , `rensponsable`, reference) VALUES (?, ?, ?)');
                $nouvelle_departement->execute(array($nom,$rensponsable,$reference));     

                header('location:signal.php?message=enregistrement');
            }
            else {
                echo $error = "*remplissez tous les champs";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Créer une nouvelle departement </title>
        <link rel="stylesheet" href="css/style_form.css">
        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
        <style>
            body{
                background-color : #ddd5d8;
                font-family: Arial, Helvetica, sans-serif;
                margin:0%;
            }
            form{
                background-color: white;
                width:40%;
                margin-left: 30%;
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
            form #new_departement div{
                margin:10px 0px;
            }
            #new_departement input{
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
                width:96.5%;
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
            .error{
                color: red;
                text-align: center;
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
        </style>
    </head>
    <body>
        <form action="" method="post">

            <h1> Nouvelle departement </h1>

            <div id="new_departement">
                
                <div>
                    <label for="nom">Nom du departement  </label>
                    <input type="text" name="nom" id="nom" value="<?php echo $nom ?>" required>
                </div>

                <div>
                    <label for="rensponsable">Nom rensponsable </label>
                    <input type="text" name="rensponsable" id="rensponsable" value="<?php echo $rensponsable ?>" required>
                </div>
                
                <div>
                    <button name="bouton_envoi" id="bouton_envoi" type="submit">Enregistrer</button>
                    <p class="error"> <?php echo $error; ?> </p>
                </div>

                <div>
                    <a href="index.php" id="redirection"> Quitter </a>
                </div>
            </div>
        </form>
    </body>
</html>
<?php
    }
}