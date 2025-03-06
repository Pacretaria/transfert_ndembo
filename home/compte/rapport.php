<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'admin'){

        $recuperation_agent = $recuperation_jouers = $db->prepare('SELECT * FROM `utilisateurs` WHERE (acces = ?) ORDER BY id DESC');
        $recuperation_agent->execute(array('agent'));
        $nbr_jouers = $recuperation_agent->rowCount();

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
                        .profil_utilisateurs_rapport{
                            width:15%;
                            border-radius: 50%;
                        }
                    </style>
                </head>
                <body>
                    <?php include('entete.php'); ?>
                    
                    <div>

                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> AGENT </th>
                                    <th> NOMBRE DES JOUEURS ENREGISTRES </th>
                                    <th>ID</th>
                                    <th> CONTACTS </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $i = 1;
                                    if($nbr_jouers >= 1){
                                    while($donnees_agent = $recuperation_agent->fetch()){

                                        $recuperation_jouer_inscrit = $db->prepare('SELECT * FROM `jouers`WHERE (agent = ?) AND (date_enregistrement = ?)');
                                        $recuperation_jouer_inscrit->execute(array($donnees_agent['reference'],date('Y-m-d')));
                                        $nbr_jouers_inscrit = $recuperation_jouer_inscrit->rowCount();
                                    ?>
                                    <tr>
                                        <td> <?php echo $i?> </td>
                                        <td> <?php echo $donnees_agent['prenom'].' '.$donnees_agent['nom']?> </td>
                                        <td> <?php echo $nbr_jouers_inscrit?> </td>
                                        <td> <?php echo $donnees_agent['reference']?> </td>
                                        <td><?php echo $donnees_agent['mail'].' | '.$donnees_agent['contact']?></td>
                                    </tr>
                                    <?php
                                    $i++;
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