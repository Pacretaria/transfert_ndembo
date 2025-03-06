<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'],$_GET['departement'])) {
    if($_SESSION['acces'] == 'admin'){

        $departement = htmlspecialchars($_GET['departement']);

        $recuperation_departement = $db->prepare('SELECT * FROM `departement` WHERE (reference = ?)');
        $recuperation_departement->execute(array($departement));
        $ligne = $recuperation_departement->rowCount();
        
        if ($ligne == 1) {

            if (isset($_GET['confirmation']) AND !empty($_GET['confirmation'])) {
                if ($_GET['confirmation'] == 'oui') {
                    
                    $delete = $db->prepare('DELETE FROM `departement` WHERE (reference = ?)');
                    $delete->execute(array($departement));

                    header('location:index.php');
                }
            }
            
            $donnees = $recuperation_departement->fetch();

            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Suprimer <?php echo $donnees['nom'] ?></title>
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
                    <h1> Voulez vous suprimer <?php echo $donnees['nom'] ?> </h1>
                    <div>
                        <input type="hidden" value="<?php echo $donnees['reference']?>">
                        <div id="popup">
                            <a href="?departement=<?php echo $donnees['reference'] ?>&amp;confirmation=oui" class="delete"> Confirmer </a>
                            <a href="index.php" class="click"> Annuler </a>
                        </div>
                    </div>
                </form>
            </body>
            </html>
            <?php
        }
    }
}