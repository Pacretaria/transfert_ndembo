<?php
include('../db.php');
if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'agent'){
        $nbr_recuperation = 0;
        
        if (isset($_POST['recherche'])) {
            $recherche = htmlspecialchars($_POST['recherche']);

            $recuperation = $db->prepare('SELECT * FROM `jouers` WHERE `nom` LIKE :recherche OR `position` LIKE :recherche OR `club` LIKE :recherche OR `prenom` LIKE :recherche OR `manager` LIKE :recherche OR `nationalite` LIKE :recherche ORDER BY id DESC');
            $recuperation->bindValue(':recherche',"%$recherche%");
            $recuperation->bindValue(':position',"%$recherche%");

            $recuperation->bindValue(':club',"%$recherche%");
            $recuperation->bindValue(':prenom',"%$recherche%");
            $recuperation->bindValue(':manager',"%$recherche%");
            $recuperation->bindValue(':nationalite',"%$recherche%");
            $recuperation->execute();
            
            $nbr_recuperation = $recuperation->rowCount();

        } else {
            # code...
        }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transfert ndembo</title>
        <link rel="stylesheet" href="css/style_form.css">
        <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    </head>
    <style>
        body{
            margin: 0px;
        }
        #search{
            
        }
    </style>
    <?php include('entete.php') ?>
    <body>
    
    <div id="bloc_principal">
        <div>
            <form action="" method="post" id="form_search">
                <input type="text" name="recherche" required value="Entrez un nom, poste ou une equipe " id="search" onclick="supprime()">
            </form>
        </div>
        
        
        <h3><span><?php echo $nbr_recuperation ?></span> résultat(s) trouvé(es) </h3>
        <div id="resultat">
        <table id="resultat_recherche">
            <thead>
                <tr>
                    <th>Joueurs</th>
                    <th>Age</th>
                    <th>Equipe</th>
                    <th> Nat. </th>
                    <th> Valeur marchande </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($nbr_recuperation > 0) {
                    while($donnees_joueurs = $recuperation->fetch()){

                    $date_naissance = $donnees_joueurs['age'];
                    $date_info = date_parse($date_naissance);
                    $naissance = $date_info['year'];
                    $date_actuel = date('Y');
                    ?>
                    <tr>
                        <td><a href="voir.php?joueur=<?php echo $donnees_joueurs['reference'] ?>"><img src="../media/<?php echo $donnees_joueurs['profil'] ?>" alt="profil" class="profil_joueurs"> <p> <?php echo $donnees_joueurs['nom'].' '.$donnees_joueurs['prenom'] ?> <br><span> <?php echo $donnees_joueurs['position'] ?> </span> </p></a></td>
                        <td><p class="nom_joueurs"> <?php echo $date_actuel - $naissance.' ans' ?> </p></td>
                        <td><p>  <span> <?php echo $donnees_joueurs['club'] ?> </span> </p></td>
                        <td><p> <?php echo $donnees_joueurs['nationalite'] ?>  </p></td>
                        <td class="valeur_marchandes"> <span><?php echo $donnees_joueurs['prix'].' $' ?></span> </td>
                    </tr>
                    <?php
                    }
                }
                ?>
            </tbody>
        </table>
        
        </div>
    </div>

    <script>
            function supprime (e) {
                document.getElementById("search").value = "";
                document.getElementById("search").style.boxShadow = "5px 2px 2px 2px #77032754"
            }
            function envoiForm() {
                document.getElementById("form_search").submit();
            }

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
}else {
    header('location:../');
}