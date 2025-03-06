<?php
include('../db.php');

$videos_joueurs = array();

$reference_meilleurs_joueurs = array();

$ref_joueur = null;

if (isset($_SESSION['reference'])) {
    $ref_joueur = $_SESSION['reference'];
}

if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'joueur'){

        $recuperation_jouers = $recuperation_jouers = $db->prepare('SELECT * FROM `jouers` WHERE (agent = ?) ORDER BY id DESC');
        $recuperation_jouers->execute(array($_SESSION['reference']));
        $nbr_jouers = $recuperation_jouers->rowCount();

        if ($nbr_jouers === 1) {
            
            $donnees_joueur = $recuperation_jouers->fetch();

            $ref_joueur = $donnees_joueur['reference'];

        }
    }
    else {

    }
}
else {
    
    $signal_user = "no_connexion";

}

        ?>
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Gestion des visiteurs</title>
                    <link rel="stylesheet" href="../css/style.css">
                    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
                    <style>
                        body{
                            background-color: #590524;
                            margin: 0px;
                            padding: 0px;
                            overflow: hidden;
                            font-weight: arial black, calibri;
                        }
                        #menu_logo{
                            background-color: #770327;
                            width: 100%;
                            height: 60px;
                            padding: 0px;
                            font-family:  arial black, calibri;
                            position: fixed;
                            left: 0px;
                            Top: 0px;
                            z-index: 1000;
                            display: flex;
                            color: white;
                        }
                        #menu_logo img{
                            width: 50px;
                            height: 45px;
                            border-radius: 50%;
                            margin: 7px 15px;
                        }
                        #menu_logo p{
                            font-weight: bold;
                            font-family: arial black, calibri;
                            padding-top: 2.5px;
                        }
                        #conteneur_videos{
                            width: 100%;
                        }
                        #conteneur_videos video{
                            width: 100%;
                            position: absolute;
                            top: 50%;
                            transform: translateY(-50%);
                            z-index: 5;
                        }
                        #bouton-jouer{
                            position: absolute;
                            top: 50%;
                            transform: translateY(-50%);
                            z-index: 10;
                            margin-left: 45%;
                            display: none;
                        }
                        #bouton-rejouer{
                            position: absolute;
                            top: 50%;
                            transform: translateY(-50%);
                            z-index: 10;
                            margin-left: 25%;
                            display: none;
                        }
                        #bouton-suivant{
                            position: absolute;
                            top: 50%;
                            transform: translateY(-50%);
                            z-index: 10;
                            margin-left: 65%;
                            display: none;
                        }

                    </style>
                </head>
                <body>
                    <div id="bloc_principal">
                        <div id="menu_logo">
                             <img src="../images/IMG-20240914-WA0083.jpg" alt="Logo">
                             <p>TRANSFERT NDEMBO</p>
                        </div>
                        <?php include('entete.php'); ?>
                    
                        <div id="conteneur_videos">
                            <video id="video_joueurs" src="" preload autoplay></video>
                            <div>
                                <img src="../logo/rejouer.png" alt="rejouer" id="bouton-rejouer">
                                <img src="../logo/bouton-jouer.png" alt="pause" id="bouton-jouer" >
                                <img src="../logo/suivant.png" alt="rejouer" id="bouton-suivant">
                            </div>
                        </div>
                    </div>
                    <script src="manipulation.js"></script>
                </body>
            </html>
        <?php