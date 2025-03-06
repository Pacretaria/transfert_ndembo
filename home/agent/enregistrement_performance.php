<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
 if($_SESSION['acces'] == 'agent'){

    $error_sub_form = null;

    $recuperation_competitions = $db->prepare('SELECT * FROM `competitions`');
    $recuperation_competitions->execute(array());

    if (isset($_GET['joueur'])) {
        
        $reference_joueur = htmlspecialchars($_GET['joueur']);

        $recuperation_joueur = $db->prepare('SELECT * FROM `jouers` WHERE (reference = ?)');
        $recuperation_joueur->execute(array($reference_joueur));
        $nbr_recuperation_joueur = $recuperation_joueur->rowCount();

        if ($nbr_recuperation_joueur === 1) {
            $donnees_joueur = $recuperation_joueur->fetch();
            
        } else {
            header('location:recherche.php');
        }
        
            
        $heure = date('H');
        $heure = $heure.date(':i');

        if (isset($_POST['bouton_envoi'])) {
            
            if (isset($_POST['nbr_matches'],$_POST['heure_jouer'],$_POST['passes_decisives'],$_POST['but'],$_POST['passes_reussis'],$_POST['recuperation_balles'],$_POST['note'])) {
                
                $nbr_matches = htmlspecialchars($_POST['nbr_matches']);
                $passes_decisives = htmlspecialchars($_POST['passes_decisives']);
                $minute_jouer = htmlspecialchars($_POST['heure_jouer']);
                $but = htmlspecialchars($_POST['but']);
                $passes_reussis = htmlspecialchars($_POST['passes_reussis']);
                $recuperation_balles = htmlspecialchars($_POST['recuperation_balles']);
                $note = htmlspecialchars($_POST['note']);
                    
                $reference = uniqid();

                $enregistrement_joueur = $db->prepare('INSERT INTO `performances`(`joueurs`, `nbr_matches`, `nbr_minute_jouer`, `nbr_passes_decisives`, `nbr_buts`, `nbr_passes_reussis`, `nbr_recuperation_balles`, `notes`, `date`, `references`)  VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $enregistrement_joueur->execute(array($donnees_joueur['reference'],$nbr_matches,$minute_jouer,$passes_decisives,$but,$passes_reussis,$recuperation_balles,$note,date('d/m/Y'),$reference));

                header('location:signal.php?message=enregistrement');
                

            } else {
                $error_sub_form = "*Remplissez tous les élements du Formulaire";
            }

        } else {
            $error_sub_form = "*Continuer";
        }
    }else {
        //header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enregistrement des Performances</title>
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

            <h1> Performances de  <strong><?php echo $donnees_joueur['prenom'].' '.$donnees_joueur['nom'] ?></strong></h1>

            <div id="conteneur">
                <div class="portion">

                    <div>
                        <label for="nbr_matches">Nombre des Matches</label>
                        <input type="number" name="nbr_matches" id="nbr_matches">
                    </div>

                    <div>
                        <label for="heure_jouer"> Minutes joués</label>
                        <input type="number" required name="heure_jouer" id="heure_jouer">
                    </div>

                    <div>
                        <label for="passes_decisives">Passes décisives</label>
                        <input type="number" required name="passes_decisives" id="passes_decisives">
                    </div>

                    <div>
                        <label for="buts"> Buts </label>
                        <input type="number" required name="but" id="but">
                    </div>

                    <div>
                        <label for="passes_reussis">Passes reussis</label>
                        <input type="text" required name="passes_reussis" id="passes_reussis">
                    </div>

                    <div>
                        <label for="recuperation_balles"> Recuperation des Balles</label>
                        <input type="number" required name="recuperation_balles" id="recuperation_balles">
                    </div>

                    <div>
                        <label for="note">Note du Match</label>
                        <input type="number"  required name="note" id="note">
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