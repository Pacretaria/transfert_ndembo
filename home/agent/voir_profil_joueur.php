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

                $recuperation_media_joueur = $db->prepare('SELECT * FROM `media` WHERE (reference_joueur = ?) AND (`type` = ?) ORDER BY id DESC LIMIT 5');
                $recuperation_media_joueur->execute(array($reference,'image'));
                $lignes_trouver_media = $recuperation_media_joueur->rowCount();

                $recuperation_media_joueur_video = $db->prepare('SELECT * FROM `media` WHERE (reference_joueur = ?) AND (`type` = ?) ORDER BY id DESC LIMIT 2');
                $recuperation_media_joueur_video->execute(array($reference,'video'));
                $lignes_trouver_media_video = $recuperation_media_joueur_video->rowCount();
                
                $donnees = $recuperation_infos_joueur->fetch();
                
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
                        background-color: #ddd5d8;
                        margin: 0px;
                        padding: 0px;
                    }
                    #conteneur
                    {
                        background-color: #770327;
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
                        width: 95%;
                        margin-left: 0%;
                        margin-top: -70px;
                        margin-bottom: 70px;
                    }
                    .portion p{
                        margin-left: 20px;
                    }
                    #position_image{
                        width: 70%;
                        height: 200px;
                        margin-left: 15%;
                    }
                    #position_class_secondaire{
                        width: 95%;
                        margin-left: 2.5%;
                        margin-top: -45px;
                        margin-bottom: 70px;
                    }
                    span{
                        color: black;
                    }
                    .portion p span{
                        float: right;
                        font-size: 15px;
                        color: #f5a623;
                    }
                    #position_class_troisieme{
                        margin-top: -40px;
                    }
                    .conteneur_class_troisieme{
                        display: flex;
                        vertical-align: top;
                        width: 100%;
                    }
                    .conteneur_class_troisieme div{
                        width: 20%;
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
                        background-color:#007bff;
                        color:white;
                        border:none;
                        border:1.5px solid #007bff;
                        border-radius:2px;
                        font-size:17px;
                        display: block;
                        text-align: center;
                        padding-top: 10px;
                        text-decoration: none;
                    }
                    #redirection:hover{
                        background-color: transparent;
                        color: #007bff;
                        border:3px solid #007bff;
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
                        border-radius: 50%;
                        border: 4px solid #f5a623;
                    }
                    #nom_joueur{
                        width:55%;
                        margin: -200px 5% 150px 45%;
                        font-weight: bold;
                        color: #f5a623;
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

                    @media screen and (max-width: 1050px){
                        #conteneur{
                            margin-left: 20%;
                            margin-top: 2%;
                            width:60%;
                        }      
                    }
                    @media screen and (max-width: 950px){
                        #conteneur{
                            margin-left: 20%;
                            margin-top: 2%;
                            width:60%;
                        }      
                    }
                    @media screen and (max-width: 850px){
                        #conteneur{
                            margin-left: 20%;
                            margin-top: 2%;
                            width:60%;
                        }      
                    }
                    @media screen and (max-width: 750px){
                        #conteneur{
                            margin-left: 20%;
                            margin-top: 2%;
                            width:60%;
                        }      
                    }
                    @media screen and (max-width: 600px){
                        #conteneur{
                            margin-left: 15%;
                            margin-top: 2%;
                            width:70%;
                        }      
                    }
                    @media screen and (max-width: 500px){
                        #conteneur{
                            margin-left: 13.5%;
                            margin-top: 2%;
                            width:75%;
                        }      
                    }
                    @media screen and (max-width: 550px){
                        #conteneur{
                            margin-left: 7.5%;
                            margin-top: 2%;
                            width:85%;
                        }      
                    }
                    @media screen and (max-width: 450px){
                        #conteneur{
                            margin-left: 2.5%;
                            margin-top: 2%;
                            width:95%;
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
                    <h3 style="color: #f5a623;">  </h3>

                    <div id="sous-conteneur">

                        <div class="portion">
                            <h3> INFORMATIONS PERTINENTES </h3>
                            <p> Age : <span> <?php echo $donnees['age'] ?> </span> </p>
                            <p> Position : <span> <?php echo $donnees['position'] ?></span> </p>
                            <p> Pied : <span> <?php echo $donnees['pied'] ?></span> </p>
                            <p> Taille : <span> <?php echo $donnees['taille'] ?> </span></p>
                            <p> Club : <span> <?php echo $donnees['club'] ?></span> </p>  
                            <p> Valeur Marchande: <span> <?php echo $donnees['prix'].' $' ?></span> </p>  
                        </div>

                        <div class="portion" id="position_class_secondaire">
                            <h3> POSITIONNEMENT </h3>
                            <img src="../logo/1720886260709.jpg" alt="position_image" id="position_image">
                        </div>

                        <div class="portion" id="position_class_troisieme">
                            <h3> PHOTOS </h3>
                                <div class="conteneur_class_troisieme">
                                    <?php 
                                    if ($lignes_trouver_media > 0) {
                                        while($donnees_media = $recuperation_media_joueur->fetch()){
                                        ?>
                                            <div> <a href="../admin/<?php echo $donnees_media['fichier'] ?>" target="_black"> <img src="../admin/<?php echo $donnees_media['fichier'] ?>" alt="media"> </a> </div>
                                        <?php
                                        }
                                    }
                                    ?>
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

                    </div>
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