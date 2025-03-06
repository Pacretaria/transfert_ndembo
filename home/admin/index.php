<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'admin'){

        $recuperation_jouers = $recuperation_jouers = $db->prepare('SELECT * FROM `pre_enregistrement`  ORDER BY id DESC');
        $recuperation_jouers->execute(array());
        $nbr_jouers = $recuperation_jouers->rowCount();

        $recuperation_joueurs_enregistrer = $db->prepare('SELECT * FROM `jouers`  ORDER BY id DESC');
        $recuperation_joueurs_enregistrer->execute(array());
        $nbr_jouers_enregistrer = $recuperation_joueurs_enregistrer->rowCount();
        ?>
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Transfert ndembo</title>
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

                    </style>
                </head>
                <body>
                    <?php include('entete.php'); ?>
                    
                    <div>
                        <div class="info">
                            <div>
                                <h2><?php echo $nbr_jouers?></h2>
                                <p><img src="../logo/utilisateur.svg" alt="user"> Enregistrement(s) en Attente(s)</p>
                            </div>

                            <div>
                                <h2><?php echo $nbr_jouers_enregistrer?></h2>
                                <p><img src="../logo/utilisateur.svg" alt="user"> Joueur(s)  enregistré(es)</p>
                            </div>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>Profil</th>
                                    <th> Noms </th>
                                    <th> Poste </th>
                                    <th> Equipe </th>
                                    <th> Téléphone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    if($nbr_jouers >= 1){
                                    while($donnees_jouers = $recuperation_jouers->fetch()){
                                    ?>
                                    <tr>
                                        <td> <a href="confirmation_compte.php?jouer=<?php echo $donnees_jouers['reference']?>"><img src="../media/<?php echo $donnees_jouers['profil']?>" class="profil_jouers" alt="profil_jouers">  </a></td>
                                        <td> <?php echo $donnees_jouers['prenom'].' '.$donnees_jouers['nom']?> </td>
                                        <td> <?php echo $donnees_jouers['position']?> </td>
                                        <td><?php echo $donnees_jouers['club']?></td>
                                        <td><?php echo $donnees_jouers['contact']?></td>
                                        <td> <a href="supression_joueur.php?joueur=<?php echo $donnees_jouers['reference']?>">Supprimer</a> </td>
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