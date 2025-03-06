<?php
session_start();

if (isset($_SESSION['reference'])) {
    
    $connexion = 'succes';
}
else {

    $connexion = 'faled';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
                
        #connexion{
            background-color: #f3efeffd;
            width: 50%;
            position: relative;
            left:25%;
            top: -700px;
            z-index: 9;
            border:1px solid #720817;
            border-radius: 5px;
            display: none;
        }
        #connexion input{
            width: 80%;
            height:45px;
            margin:4% 10% 1% 10%;
            border:1px solid #f59a00;
            border-radius: 3px;
            text-align: center;
            background-color: #f1e3ca;
            color: #ffff;
        }
        #connexion h3{
            text-align: center;
            color: #f59a00;
            padding-top: 25px;
        }
        #connexion div button{
            width: 80%;
            height:45px;
            margin:4% 10% 10% 10%;
            border:1px solid #720817;
            border-radius: 3px;
            text-align: center;
            background-color: #720817;
            color: #ffff;
            font-weight: bold;
        }
        #aide_connexion{
            text-align: center;
            font-size: 14px;
            color: red;
            margin-bottom: -10px;
        }

        #conteneur
        {
            background-color: #f3efeffd;
            color: #ffff;
            width: 40%;
            margin:0% 30% 0 30%;
            border-radius: 5px;
            font: 16px helvetica,Nimbus Sans L,Arial;
            padding-top: 2px;
            padding-bottom: 25px;
            z-index: 100;
            position: relative;
            top: -800px;
            display: none;
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
    <div id="bloc_central">
        <section>
            
            <header>
                <div id="conteneur_logo">
                    <H1>NDEMBO BET</H1>
                </div>

                <nav>
                    <ul>
                        <li>Accueil</li>
                        <li>Programme</li>
                        <li>Score</li>
                        <li>Bonus</li>
                        <li>Affiliation</li>
                        <li>Historique</li>
                        <li id="me" onclick="gestion_menu_me('<?php echo $connexion ?>')">Moi</li>
                    </ul>
                </nav>
            </header>
        </section>

        <section id="corps">
            <div id="banniere_promotionnelle">
                <img src="images/Ajouter un titre.png" alt="#pub">
                <h1>PARIEZ MAINTENANT <span><br> Et Obtenez 200% de bonus</span></h1>
                <div class="slogan_baniere_promotionnelle">
                    <h3> GAGNEZ COMME JAMAIS ! </h3>
                </div>
            </div>

            <div id="programme_matchs">
                <h3>PROGRAMME DES MATCHS </h3>

                <div id="conteneur_programme">
                    
                        <h6>Jeudi 11 mai 2025</h6>
                        <div onclick="redirection('aze', '<?php echo $connexion ?>')"> 
                            <p> <img src="images/250284384_571383630544661_235066971897245249_n.jpg"  class="logo_club" id="logo_club_a" alt="" >  <p class="club"> TP Mazembe</p> </p>
                            <p style="font-weight: bold;"  class="club">-</p>  
                            <p> <p class="club"> Vita club</p> <img src="images/380668734_292205596900647_8429867390819398102_n.jpg" class="logo_club" alt=""> </p>
                        </div>

                        <div> 
                            <p> <img src="images/272745618_139555921858588_354362304696257477_n.jpg"  class="logo_club"  id="logo_club_a" alt="" >  <p class="club"> S.T Lupopo </p> </p>
                            <p style="font-weight: bold;"  class="club">-</p>  
                            <p> <p class="club"> OC Rennaissance</p> <img src="images/379305627_750658243738078_2608647880343559917_n.jpg" class="logo_club" alt=""> </p>
                        </div>

                        <div> 
                            <p> <img src="images/447410999_122121304382284333_133451227238136360_n.jpg"  class="logo_club"  id="logo_club_a" alt="" >  <p class="club">Les Aigles du Co</p> </p>
                            <p style="font-weight: bold;"  class="club">-</p>  
                            <p> <p class="club"> DCMP</p> <img src="images/302462528_773882820601127_8714572731412094856_n.png" class="logo_club" alt=""> </p>
                        </div>


                        <h6>Vendredi 12 mai 2025</h6>
                        <div> 
                            <p> <img src="images/250284384_571383630544661_235066971897245249_n.jpg"  class="logo_club" id="logo_club_a" alt="" >  <p class="club"> TP Mazembe</p> </p>
                            <p style="font-weight: bold;"  class="club">-</p>  
                            <p> <p class="club"> Vita club</p> <img src="images/380668734_292205596900647_8429867390819398102_n.jpg" class="logo_club" alt=""> </p>
                        </div>

                        <div> 
                            <p> <img src="images/272745618_139555921858588_354362304696257477_n.jpg"  class="logo_club"  id="logo_club_a" alt="" >  <p class="club"> S.T Lupopo </p> </p>
                            <p style="font-weight: bold;"  class="club">-</p>  
                            <p> <p class="club"> OC Rennaissance</p> <img src="images/379305627_750658243738078_2608647880343559917_n.jpg" class="logo_club" alt=""> </p>
                        </div>

                        <div> 
                            <p> <img src="images/447410999_122121304382284333_133451227238136360_n.jpg"  class="logo_club"  id="logo_club_a" alt="" >  <p class="club">Les Aigles du Co</p> </p>
                            <p style="font-weight: bold;"  class="club">-</p>  
                            <p> <p class="club"> DCMP</p> <img src="images/302462528_773882820601127_8714572731412094856_n.png" class="logo_club" alt=""> </p>
                        </div>
                    
                </div>
            </div>
        </section>

        <section>
            <form action="" method="post" id="connexion">
                <h3> Connectez-vous </h3>

                <div>
                    <input type="tel" name="telephone" id="telephone" placeholder="Numéro de Téléphone">
                </div>

                <div>
                    <input type="password" name="mot_passe" id="mot_passe" placeholder="Mot de Passe">
                </div>

                <div>
                    <p id="aide_connexion"> </p>
                    <button type="submit" name="boutton_send"> Se Connecter </button>
                </div>
            </form>
        </section>

        <section id="info_users">
        <div id="conteneur">
            <div id="baniere_view">

                <div id="couverture"> 
                    
                </div>
                <div id="conteneur_profil">

                    <img src="../home/media/<?php echo $_SESSION['profil'] ?>" alt="profil" id="profil">
                    <p id="nom_joueur"> <?php echo $_SESSION['nom'].' '.$_SESSION['prenom'] ?> </p>
                    
                    <div id="baniere_sous_profil">
                        <div>
                            <h5>SOLDES</h5>
                            <p> 0 </p>
                        </div>

                        <div>
                            <h5>COUPONS</h5>
                            <p> 1 </p>
                        </div>

                        <div>
                            <h5>BONUS</h5>
                            <p> 5% </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="sous-conteneur">

                <div class="portion">
                    <h3> VOS COUPONS </h3>
                    <p> Match : <span>  Tp Mazembe vs As Vita</span> </p>
                    <p> H.M : <span>  </span> </p>
                    <p> M.B : <span>   </span></p>
                    <p> M.M : <span>  </span> </p>  
                    <p> M.D: <span>  </span> </p>
                    <p> M.A : <span>  </span> </p>  
                    <p> M.G: <span>  </span> </p>  
                </div>

                <div class="portion" id="position_class_secondaire">
                    <h3> H </h3>
                    <h4 style="text-align:center;">   </h4>
                    
                    <img src="" alt="position_image" id="position_image">
                </div>

                
                
                <div>
                    <a href="solicitation.php?joueur=<?php echo $donnees['reference'] ?>" id="redirection"> Soliciter </a>
                </div>

            </div>
        </div>
        </section>

        <section>
            <h3></h3>
        </section>
    </div>

    <script src="js/redirection_paris.js"></script>
    <script>
        window.onload = function () {
            
        }
            
    </script>
</body>
</html>