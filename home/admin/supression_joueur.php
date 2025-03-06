<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'],$_GET['joueur'])) {
    if($_SESSION['acces'] == 'admin'){

        $utilisateur = htmlspecialchars($_GET['joueur']);

        $recuperation_utilisteurs = $db->prepare('SELECT * FROM `pre_enregistrement` WHERE (reference = ?)');
        $recuperation_utilisteurs->execute(array($utilisateur));
        $ligne = $recuperation_utilisteurs->rowCount();
        
        if ($ligne == 1) {

            $donnees = $recuperation_utilisteurs->fetch();

            if (isset($_GET['confirmation']) AND !empty($_GET['confirmation'])) {
                if ($_GET['confirmation'] == 'oui') {
                    
                    $sauvegarde = $db->prepare('INSERT INTO `suppression_donnees_joueurs`(`nom`, `postnom`, `prenom`, `age`, `taille`, `position`, `club`, `pied`, `agent`, `sexe`, `prix`, `manager`, `contact`, `reference`, `date_enregistrement`, `heure_enregistrement`, `heure_suppression`, `date_suppression`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $sauvegarde->execute(array($donnees['nom'],$donnees['postnom'],$donnees['prenom'],$donnees['age'],$donnees['taille'],$donnees['position'],$donnees['club'],$donnees['pied'],$donnees['agent'],$donnees['sexe'],$donnees['prix'],$donnees['manager'],$donnees['contact'],$donnees['reference'],$donnees['date_enregistrement'],$donnees['heure_enregistrement'],date('d-m-Y'),date('h:i:s')));

                    $delete = $db->prepare('DELETE FROM `pre_enregistrement` WHERE (reference = ?)');
                    $delete->execute(array($utilisateur));

                    header('location:recherche.php');
                }
            }
            

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Suprimer <?php echo $donnees['nom'].' '.$donnees['prenom'] ?></title>
                <style>
                    body{
                        background-color: #ddd5d8;
                        margin:0px;
                    }
                    form{
                        background-color: white;
                        width:40%;
                        margin-top: 5%;
                        margin-left: 30%;
                        padding: 10px 15px;
                        border-radius:2px;
                        overflow: hidden;
                        padding:20px;
                    }
                    form h1{
                        text-align:center;
                        font-family:arial black;
                        color: #d87d16;
                        font-size:20px;
                        margin-bottom: 30px;
                    }
                    #popup{
                        
                        width:70%;
                        margin:0% 15%;
                        display: flex;
                        justify-content: space-around;
                    }
                    .click, .delete{
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
                        margin-left:5%;
                    }
                    .click:hover{
                        background-color: #d87d16;
                        color: white;
                    }
                    .delete:hover{
                        background-color: #720817;
                        color: white;
                    }
                </style>
            </head>
            <body>
                <form action="" post="">
                    <h1> Voulez vous suprimer <?php echo $donnees['nom'].' '.$donnees['prenom'].' ?' ?> </h1>
                    <div>
                        <input type="hidden" value="<?php echo $donnees['reference']?>">
                        <div id="popup">
                            <a href="?joueur=<?php echo $donnees['reference'] ?>&amp;confirmation=oui" class="delete"> Confirmer </a>
                            <a href="comptes.php" class="click"> Annuler </a>
                        </div>
                    </div>
                </form>
            </body>
            </html>
            <?php
        }
        else {
            echo '0 joueur trouvé !';
        }
    }
    else {
        echo 'error 2';
    }
}
else {
    echo 'error 1';
}