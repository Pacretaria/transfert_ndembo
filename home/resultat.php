<?php
include('db.php');
if (isset($_POST['recherche'])) {
    $recherche = htmlspecialchars($_POST['recherche']);

    $recuperation = $db->prepare('SELECT * FROM `jouers` WHERE `nom` LIKE :recherche OR `position` LIKE :recherche');
    $recuperation->bindValue(':recherche',"%$recherche%");
    $recuperation->bindValue(':position',"%$recherche%");
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
    <?php include('entete.php') ?>
    <body>
    
    <div id="bloc_principal">
        <div>
            <form action="" method="post" id="form_search">
                <input type="text" name="recherche" required value="Entrez un nom, poste ou une equipe " id="search" onclick="supprime()">
                <button>Go</button>
            </form>
        </div>
        
        
        <h3><span><?php echo $nbr_recuperation ?></span> résultat(s) trouvé(es) </h3>
        <div id="resultat">
        <?php  
        if ($nbr_recuperation > 0) {
            while($donnees_joueurs = $recuperation->fetch()){

            $date_naissance = $donnees_joueurs['age'];
            $date_info = date_parse($date_naissance);
            $naissance = $date_info['year'];
            $date_actuel = date('Y');
            ?>
            <div class="encadrement_resultat">
                <img src="media/<?php echo $donnees_joueurs['profil'] ?>" alt="profil" class="profil_joueurs">
                <p class="nom_joueurs"> <?php echo $donnees_joueurs['nom'].' '.$donnees_joueurs['prenom'] ?> </p>
                <p> <?php echo $date_actuel - $naissance.' ans' ?> <span> <?php echo $donnees_joueurs['pied'] ?> </span> </p>
                <p> <?php echo $donnees_joueurs['position'] ?>  <span><?php echo $donnees_joueurs['prix'].' $' ?></span> </p>
                <a href="voir_profil_joueur.php?joueur=<?php echo $donnees_joueurs['reference'] ?>">Voir plus</a>
            </div>
            <?php
            }
        }
        ?>
        </div>
    </div>

        <script>
            function supprime () {
                document.getElementById("search").value = "";
            }
            function envoiForm() {
                document.getElementById("form_search").submit();
            }
        </script>
</body>
</html>