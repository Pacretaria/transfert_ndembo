<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'],$_GET['jouer'])) {
    if($_SESSION['acces'] == 'admin'){

        $jouer = htmlspecialchars($_GET['jouer']);

        $recuperation_jouer = $db->prepare('SELECT * FROM `pre_enregistrement` WHERE (reference = ?)');
        $recuperation_jouer->execute(array($jouer));
        $ligne = $recuperation_jouer->rowCount();
        
        $donnees = $recuperation_jouer->fetch();

        if ($ligne == 1) {

            if (isset($_GET['confirmation']) AND !empty($_GET['confirmation'])) {
                if ($_GET['confirmation'] == 'oui') {
                    
                    $nom = $donnees['nom'];
                    $postnom = $donnees['postnom'];
                    $prenom = $donnees['prenom'];
                    $age = $donnees['age'];
                    $taille = $donnees['taille'];
                    $position = $donnees['position'];
                    $club = $donnees['club'];
                    $pied = $donnees['pied'];
                    $agent = $donnees['agent'];
                    $sexe = $donnees['sexe'];
                    $prix = $donnees['prix'];
                    $manager = $donnees['manager'];
                    $contact = $donnees['contact'];
                    $reference = $donnees['reference'];
                    $agent = $donnees['agent'];
                    $date_enregistrement = $donnees['date_enregistrement'];
                    $heure_enregistrement = $donnees['heure_enregistrement'];
                    $profil = $donnees['profil'];

                    $enregistrement_jouer = $db->prepare('INSERT INTO `jouers`(`nom`, `postnom`, `prenom`, `age`, `taille`, `position`, `club`, `pied`, `agent`, `sexe`, `prix`, `manager`, `contact`, `reference`, `date_enregistrement`, `heure_enregistrement`, `profil`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                    $enregistrement_jouer->execute(array($nom,$postnom,$prenom,$age,$taille,$position,$club,$pied,$agent,$sexe,$prix,$manager,$contact,$reference,$date_enregistrement,$heure_enregistrement,$profil));

                    $delete = $db->prepare('DELETE FROM `pre_enregistrement` WHERE (reference = ?)');
                    $delete->execute(array($jouer));

                    header('location:index.php');
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
                    <h1> Voulez vous confirmer l'enregistrement de <?php echo $donnees['nom'].' '.$donnees['prenom'].' ?' ?> </h1>
                    <div>
                        <input type="hidden" value="<?php echo $donnees['reference']?>">
                        <div id="popup">
                            <a href="?jouer=<?php echo $donnees['reference'] ?>&amp;confirmation=oui" class="delete"> Confirmer </a>
                            <a href="comptes.php" class="click"> Annuler </a>
                        </div>
                    </div>
                </form>
            </body>
            </html>
            <?php
        }
        else {
            echo 'error 1';
        }
    }
    else {
        echo 'error 2';
    }
}
else {
    echo 'error 3';
}