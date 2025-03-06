<?php
include('db.php');

if(isset($_POST['send_form'])){
     if(isset($_POST['name'],$_POST['email'],$_POST['message'])){
          $name = htmlspecialchars($_POST['name']);
          $mail = htmlspecialchars($_POST['email']);
          $message = htmlspecialchars($_POST['message']);

          $sauvegarde_message = $db->prepare('INSERT INTO `contact`(`nom_complet`, `mail`, `message`, `reference`) VALUES ( ?, ?, ?, ?)');
          $sauvegarde_message->execute(array($name,$mail,$message,uniqid())); 

          $sauvegarde_message->closeCursor();
          
          header('location:index.php');
     }
}

$recuperation_infos_joueurs = $db->prepare('SELECT * FROM `jouers` ORDER BY id DESC LIMIT 30');
$recuperation_infos_joueurs->execute(array());
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Transfert test synapse Ndembo</title>
<!-- 

Known Template 

https://templatemo.com/tm-516-known

-->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="icon" href="home/logo/logo.png" type="image/png">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-style.css">
     <style>
          #recherche h3{
               margin-top:100px;
               margin-bottom:30px;
          }
          #recherche h3{
               text-align: center;
          }
          #recherche form{
               width: 90%;
               margin-left:5%;
          }
          #recherche input{
               width: 85%;
               margin-left:-1%;
               background: transparent;
               color: white;
               height: 50px;
               border: none;
               border:1px solid #720817;
               border-radius: 4px;
          }
          #recherche button{
               width: 15%;
               height: 50px;
               border-radius: 4px;
               background: #720817;
               border: none;
               border:1px solid #720817;
               color: white;
          }
          @media screen and (max-width: 999px){
               
               .prix_abonnement{
                    margin-top:0px;
               } 
          }
          @media screen and (max-width: 450px){
               #recherche form{
                    width:100%;
               }
               #recherche form input{
                    width:90%;
                    margin-left: 1%;
               }
               #recherche form button{
                    width:40%;
                    margin:15px 25%;
               }
               .prix_abonnement{
                    margin-top:-40px;
               } 
          }
          .prix_abonnement{
               width: 100%;
               height: 60px;
               background: #720817;
               color: white;
               text-align: center;
               padding-top: 15px;
               margin-bottom: 15px;
          }
          .prix_abonnement:hover{
               background: #f59a00;
          }
          .prix_abonnement p a{
               color: white;
          }
          @media screen and (max-width: 1000px){
               .prix_abonnement{
                    margin-top:-100px;
                    margin-bottom:15px;
               } 
          }
     </style>

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="#" class="navbar-brand">TRANSFERT NDEMBO</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="home/joueur" class="smoothScroll">TN Lite</a></li>
                         <li><a href="#top" class="smoothScroll">Acceuil</a></li>
                         <li><a href="#about" class="smoothScroll">Apropos</a></li>
                         <li><a href="#team" class="smoothScroll">Joueurs</a></li>
                         <li><a href="#testimonial" class="smoothScroll">Témoignages</a></li>
                         <li><a href="#contact" class="smoothScroll">Contact</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="recherche_precise.php"> Recherche Filtrer </a></li>
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home">
          <div class="row">

                    <div class="owl-carousel owl-theme home-slider">
                         <div class="item item-first">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12">
                                             <h1>Nous sommes</h1>
                                             <h3> 
                                                  Une solution unique pour le dépistage et
                                                  l’appariage des joueurs, clubs, jeunes talents et tout le personnel de
                                                  soutien.
                                             </h3>
                                             <h3>
                                                  Une plateforme hybride qui apporte le meilleur de deux mondes
                                                  : un réseau social professionnel & une place de marché qui permet à
                                                  toutes les entités du football de créer des liaisons et de se connecter.
                                             </h3>
                                             <a href="#contact" class="section-btn btn btn-default smoothScroll">Nous contacter</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="item item-second">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12">
                                             <h1>Prêt à faire décoller votre carrière ?</h1>
                                             <h3>Faites-vous repérer par les meilleurs clubs, recruteurs et gagnez divers contrats. Transfert Ndembo, c'est l'opportunité de multiplier vos chances de signer un contrat avec un club de renommée mondiale. </h3>

                                             <h3> Bénéficiez de la promotion et obtenez une visibilité maximale et d'un accompagnement personnalisé pour faire decoller votre carrière.</h3>
                                             <a href="#courses" class="section-btn btn btn-default smoothScroll">Nous contacter</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="item item-third">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12">
                                             <h1>En quête des talents pour sublimer votre équipe ?</h1>
                                             <h3>
                                                Notre base de données, constamment mise à jour, recense les meilleurs profils du moment. Notre vivier de talents, riche de milliers de profils exceptionnels, vous offre un accès privilégié à des joueurs sur-mesure.
                                             </h3>
                                             <a href="recherche_precise.php" class="section-btn btn btn-default smoothScroll"> Rechercher </a>
                                        </div>
                                   </div>
                              </div>
                         </div>

                        
                    </div>

                    
          </div>
     </section>

     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <div class="about-info">
                              <h2>Qui sommes nous ?</h2>

                              <figure>
                                   <figcaption>
                                        <p>
                                             Nous sommes une plateforme qui offre aux joueurs, agents, clubs, académies, personnel
                                             et supporters une exposition et une promotion professionnelles, une
                                             image de marque et un positionnement, une base de données de
                                             haute qualité, un système de recherche et de filtrage, l'accessibilité et
                                             la disponibilité de contenus et de connaissances professionnelles, ainsi
                                             qu’un réseau social professionnel unique dans le domaine du football. <br>
                                        </p>
                                        </p>
                                             Nous sommes un point de rencontre pour toutes les
                                             entités du football. Nous permettons une forte implication entre les
                                             différentes entités afin d'établir des relations et des liens. Une
                                             plateforme de distribution et de publicité qui intégre des outils
                                             technologiques permettant de mesurer et d'évaluer les capacités de
                                             performance en temps réel.
                                        </p>
                                   </figcaption>
                              </figure>

                         </div>
                    </div>

                    <div class="col-md-offset-1 col-md-4 col-sm-12">
                         <div class="entry-form">
                              <form action="home/login.php" method="POST">
                                   <h2>Connecte Toi</h2>
                                   <input type="text" name="prenom" class="form-control" placeholder="Prenom" required="">

                                   <input type="text" name="mail" class="form-control" placeholder="Adresse Email ou Numéro de Télephone" required="">

                                   <input type="password" name="passe" class="form-control" placeholder="Mot de passe" required="">

                                   <button class="submit-btn form-control" name="bouton_envoi" id="form-submit">Connexion</button>
                              </form>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- FEATURE -->

     <section id="feature">
          <div class="container">
               <div class="row">
                    <h3 style="text-align: center;margin-bottom: 80px;">FORMULES D'ABONNEMENT</h3>

                    <div class="col-md-4 col-sm-4">
                              
                         <a href="home/candidature.php?formule=standard"><img src="images/standard_abonnement.jpg" style="margin-bottom: 50px;border:15px;" width="100%" alt="photo"></a>
                         
                    </div>

                    <div class="col-md-4 col-sm-4">

                         <a href="home/candidature.php?formule=avancee"><img src="images/abonnement_avancee.jpg" style="margin-bottom: 50px;border:15px;" width="100%" alt="photo"></a>

                    </div>

                    <div class="col-md-4 col-sm-4">

                         <a href="home/candidature.php?formule=premium"><img src="images/abonnement_premium.jpg" style="margin-bottom: 50px;border:15px;" width="100%" alt="photo"></a>

                    </div>

                    <div class="col-md-4 col-sm-4">
                         
                         <a href="home/candidature.php?formule=vip"><img src="images/abonnement_vip.jpg" style="margin-bottom: 50px;border:15px;" width="100%" alt="photo"></a>

                    </div>
               </div>
          </div>
     </section>


     <!-- TEAM -->
     <section id="team">
          <div class="container">
               
               <form action="recherche.php">
                    <div id="recherche">
                         <h3>Rechercher ou defiler</h3>
                         <input type="text" name="recherche"style="color: black;" placeholder="ecrivez un poste, club, nationnalité ou un nom">
                         <button>Go</button>
                    </div>
               </form>
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                               
                         </div>
                    </div>

                    <?php

                    while($donnes_joueurs = $recuperation_infos_joueurs->fetch()){
                              
                         $date_naissance = $donnes_joueurs['age'];
                         $date_info = date_parse($date_naissance);
                         $naissance = $date_info['year'];
                         $date_actuel = date('Y');
                         $age_joueur = $date_actuel - $naissance;
                    ?>
                    <div class="col-md-3 col-sm-6" style="margin-bottom: 40px;">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <img src="home/media/<?php echo $donnes_joueurs['profil'] ?>" class="img-responsive" style="height:200px;" alt="">
                              </div>
                              <div class="team-info">
                                   <h3 style="font-size:15px;"><?php echo $donnes_joueurs['prenom']." ".$donnes_joueurs['nom'] ?></h3>
                                   <span style="font-size:12px;"><?php echo $age_joueur ?> ans</span><br>
                                   <span style="font-size:12px;"><?php echo $donnes_joueurs['position'] ?></span><br>
                              </div>
                              <ul class="social-icon">
                                   <a href="home/voir_profil_joueur.php?joueur=<?php echo $donnes_joueurs['reference'] ?>" style="text-align:center;"> Voir plus </a>
                              </ul>
                         </div>
                    </div>
                    <?php
                    }
                    ?>
                    

               </div>
          </div>
     </section>

     <!-- TESTIMONIAL -->
     <section id="testimonial">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2>Témoignages</h2>
                         </div>

                         <div class="owl-carousel owl-theme owl-client">
                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="images/tst-image1.jpg" class="img-responsive" alt="">

                                        </div>
                                        <div class="tst-author">
                                             <h4>Jackson</h4>
                                             <span>FC SANGA BALENDE</span>
                                        </div>
                                        <p> Grâce à la promotion de transfert ndembo j'ai pû être recrûter, merci beaucoups pour votre travail !</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="images/tst-image3.jpg" class="img-responsive" alt="">
                                        </div>
                                        <div class="tst-author">
                                             <h4>Basilua</h4>
                                             <span>Sporting club de kenya</span>
                                        </div>
                                        <p>Mon passage à transfert ndembo m'a ouvert beaucoups des opportunitées jusqu'à être solicité à l'etrager, je vous l'encourage vivement.</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="images/tst-image4.jpg" class="img-responsive" alt="">
                                        </div>
                                        <div class="tst-author">
                                             <h4>Onesim</h4>
                                             <span>VClub de kinshasa</span>
                                        </div>
                                        <p>Vraiment je vous remercie pour la façon dont vous avez fait ma promotion, que le bon Dieu vous benissent.</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                         </div>

               </div>
          </div>
     </section> 


     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Nous Contacter </h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" placeholder="Ecrivez votre nom complet" name="name" required="">
                    
                                   <input type="email" class="form-control" placeholder="Addresse email" name="email" required="">

                                   <textarea class="form-control" rows="6" placeholder="Votre message" name="message" required=""></textarea>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="send_form" value="Envoyer">
                              </div>

                         </form>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="contact-image">
                              <img src="images/QUI SOMMES-NOUS2.jpg" class="img-responsive" alt="Smiling Two Girls">
                         </div>
                    </div>

               </div>
          </div>
     </section>       


     <!-- FOOTER -->
     <footer id="footer">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <address>
                                   <h3 style="color:white;"> Adresse </h3>
                                   <p> Kinshasa/ boulevard triomphal après la muséee national à l'immeuble royal.   </p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="https://web.facebook.com/profile.php?id=100089079046652" target="_blank" class="fa fa-facebook-square" attr="facebook icon"> </a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2024 Transfert Ndembo</p>
                                   
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Contact</h2>
                                   <p></p>
                              </div>
                              <address>
                                   <p>+243 83 730 271(whatsapp et appels)</p>
                                   <p><a href="support@transfertndembo.com">support@transfertndembo.com</a></p>
                              </address>

                              
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Newsletter</h2>
                              </div>
                              <div>
                                   <div class="form-group">
                                        <form action="#" method="get">
                                             <input type="email" class="form-control" placeholder="Entrer votre email" name="email" id="email" required="">
                                             <input type="submit" class="form-control" name="submit" id="form-submit" value="Envoyer">
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>
                    
               </div>
          </div>
     </footer>


     <!-- SCRIPTS -->

     <script>
          if ('serviceWorker' in navigator) {
               window.addEventListener('load', () => {
               navigator.serviceWorker
                    .register('/service-worker.js')
                    .then(reg => console.log('Service Worker: Registered'))
                    .catch(err => console.log(`Service Worker: Error: ${err}`));
               });
          }
     </script>

     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>