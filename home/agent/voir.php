<?php
include('../db.php');

if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'agent'){
        if (isset($_GET['joueur'])) {
            $reference = htmlspecialchars($_GET['joueur']);

            $recuperation_infos_joueur = $db->prepare('SELECT * FROM `jouers` WHERE (reference = ?)');
            $recuperation_infos_joueur->execute(array($reference));
            $lignes_trouver = $recuperation_infos_joueur->rowCount();

            if ($lignes_trouver == 1) {
                
                $donnees = $recuperation_infos_joueur->fetch();

                $reference = $donnees['reference'];

                $recuperation_media_joueur = $db->prepare('SELECT * FROM `media` WHERE (reference_joueur = ?) AND (`type` = ?) ORDER BY id DESC LIMIT 5');
                $recuperation_media_joueur->execute(array($reference,'image'));
                $lignes_trouver_media = $recuperation_media_joueur->rowCount();

                $recuperation_media_joueur_video = $db->prepare('SELECT * FROM `media` WHERE (reference_joueur = ?) AND (`type` = ?) ORDER BY id DESC LIMIT 2');
                $recuperation_media_joueur_video->execute(array($reference,'video'));
                $lignes_trouver_media_video = $recuperation_media_joueur_video->rowCount();

                $recuperation_match_jouer = $db->prepare('SELECT * FROM `performances` WHERE (joueurs = ?)');
                $recuperation_match_jouer->execute(array($reference));
                $lignes_trouver_performances = $recuperation_match_jouer->rowCount();

                $recuperation_minute_jouer = $db->prepare('SELECT SUM(nbr_minute_jouer) as `minute` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_minute_jouer->execute(array($reference));
                $lignes_trouver_performances_minute = $recuperation_minute_jouer->rowCount();
                $donnees_minute = $recuperation_minute_jouer->fetch();

                $recuperation_passes_decisives = $db->prepare('SELECT SUM(nbr_passes_decisives) as `passes_decisives` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_passes_decisives->execute(array($reference));
                $lignes_trouver_passes_decisives = $recuperation_passes_decisives->rowCount();
                $donnees_passes_decisives = $recuperation_passes_decisives->fetch();

                $recuperation_buts = $db->prepare('SELECT SUM(nbr_buts) as `buts` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_buts->execute(array($reference));
                $lignes_trouver_buts = $recuperation_buts->rowCount();
                $donnees_buts = $recuperation_buts->fetch();

                $recuperation_passes = $db->prepare('SELECT SUM(nbr_passes_reussis) as `passes_reussis` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_passes->execute(array($reference));
                $lignes_trouver_passes = $recuperation_passes->rowCount();
                $donnees_passes = $recuperation_passes->fetch();

                $recuperation_duos = $db->prepare('SELECT SUM(nbr_recuperation_balles) as `nbr_recuperation_balles` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_duos->execute(array($reference));
                $lignes_trouver_passes = $recuperation_duos->rowCount();
                $donnees_duos = $recuperation_duos->fetch();
                
                $recuperation_notes = $db->prepare('SELECT SUM(notes) as `note` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_notes->execute(array($reference));
                $lignes_trouver_notes = $recuperation_notes->rowCount();
                $donnees_notes = $recuperation_notes->fetch();
                
                $upladDir = '../media';


                if (isset($_FILES['fichiers']['name'][0]) && !empty($_FILES['fichiers']['name'][0])) {
                    
                    foreach ($_FILES['fichiers']['tmp_name'] as $key => $tmp_name) {
                        $fileName = $_FILES['fichiers']['name'][$key];
                        $filePath = '../media' . $fileName;
                        $extension_infos = pathinfo($fileName);
                        $extension_autoriser_images =  array("png","PNG","jpg","JPG","jpeg","JPEG");

                        if (in_array($extension_infos['extension'], $extension_autoriser_images)) {
                           
                            if (move_uploaded_file($tmp_name, $fileName)) {
                            
                                $sauvegarde = $db->prepare('INSERT INTO `media`(`reference_joueur`, `fichier`, `type`,`reference_fichier`) VALUES (?, ?, ?, ?)');
                                $sauvegarde->execute(array($reference,$fileName,'image',uniqid()));
                            
                            } else {
                                echo 'recomence';
                            }

                        }
                        
                    }

                }
                if (isset($_POST['video']) && !empty($_POST['video'])) {
                    
                    $video = $_POST['video'];
                    $sauvegarde = $db->prepare('INSERT INTO `media`(`reference_joueur`, `fichier`, `type`,`reference_fichier`) VALUES (?, ?, ?, ?)');
                    $sauvegarde->execute(array($reference,$video,'video',uniqid()));
                    
                }
        ?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Transfert ndembo</title>
                <style>
                    body{
                        background-color: #ddd5d8;
                        margin: 0px;
                        padding: 0px;
                    }
                    #conteneur
                    {
                        background-color: #e7b67b;
                        color: #ffff;
                        width: 40%;
                        margin:0% 30% 0 30%;
                        border-radius: 5px;
                        font: 16px helvetica,Nimbus Sans L,Arial;
                        padding-top: 2px;
                        padding-bottom: 25px;
                    }
                    h3, #para1{
                        text-align: center;
                        font-weight: bold;
                    }
                    .portion{
                        background-color: #e98b04;
                        width: 90%;
                        margin-left: 2.5%;
                        margin-top: -70px;
                        margin-bottom: 70px;
                        padding: 10px;
                    }
                    .portion p{
                        color: black;
                    }
                    h3{
                        background-color: #770327;
                        color: white;
                        padding: 10px;
                        margin-top: -10px;
                        margin-left: -10px;
                        margin-right: -10px;
                        margin-bottom: 20px;
                        font-size: 15px;
                    }
                    #position_image{
                        width: 70%;
                        height: 200px;
                        margin-left: 15%;
                    }
                    #position_class_secondaire{
                        width: 90%;
                        margin-left: 2.5%;
                        margin-top: -45px;
                        margin-bottom: 70px;
                    }
                    .portion p {
                        color: white;
                        font-weight : bold;
                    }
                    .portion p span{
                        float: right;
                        font-size: 15px;
                        color: white;
                    }
                    #position_class_troisieme{
                        margin-top: -40px;
                    }
                    .conteneur_class_troisieme{
                        display: flex;
                        flex-wrap: wrap;
                        vertical-align: top;
                        width: 100%;
                    }
                    .conteneur_class_troisieme div{
                        width: 33%;
                    }
                    .conteneur_class_troisieme div img{
                        width: 95%;
                        height: 150px;
                        margin-left: 15px;
                        border-radius: 2px;
                    }
                    #position_class_quatrieme{
                        margin-top: -35px;
                    }
                    .conteneur_class_quatrieme{
                        width: 100%;
                    }
                    
                    .conteneur_class_quatrieme iframe{
                        width: 100%;
                        height: 250px;
                        margin-left: 10px;
                    }

                    
                    #position_class_cinquieme{
                        margin-top: -35px;
                    }
                    .position_class_cinquieme{
                        width: 100%;
                    }
                    #envoi{
                        width:90%;
                        height:45px;
                        margin-top:10px;
                        margin-bottom:20px;
                        margin-left: 5%;
                        background-color:#f5a623;
                        color:white;
                        border:none;
                        border:1.5px solid #f5a623;
                        border-radius:2px;
                        font-size:15px;
                    }
                    #envoi:hover{
                        background-color: transparent;
                        color: #f5a623;
                        border:3px solid #f5a623;
                    }
                    #redirection{
                        width:90%;
                        height:30px;
                        margin-bottom:25px;
                        margin-left: 5%;
                        background-color:#f5a623;
                        color:white;
                        border:none;
                        border:1.5px solid #f5a623;
                        border-radius:2px;
                        font-size:17px;
                        display: block;
                        text-align: center;
                        padding-top: 10px;
                        text-decoration: none;
                    }
                    #redirection:hover{
                        background-color: transparent;
                        color: #f5a623;
                        border:3px solid #f5a623;
                    }

                    #baniere_view{
                        width:100%;
                    }
                    #couverture{
                        width:100%;
                        height: 200px;
                    }
                    #profil{
                        width:35%;
                        margin: -85px 20px 150px 20px;
                        border-radius: 5%;
                        border: 4px solid #f5a623;
                    }
                    #nom_joueur{
                        width:55%;
                        margin: -200px 5% 150px 45%;
                        font-weight: bold;
                        color: black;
                    }

                            
                    form{
                        background-color: white;
                        width:35%;
                        margin-left: 31.5%;
                        margin-top: 5%;
                        margin-bottom: 70px;
                        padding: 10px 15px;
                        border-radius:2px;
                        font-family: arial black;
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
                    @media screen and (max-width: 950px){
                        #conteneur{
                            width: 70%;
                            margin-left: 15%;
                        }
                        form{
                            width: 70%;
                            margin-left: 15%;
                        }
                    }
                    @media screen and (max-width: 450px){
                        #conteneur{
                            width: 90%;
                            margin-left: 5%;
                        }
                        form{
                            width: 90%;
                            margin-left: 5%;
                        }
                    }
                </style>
            </head>
            <body>
            <div id="conteneur">
                    <div id="baniere_view">
                        <img src="../admin/images/20240715_112602_0000.png" alt="couverture" id="couverture">
                        <img src="../media/<?php echo $donnees['profil'] ?>" alt="profil" id="profil">
                        <p id="nom_joueur"> <?php echo $donnees['nom'].' '.$donnees['postnom'].' '.$donnees['prenom'] ?> </p>
                    </div>

                    <div class="sous-conteneur">

                        <div class="portion">
                            <h3> INFORMATIONS PERTINENTES </h3>
                            <p> Age : <span> <?php echo $donnees['age'] ?> </span> </p>
                            <p> Pied : <span> <?php echo $donnees['pied'] ?></span> </p>
                            <p> Taille : <span> <?php echo $donnees['taille'] ?> </span></p>
                            <p> Club : <span> <?php echo $donnees['club'] ?></span> </p>  
                            <p> Valeur Marchande: <span> <?php echo $donnees['prix'].' $' ?></span> </p>  
                        </div>

                        <div class="portion" id="position_class_secondaire">
                            <h3> POSITIONNEMENT </h3>
                            <h4 style="text-align:center;">  <?php echo $donnees['position'] ?> </h4>
                            <?php
                              $position = $donnees['position'];
                              $image_position = null;
                              switch ($position) {

                                case 'Défenseur central':
                                    $image_position = "positionnement/defenceur_central.png";
                                    break;
                                case 'Latéral Droit':
                                    $image_position = "positionnement/lateral-droit.png";
                                    break;
                                case 'Latéral Gauche':
                                    $image_position = "positionnement/lateral-gauche.png";
                                    break;
                                case 'Milieu Défensif':
                                    $image_position = "positionnement/millieu-defensif.png";
                                    break;
                                case 'Avant-Centre':
                                    $image_position = "positionnement/millieu-defensif.png";
                                    break;
                                case 'Milieu Central':
                                    $image_position = "positionnement/millieu-central.png";
                                    break;
                                case 'Milieur Offensif':
                                    $image_position = "positionnement/millieu_offensif.png";
                                    break;
                                case 'Attaquant de Pointe':
                                    $image_position = "positionnement/Attaquant-de-Pointe.png";
                                    break;
                                case 'Aillier Droit':
                                    $image_position = "positionnement/aillier-droit.png";
                                    break;
                                case 'Aillier Gauche':
                                    $image_position = "positionnement/aillier-gauche.png";
                                    break;
                                default:
                                    $image_position = "erreur";
                                    break;
                              }
                            ?>
                            <img src="../<?php echo $image_position ?>" alt="position_image" id="position_image">
                        </div>

                        <div class="portion" id="position_class_troisieme">
                            <h3> PHOTOS </h3>
                                <div class="conteneur_class_troisieme">
                                    <?php 
                                    if ($lignes_trouver_media > 0) {
                                        $i = 0;
                                        $photos_joueurs = array();

                                        while($donnees_media = $recuperation_media_joueur->fetch()){
                                            
                                            $photos_joueurs[$i] = "admin/". $donnees_media['fichier'];
                                            $i++;

                                            ?>
                                               <div id="galery"> <img src="../admin/<?php echo $donnees_media['fichier'] ?> " alt="media" onload="galerie(0)"> </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                        </div>

                        <div class="portion" id="position_class_cinquieme">
                            <h3> PERFORMANCES </h3>
                                <div class="conteneur_class_quatrieme">
                                    <table>
                                        <div>
                                            <p> Matches : 
                                            <span> <?php echo $lignes_trouver_performances ?> </span></p>
                                       
                                            <p> Minutes Joué :
                                            <span> <?php echo $donnees_minute['minute'] ?>'</span> </p>
                                        
                                            <p> Passes décives :
                                            <span> <?php echo $donnees_passes_decisives['passes_decisives'] ?> </span></p>
                                       
                                            <p> Buts :
                                            <span> <?php echo $donnees_buts['buts'] ?> </span></p>
                                            
                                            <p> Passes Réussis :
                                            <span>  <?php echo $donnees_passes['passes_reussis'] ?> </span>  </p>
                                        
                                            <p> Duos Gagné :
                                            <span> <?php echo $donnees_duos['nbr_recuperation_balles'] ?></span>  </p>
                                        
                                            <p> Notes :
                                            <span> <?php echo $donnees_notes['note'] ?> </p>
                                        </div>
                                    </table>
                                </div>
                        </div>

                        <div class="portion" id="position_class_quatrieme">
                            <h3> VIDEOS </h3>
                                <div class="conteneur_class_quatrieme">
                                    <?php 
                                    if ($lignes_trouver_media_video > 0) {
                                        while($donnees_media_video = $recuperation_media_joueur_video->fetch()){
                                        ?>
                                            <div> <?php echo $donnees_media_video['fichier'] ?> </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>
                        </div>

                        <div id="bouton_print">
                             <a href="modifier_joueur.php?joueur=<?php echo $donnees['reference'] ?>" id="redirection"> Modifier </a>
                             <a href="supression_joueur.php?joueur=<?php echo $donnees['reference'] ?>" id="redirection"> Supprimer </a>
                             <a href="index.php" id="redirection"> Quiter </a>
                        </div>

                    </div>
                </div>
                    

                <div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <h1>PUBLIER VOS MEDIAS</h1>
                            <label for="">Choisissez des Photos</label>
                            <input type="file" name="fichiers[]" multiple id="">
                        </div>

                        <div>
                            <label for="">Ecrivez l'adresse d'une Vidéo</label>
                            <textarea name="video" id=""></textarea>
                        </div>

                        <div>
                            <button name="bouton_envoi" id="bouton_envoi" type="submit">Enregistrer</button>
                            <p class="error">  </p>
                        </div>
                    </form>
                </div>
                <script>
                    function imprimer(){
                        document.getElementById("bouton_print").style.display = "none";
                        document.body.style.margin = "0%";
                        document.getElementById("conteneur").style.width = "100%";
                        document.getElementById("conteneur").style.margin = "0%";
                        print();
                    }
                </script>
            </body>
        </html>
        <?php 
            }
        }
    }
    
}