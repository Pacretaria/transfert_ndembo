<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'],$_GET['departement']) AND !empty($_GET['departement'])) {
    if($_SESSION['acces'] == 'admin'){

        $departement = htmlspecialchars($_GET['departement']);

        $recuperation_departement = $db->prepare('SELECT * FROM `visiteurs` WHERE (destination = ?) AND (`date` = ?)');
        $recuperation_departement->execute(array($departement,date('Y-m-d')));

        $ligne_departement = $recuperation_departement->rowCount();
     
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
                        
                        table {
                            background-color: white;
                            color: black;
                            font-size: 85%;
                            margin-bottom: 0;
                            width:98%;
                            margin:2.5% 0% 1% 1%;
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
                    </style>
                </head>
                <body>
                    <?php include('entete.php'); ?>
                    
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> Nom complet </th>
                                    <th> Inviteur </th>
                                    <th> Departement </th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th> Sexe </th>
                                    <th> telephone </th>
                                    <th> Adresse </th>
                                    <th> Motif </th>
                                    <th> Observation </th>
                                    <th> Enregistreur </th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                                
                            if ($ligne_departement >= 1) {
                                $i = 1;
                                while( $donnees_visiteurs = $recuperation_departement->fetch()){
                                    
                                    ?>
                                        <tr>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $i?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['noms']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['inviteur']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['destination']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['date']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['heure'].'h'?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['sexe']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['telephone']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['adresse']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['motif']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['observation']?> </td>
                                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['enregistreur']?> </td>
                                        </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            else {
                                ?>
                                <td colspan="4"></td>
                                <td colspan="4"> <span style="color:red">0</span> visiteur pour cette departement </td>
                                <td colspan="4"></td>
                                <?php
                            }
                            ?>
                            </tbody>

                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <script>
                        function menu(){
                            document.getElementById("menu").style.marginLeft = "0%";
                            document.getElementById("menu_icon").style.display = "none";
                            document.getElementById("menu_icon_close").style.display = "block";
                        }
                        function menuClose() {
                            document.getElementById("menu").style.marginLeft = "-20%";
                            document.getElementById("menu_icon").style.display = "block";
                            document.getElementById("menu_icon_close").style.display = "none";
                        }
                    </script>
                </body>
            </html>
        <?php
    }
    else {
        header('location:../');
    }
}
else {
    header('location:../');
}