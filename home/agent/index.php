<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'agent'){

        $recuperation_jouers = $db->prepare('SELECT * FROM `jouers` WHERE (agent = ?) AND (date_enregistrement = ?) ORDER BY id DESC');
        $recuperation_jouers->execute(array($_SESSION['reference'],date('Y-m-d')));
        $nbr_jouers = $recuperation_jouers->rowCount();

        $recuperation_jouers_standard = $db->prepare('SELECT * FROM `jouers` WHERE (agent = ?) AND (categorie = ?) AND (date_enregistrement = ?) ORDER BY id DESC');
        $recuperation_jouers_standard->execute(array($_SESSION['reference'],"Standard",date('Y-m-d')));
        $nbr_jouers_standard = $recuperation_jouers_standard->rowCount();

        $recuperation_jouers_avancee = $db->prepare('SELECT * FROM `jouers` WHERE (agent = ?) AND (categorie = ?) AND (date_enregistrement = ?) ORDER BY id DESC');
        $recuperation_jouers_avancee->execute(array($_SESSION['reference'],"Avancée",date('Y-m-d')));
        $nbr_jouers_avancee = $recuperation_jouers_avancee->rowCount();

        $recuperation_jouers_premium = $db->prepare('SELECT * FROM `jouers` WHERE (agent = ?) AND (categorie = ?) AND (date_enregistrement = ?) ORDER BY id DESC');
        $recuperation_jouers_premium->execute(array($_SESSION['reference'],"Premium",date('Y-m-d')));
        $nbr_jouers_premium = $recuperation_jouers_premium->rowCount();

        $recuperation_jouers_vip = $db->prepare('SELECT * FROM `jouers` WHERE (agent = ?) AND (categorie = ?) AND (date_enregistrement = ?) ORDER BY id DESC');
        $recuperation_jouers_vip->execute(array($_SESSION['reference'],"Vip",date('Y-m-d')));
        $nbr_jouers_vip= $recuperation_jouers_vip->rowCount();
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
                            background-color: #ddd5d8;
                            margin: 0px;
                            padding: 0px;
                        }
                        header{
                            background-color: #770327;
                        }
                        table {
                            background-color: white;
                            color: black;
                            font-size: 85%;
                            margin-bottom: 0;
                            width:90%;
                            margin:2.5% 0% 1% 5%;
                            border-collapse: collapse;;
                            text-align: left;
                        }
                        table th{
                            height:60px;
                            background-color: #720817;
                            color: white;
                            padding-left: 10px;
                        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                        table tbody td{
                            background-color: white;
                            height:40px;
                            color: black;
                            font-weight: bold;
                            padding: 10px;
                            border-bottom: 2px solid #f5a623;
                        }
                        table tbody td a{
                            text-decoration: none;
                            color: black;
                        }
                        .active{
                            background-color: white;
                            color: #3f3f41;
                        }
                        .click, .delete{
                            margin-left:5px;
                            background-color: #ddd5d8;
                            padding: 15px;
                            color: #3f3f41;
                            transition-property: background-color;
                            transition-duration: 0.3s;
                            transition-delay: 0s;
                        }
                        .click:hover{
                            background-color: #f5a623;
                            color: white;
                        }
                        .delete:hover{
                            background-color: #720817;
                            color: white;
                        }
                        .info div {
                            color: #720817;
                        }

                    </style>
                </head>
                <body>
                    <?php include('entete.php'); ?>
                    
                    <div>
                        <div class="info">
                            <div>
                                <h2><?php echo $nbr_jouers?></h2>
                                <p><img src="../logo/utilisateur.svg" alt="user"> Joueur(s) inscrit(s)</p>
                            </div>

                            <div>
                                <h2><?php echo $nbr_jouers_standard?></h2>
                                <p> <span>STANDARD</span> : <img src="../logo/utilisateur.svg" alt="user"> Joueur(s) inscrit(s)</p>
                            </div>

                            <div>
                                <h2><?php echo $nbr_jouers_avancee?></h2>
                                <p><span>AVANCEE</span> : <img src="../logo/utilisateur.svg" alt="user"> Joueur(s) inscrit(s)</p>
                            </div>

                            <div>
                                <h2><?php echo $nbr_jouers_premium?></h2>
                                <p><span>PREMIUM</span> : <img src="../logo/utilisateur.svg" alt="user"> Joueur(s) inscrit(s)</p>
                            </div>

                            <div>
                                <h2><?php echo $nbr_jouers_vip?></h2>
                                <p><span>VIP</span> : <img src="../logo/utilisateur.svg" alt="user"> Joueur(s) inscrit(s)</p>
                            </div>

                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>Profil</th>
                                    <th> Noms </th>
                                    <th> Poste </th>
                                    <th> Equipe </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    if($nbr_jouers >= 1){
                                    while($donnees_jouers = $recuperation_jouers->fetch()){
                                    ?>
                                    <tr>
                                        <td> <a href="voir_profil_joueur.php?joueur=<?php echo $donnees_jouers['reference'] ?>"><img src="../media/<?php echo $donnees_jouers['profil']?>" class="profil_jouers" alt="profil_jouers">  </a></td>
                                        <td> <?php echo $donnees_jouers['prenom'].' '.$donnees_jouers['nom']?> </td>
                                        <td> <?php echo $donnees_jouers['position']?> </td>
                                        <td><?php echo $donnees_jouers['club']?></td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>
                    <script>
                        function menu(){
                            document.getElementById("menu").style.marginLeft = "0%";
                            document.getElementById("menu_icon_burger").style.display = "none";
                            document.getElementById("menu_icon_close_burger").style.display = "block";
                        }
                        function menuClose() {
                            document.getElementById("menu").style.marginLeft = "-40%";
                            document.getElementById("menu_icon_burger").style.display = "block";
                            document.getElementById("menu_icon_close_burger").style.display = "none";
                        }
                    </script>
                </body>
            </html>
        <?php
    }
}
else {
    header('location:../');
}