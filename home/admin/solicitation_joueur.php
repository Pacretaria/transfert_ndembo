<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'admin'){

        $recuperation_utilisteurs = $db->prepare('SELECT * FROM `solicitation` ORDER BY id DESC');
        $recuperation_utilisteurs->execute(array());

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transfert ndembo solucitation</title>
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
                width:95%;
                margin:5% 0% 5% 2.5%;
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
                padding: 5px;
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
        </style>
    </head>
    <body>
        <?php include('entete.php'); ?>
        
        <div>
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th> SOLICITAIRE </th>
                        <th> CONTACT </th>
                        <th> JOUEUR VOULU </th>
                        <th> MESSAGE </th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $i = 1;
                    while( $donnees_utilisteurs = $recuperation_utilisteurs->fetch()){

                        ?>
                        <tr>
                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $i?> </td>
                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_utilisteurs['noms_negociateur'] ?> </td>
                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_utilisteurs['contact_negociateur']?> </td>
                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_utilisteurs['joueur'] ?> </td>
                            <td class="<?php if(($i % 2) == 0){ echo "active";} ?>"> <?php echo $donnees_utilisteurs['message'] ?></td>
                            </td>
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