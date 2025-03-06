<?php
include('db.php');

    $ligne_trouver = null;

    $inviteur = null;
    $date = null;
    $heure = null;
    $date = null;
    $departement = null;

    if(isset($_POST['sexe'],$_POST['pied'],$_POST['position'],$_POST['age'],$_POST['age_maximum'])){
        
        $sexe = strip_tags($_POST['sexe']);
        $pied = strip_tags($_POST['pied']);
        $age = strip_tags($_POST['age']);
        $position = strip_tags($_POST['position']);
        $age_maximum = strip_tags($_POST['age_maximum']);

        $query = "SELECT * FROM jouers WHERE 1";

        if (!empty($sexe)) {
            
            $query .= " AND sexe = '$sexe'";

        }
        if (!empty($pied)) {
            
            $pied .= " AND pied = '$pied'";

        }
        if (!empty($position)) {
            
            $query .= " AND position = '$position'";

        }
        
        $recuperation_infos_joueurs = $db->query($query);

        $ligne_trouver = $recuperation_infos_joueurs->rowCount();

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
          form{
                    width:98.5%;
                    padding: 10px 5px;
                    margin: 30px 4.5%;
                }
                input, select{
                    height:40px;
                    width:100%;
                    margin: 5px;
                    border:1px solid #caccce;
                    border-radius:3px;
                }
                label{
                    margin-left:5px;
                    font-family: arial;
                    font-size: 14px;
                    font-weight: bold;
                    opacity:0.8;
                }
                .forth_class{
                    width:90%;
                    background-color: #f9f9f9;
                    display:flex;
                    border-top:5px solid #720817;
                    border-bottom:5px solid #720817;
                    border-radius:4px;
                }
                .forth_class div{
                    width:22%;
                    margin:20px 10px;
                }
                .forth_class input{
                    width:100%;
                    height:45px;
                }
                .forth_class select{
                    width:100%;
                    height:45px;
                }
                #bouton_envoi{
                    width:93%;
                    height:45px;
                    background-color: #720817;
                    border-color: #720817;
                    border-radius:5px;
                    color:white;
                    font-size:17px;
                    margin-top:31px;
                }
                button{
                    width:95%;
                    height:45px;
                    background-color: #f5a623;
                    border: none;
                    border-color: #f5a623;
                    border-radius:5px;
                    color:white;
                    font-size:19px;
                    margin-top:20px;
                }
                
                @media screen and (max-width: 950px){
                    form{
                        margin-left: 1%;
                    }
                    .forth_class{
                        width:100%;
                        flex-wrap: wrap;
                        display: block;
                    }
                    .forth_class div{
                        width:90%;
                        margin:20px 5%;
                        display: block;
                    }
                    #bouton_envoi{
                    width:100%;
                    }
                }
                #recherche h2{
                     text-align: center;
                     margin: 30px;
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
                         <li><a href="index.php#top" class="smoothScroll">Acceuil</a></li>
                         <li><a href="index.php#about" class="smoothScroll">Apropos</a></li>
                         <li><a href="index.php#team" class="smoothScroll">Equipes</a></li>
                         <li><a href="index.php#courses" class="smoothScroll">Vitrine</a></li>
                         <li><a href="index.php#testimonial" class="smoothScroll">Témoignages</a></li>
                         <li><a href="index.php#contact" class="smoothScroll">Contact</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="home/login.php"> Connexion</a></li>
                    </ul>
               </div>

          </div>
     </section>

     <section id="recherche">
     <h2>Quels sont les critères ?</h2>
        <div id="recherche_precis">
                <form action="" method="post">
                    <div class="forth_class">
                        
                        <div>
                            <label for="position">Position :</label>
                            <select name="position" id="">
                                <option></option>
                                <option value="Défenseur Central">Défenseur Central (Libéro)</option>
                                <option value="Latéral Droit">Latéral Droit</option>
                                <option value="Latéral Gauche">Latéral Gauche</option>
                                <option value="Avant-Centre">Avant-Centre</option>
                                <option value="Ailier Droit">Ailier Droit</option>
                                <option value="Ailier Gauche">Ailier Gauche</option>
                                <option value="Milieu Central">Milieu Central</option>
                                <option value="Milieu Défensif">Milieu Défensif</option>
                                <option value="Milieur Offensif">Milieur Offensif</option>
                                <option value="Attaquant de Pointe">Attaquant de Pointe</option>
                            </select>
                        </div>

                        <div>
                            <label for="age">Age minimum :</label>
                            <input type="number" name="age">
                        </div>

                        <div>
                            <label for="prenom">Age maximum :</label>
                            <input type="number" name="age_maximum" >
                        </div>

                        <div>
                            <label for="pied">Pied :</label>
                            <select name="pied" id="">
                                <option></option>
                                <option value="Droit">Droit</option>
                                <option value="Gauche">Gauche</option>
                            </select>
                        </div>

                        <div>
                            <label for="sexe">Genre :</label>
                            <select name="sexe" id="">
                                <option></option>
                                <option value="M">Garçon</option>
                                <option value="F">Fille</option>
                            </select>
                        </div>
                        

                        <div>
                            <input type="submit" id="bouton_envoi" value=" Go " name="bouton_envoi">
                        </div>
                    </div>
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
                              <h2> <?php echo $ligne_trouver ?> <small>Résultats trouvés</small></h2>
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
                              <h2> <?php echo $ligne_trouver ?> <small>Résultats trouvés </small> </h2>
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
                                   <p>1800 dapibus a tortor pretium,<br> Integer nisl dui, ABC 12000</p>
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
                                   <p><a href="mailto:youremail.co">hello@youremail.co</a></p>
                              </address>

                              
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Newsletter Signup</h2>
                              </div>
                              <div>
                                   <div class="form-group">
                                        <form action="#" method="get">
                                             <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" required="">
                                             <input type="submit" class="form-control" name="submit" id="form-submit" value="Send me">
                                        </form>
                                        <span><sup>*</sup> Please note - we do not spam your email.</span>
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