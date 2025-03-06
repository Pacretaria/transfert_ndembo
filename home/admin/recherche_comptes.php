<?php
include('../db.php');
    if(isset($_POST['recherche']) and !empty($_POST['recherche'])){
        $recherche = htmlspecialchars($_POST['recherche']);

        $recuperation_visiteurs = $db->prepare('SELECT * FROM `utilisateur` WHERE (nom = ?) OR (prenom = ?) OR (mail = ?) OR (`acces` = ?) OR (departement = ?) OR (fonction = ?) ORDER BY id DESC');
        $recuperation_visiteurs->execute(array($recherche,$recherche,$recherche,$recherche,$recherche,$recherche));
        $ligne_recherche = $recuperation_visiteurs->rowCount();
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
                    width:90%;
                    margin:10% 0% 0% 5%;
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
                    height:50px;
                    color: black;
                    font-weight: bold;
                    padding: 10px;
                    border-bottom: 2px solid #f5a623;
                }
                table tbody td a{
                    text-decoration: none;
                    color: black;
                }
                .click, .delete{
                    background-color: #ddd5d8;
                    padding: 15px;
                    color: #3f3f41;
                    transition-property: background-color;
                    transition-duration: 0.3s;
                    transition-delay: 0s;
                }
                .click:hover{
                    background-color: #e9e6e7;
                }
                .delete:hover{
                    background-color: #720817;
                    color: white;
                }
                #error{
                    margin-top: 20px;
                    text-align: center;
                }
                #error span{
                    color: red;
                }
            </style>
        </head>
        <body>
            <?php include('entete_admin.php'); ?>
            
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th> Nom complet </th>
                            <th> Adresse email </th>
                            <th> Accès </th>
                            <th> Departement </th>
                            <th>Fonction</th>
                            <th> Réglage </th>
                            <th> Action </th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        $i = 1;
                        while( $donnees_visiteurs = $recuperation_visiteurs->fetch()){

                            ?>
                            <tr>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $i?> </td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['nom'].' '.$donnees_visiteurs['prenom'] ?> </td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['mail']?> </td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['acces'] ?> </td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['departement']?> </td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_visiteurs['fonction'] ?></td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>">
                                    <a href="modification_compte.php?utilisateur=<?php echo $donnees_visiteurs['reference'] ?>" class="click"> Modifier </a>
                                </td>
                                <td class="<?php if(($i % 2) == 0){ echo "active";} ?>">
                                    <a href="supression_compte.php?utilisateur=<?php echo $donnees_visiteurs['reference'] ?>" class="delete"> Suprimer </a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>

                    <tfoot>

                    </tfoot>
                </table>
                <?php
                if($ligne_recherche == 0){
                ?>
                    <div id="error">
                        <p> 0 reultats pour <span> <?php echo $recherche ?> </span> </p>
                    </div>
                <?php
                }
                ?>                 
                </div>
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
 