<?php
include('../db.php');

if (isset($_SESSION['nom'],$_SESSION['prenom'],$_SESSION['mail'],$_SESSION['reference'])) {
    if($_SESSION['acces'] == 'agent'){
    

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
        
        $recuperation_joueurs = $db->query($query);

        $ligne_trouver = $recuperation_joueurs->rowCount();

    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Liste des joueurs Transfert Ndembo</title>
            <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
            <style>
                body{
                    background-color: #ddd5d8;
                    margin: 0px;
                    padding: 0px;
                }
                
                
                form{
                    width:98.5%;
                    padding: 10px 5px;
                    margin-left:4.5%;
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
                    background-color: white;
                    display:flex;
                    border-top:5px solid #bbbcbe;
                    border-bottom:5px solid #bbbcbe;
                    border-radius:4px;
                }
                .forth_class div{
                    width:22%;
                    margin:20px 10px;
                }
                .forth_class input{
                    width:100%;
                }
                .forth_class select{
                    width:100%;
                    height:45px;
                }
                #bouton_envoi{
                    width:93%;
                    height:45px;
                    background-color: #2a5d84;
                    border-color: #2a5d84;
                    border-radius:5px;
                    color:white;
                    font-size:17px;
                    margin-top:20px;
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

                table {
                    background-color: white;
                    color: black;
                    font-size: 85%;
                    margin-bottom: 0;
                    width:90%;
                    margin:0% 0% 0% 5%;
                    border-collapse: collapse;;
                    text-align: left;
                }
                tr th{
                    text-align: center;
                }
                td{
                    padding: 0px 10px;
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
            <?php include('entete.php'); ?>
            
            <div id="recherche_precis">
                <form action="" method="post">
                    <div class="forth_class">
                        
                        <div>
                            <label for="position">Position :</label>
                            <select name="position" id="">
                                <option></option>
                                <option value="Latéral">Latéral</option>
                                <option value="Défenseur Central">Défenseur Central (Libéro)</option>
                                <option value="Milieu Défensif">Milieu Défensif</option>
                                <option value="Ailier">Ailier</option>
                                <option value="Milieu Central">Milieu Central</option>
                                <option value="Avant-Centre">Avant-Centre</option>
                                <option value="Milieur Offensif">Milieur Offensif</option>
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
                            <input type="submit" id="bouton_envoi" value=" Rechercher " name="bouton_envoi">
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <table id="resultat_recherche">
                    <thead>
                        <tr>
                            <th>Joueurs</th>
                            <th>Age</th>
                            <th>Equipe</th>
                            <th> Nat. </th>
                            <th class=""> Valeur marchande </th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        if ($ligne_trouver > 0) {
                            while($donnees_joueurs = $recuperation_joueurs->fetch()){
        
                            $date_naissance = $donnees_joueurs['age'];
                            $date_info = date_parse($date_naissance);
                            $naissance = $date_info['year'];
                            $date_actuel = date('Y');

                                if(!empty($age) and (!empty($age_maximum))){
                                    $age_minimum_filtrer = $date_actuel - $age;
                                    $age_maximum_filtrer = $date_actuel - $age_maximum;
                                    
                                    if (($age_maximum_filtrer <= $date_naissance) && ($age_minimum_filtrer >= $date_naissance )) {
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
                                }else {
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
                        }
                        ?>
                    </tbody>

                </table>
                    <?php
                    if(isset($_POST['bouton_envoi'],$_POST['date'],$_POST['departement'])){
                        if($ligne_trouver == 0){
                        ?>
                            <div id="error">
                                <p> Reultats non disponible pour le <span> <?php echo $date ?> </span> dans <span><?php echo $departement ?></span></p>
                            </div>
                        <?php
                        }
                    }
                    ?>
            </div>
            <script src="impression.js"></script>
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
