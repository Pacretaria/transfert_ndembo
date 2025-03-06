<?php
include('db.php');

    $ligne_trouver = null;

    $inviteur = null;
    $date = null;
    $heure = null;
    $date = null;
    $departement = null;

    if (isset($_GET['recherche'])) {
     $recherche = htmlspecialchars($_GET['recherche']);
 
         $recuperation = $db->prepare('SELECT * FROM `jouers` WHERE `nom` LIKE :recherche OR `prenom` LIKE :recherche OR `position` LIKE :recherche OR `club` LIKE :recherche');
         $recuperation->bindValue(':recherche',"%$recherche%");
         $recuperation->bindValue(':prenom',"%$recherche%");
         $recuperation->bindValue(':position',"%$recherche%");
         $recuperation->bindValue(':club',"%$recherche%");
         $recuperation->execute();
     
         $ligne_trouver = $recuperation->rowCount();
 
     }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Transfert Ndembo</title>
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
               width: 65%;
               margin-left:7.5%;
               background: transparent;
               color: white;
               height: 40px;
               border: none;
               border:1px solid #720817;
               border-radius: 4px;
          }
          #recherche button{
               width: 15%;
               height: 40px;
               border-radius: 4px;
               background: #720817;
               border: none;
               border:1px solid #720817;
               color: white;
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
     </style>

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


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
                    <a href="index.php" class="navbar-brand">TRANSFERT NDEMBO</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="home/joueur" class="smoothScroll">TN Lite</a></li>
                         <li><a href="index.php#top" class="smoothScroll">Acceuil</a></li>
                         <li><a href="index.php#about" class="smoothScroll">Apropos</a></li>
                         <li><a href="#team" class="smoothScroll">Joueurs</a></li>
                         <li><a href="index.php#testimonial" class="smoothScroll">Témoignages</a></li>
                         <li><a href="#contact" class="smoothScroll">Contact</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="recherche_precise.php"> Recherche Filtrer </a></li>
                    </ul>
               </div>

          </div>
     </section>

     <section id="recherche">
     <h3>Saisissez un mot clé</h3>
        <div id="recherche_precis">
        <div>
            <form action="" method="GET" id="form_search">
                <input type="text" name="recherche" required placeholder="Entrez un nom, poste ou une equipe " id="search" onclick="supprime()">
                <button>Go</button>
            </form>
        </div>
     </section>


     <?php
     if($ligne_trouver > 0){
     ?>
     <!-- JOUEURS -->
     <section id="team">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2> <?php echo $ligne_trouver ?> <small>Résultats trouvés pour</small> <span style="color:red;"><?php echo $recherche ?></span></h2>
                         </div>
                    </div>

                    <?php

                    while($donnes_joueurs = $recuperation->fetch()){
                              
                         $date_naissance = $donnes_joueurs['age'];
                         $date_info = date_parse($date_naissance);
                         $naissance = $date_info['year'];
                         $date_actuel = date('Y');
                         $age_joueur = $date_actuel - $naissance;
                    ?>
                    <div class="col-md-3 col-sm-6" style="margin-bottom: 40px;">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <img src="home/media/<?php echo $donnes_joueurs['profil'] ?>" class="img-responsive" style="height:120px;" alt="">
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
     <?php
     }
     else {   
     ?>
<section id="team">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2> <?php echo $ligne_trouver ?> <small>Résultats trouvés pour</small> <span style="color:red;"><?php echo $recherche ?></span></h2>
                         </div>
                    </div>

                    
               </div>
          </div>
     </section>
     <?php
     }
     ?>

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
                    
                                   <input type="email" class="form-control" placeholder="Addresse email " name="email" required="">

                                   <textarea class="form-control" rows="6" placeholder="Votre message" name="message" required=""></textarea>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="send" value="Envoyer">
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
                              <div class="section-title">
                                   <h2>Adresse</h2>
                              </div>
                              <address>
                                   <p>12 ème rue,<br> Limete industriel, Kinshasa</p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2024 Transfert Nembo</p>
                                   
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Contact</h2>
                              </div>
                              <address>
                                   <p>+65 2244 1100, +66 1800 1100</p>
                                   <p><a href="mailto:youremail.co">support@transfertndembo.com</a></p>
                              </address>

                              
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Enregistrer vous au Newsletter</h2>
                              </div>
                              <div>
                                   <div class="form-group">
                                        <form action="#" method="get">
                                             <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" required="">
                                             <input type="submit" class="form-control" name="submit" id="form-submit" value="Send me">
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>
                    
               </div>
          </div>
     </footer>


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>