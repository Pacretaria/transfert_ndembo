<?php
include('db.php');

        if (isset($_GET['joueur'])) {
            $reference = htmlspecialchars($_GET['joueur']);

            $recuperation_infos_joueur = $db->prepare('SELECT * FROM `jouers` WHERE (reference = ?)');
            $recuperation_infos_joueur->execute(array($reference));
            $lignes_trouver = $recuperation_infos_joueur->rowCount();

            if ($lignes_trouver == 1) {

                $recuperation_media_joueur = $db->prepare('SELECT * FROM `media` WHERE (reference_joueur = ?) AND (`type` = ?) ORDER BY id DESC LIMIT 5');
                $recuperation_media_joueur->execute(array($reference,'image'));
                $lignes_trouver_media = $recuperation_media_joueur->rowCount();

                $recuperation_media_joueur_video = $db->prepare('SELECT * FROM `media` WHERE (reference_joueur = ?) AND (`type` = ?) ORDER BY id DESC LIMIT 2');
                $recuperation_media_joueur_video->execute(array($reference,'video'));
                $lignes_trouver_media_video = $recuperation_media_joueur_video->rowCount();

                $recuperation_match_jouer = $db->prepare('SELECT SUM(nbr_matches) as `matches_jouer` FROM `performances` WHERE (joueurs = ?)');
                $recuperation_match_jouer->execute(array($reference));
                $lignes_trouver_performances = $recuperation_match_jouer->rowCount();
                $donnees_matches_jouer = $recuperation_match_jouer->fetch();

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

                $recuperation_vues = $db->prepare('SELECT * FROM `nombre_vues` WHERE (reference_jouers = ?)');
                $recuperation_vues->execute(array($reference));
                $nbr_vues = $recuperation_vues->rowCount();

                $donnees = $recuperation_infos_joueur->fetch();

                $date_naissance = $donnees['age'];
                $date_info = date_parse($date_naissance);
                $naissance = $date_info['year'];
                $date_actuel = date('Y');
                $age_joueur = $date_actuel - $naissance;
                
                $upladDir = '../media';

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
                        background-color: #d3d3d3;
                        margin: 0px;
                        padding: 0px;
                    }
                    #conteneur
                    {
                        background-color: #590524;
                        color: #ffff;
                        width: 40%;
                        margin:0% 30% 0 30%;
                        border-radius: 5px;
                        font: 16px helvetica,Nimbus Sans L,Arial;
                        padding-top: 2px;
                        padding-bottom: 25px;
                    }
                    #conteneur h3, #para1{
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
                    #conteneur h3{
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
                    
                    .conteneur_class_quatrieme video{
                        background-color: black;
                        width: 100%;
                        height: 250px;
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
                        background-image : URL("../admin/images/20240715_112602_0000.png");
                        background-repeat : no-repeat;
                        width:100%;
                        height: 300px;
                        z-index: 5;
                    }
                    #conteneur_profil{
                        background-color: #e98b04c2;
                        width:90%;
                        margin:-90px 5% 100px 5%;
                        z-index: 0;
                        border-radius : 5px;
                    }
                    #profil{
                        width:40%;
                        height: 140px;
                        margin: -75px 30% 30px 30%;
                        border-radius: 50%;
                        border: 4px solid #f5a623;
                    }
                    #nom_joueur{
                        margin: 0px 0% 20px 0%;
                        font-weight: bold;
                        color: white;
                        text-align: center;
                    }
                    #baniere_sous_profil{
                        display: flex;
                        justify-content: space-around;
                        width: 100%;
                    }
                    #baniere_sous_profil div p{
                        margin-top : -15px;
                        font-size: 30px;
                        text-align: center;
                    }
                    
                    @media screen and (max-width: 950px){
                        #conteneur{
                            width: 100%;
                            margin-left: 0%;
                        }
                        form{
                            width: 70%;
                            margin-left: 15%;
                        }
                    }
                    @media screen and (max-width: 450px){
                        #conteneur{
                            width: 100%;
                            margin-left: 0%;
                        }
                        form{
                            width: 90%;
                            margin-left: 5%;
                        }
                    }
                    @media screen and (max-width: 250px){
                        #conteneur{
                            width: 100%;
                        }
                        form{
                            width: 100%;
                        }
                    }
                </style>
            </head>
            <body>
                <div id="conteneur">
                    <div id="baniere_view">

                        <div id="couverture"> 
                            
                        </div>
                        <div id="conteneur_profil">

                            <img src="media/<?php echo $donnees['profil'] ?>" alt="profil" id="profil">
                            <p id="nom_joueur"> <?php echo $donnees['nom'].' '.$donnees['postnom'].' '.$donnees['prenom'] ?> </p>
                            
                            <div id="baniere_sous_profil">
                                <div>
                                    <h5>VUES</h5>
                                    <p> <?php echo $nbr_vues ?> </p>
                                </div>

                                <div>
                                    <h5>PHOTOS</h5>
                                    <p> <?php echo $lignes_trouver_media ?> </p>
                                </div>

                                <div>
                                    <h5>VIDEOS</h5>
                                    <p> <?php echo $lignes_trouver_media_video ?> </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="sous-conteneur">

                        <div class="portion">
                            <h3> INFORMATIONS PERTINENTES </h3>
                            <p> Age : <span> <?php echo $age_joueur ?> ans</span> </p>
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
                                case 'Ailier Droit':
                                    $image_position = "positionnement/aillier-droit.png";
                                    break;
                                case 'Ailier Gauche':
                                    $image_position = "positionnement/aillier-gauche.png";
                                    break;
                                case 'Gardien de But':
                                    $image_position = "positionnement/gardien-but.png";
                                    break;
                                default:
                                    $image_position = "erreur";
                                    break;
                              }
                            ?>
                            <img src="<?php echo $image_position ?>" alt="position_image" id="position_image">
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
                                               <div id="galery"> <img src="admin/<?php echo $donnees_media['fichier'] ?> " alt="media" onload="galerie(0)"> </div>
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
                                            <span> <?php echo $donnees_matches_jouer['matches_jouer'] ?> </span></p>
                                       
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
                                            <div> <video src="publications_videos/<?php echo $donnees_media_video['fichier'] ?>" controls></video></div>
                                        <?php
                                        }
                                    }
                                    ?>
                                </div>
                        </div>

                        
                        <div>
                            <a href="solicitation.php?joueur=<?php echo $donnees['reference'] ?>" id="redirection"> Soliciter </a>
                        </div>

                    </div>
                </div>

                
                <script>
                    function galerie(y){
                        var photos = [];
                            photos = <?php echo json_encode($photos_joueurs) ?>;
                            
                        var bloc_galery = document.querySelector("#galery img");
                            bloc_galery.src = photos[y];
                        
                    }
                </script>
            </body>
        </html>
        <?php 
            $ajout_vues = $db->prepare('INSERT INTO `nombre_vues`( `reference_jouers`, `nombre`) VALUES ( ?, ?)');
            $ajout_vues->execute(array($reference, 1));
            }
        }