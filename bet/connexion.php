<?php
include('db.php');

if (isset($_POST['number'],$_POST['pass']) AND !empty($_POST['number']) AND !empty($_POST['pass'])) {
    
    $number = htmlspecialchars($_POST['number']);
    $pass = htmlspecialchars($_POST['pass']);

    $recuperation_d_utilisateur = $db->prepare('SELECT * FROM `utilisateurs` WHERE (mot_passe = ?) and (contact = ?)');
	$recuperation_d_utilisateur->execute(array($pass,$number));

	$nbr_ligne = $recuperation_d_utilisateur->rowCount();

    if ($nbr_ligne == 1) {
				
        $donnees = $recuperation_d_utilisateur->fetch();

        $_SESSION['nom'] = $donnees['nom'];
        $_SESSION['prenom'] = $donnees['prenom'];
        $_SESSION['mail'] = $donnees['mail'];
        $_SESSION['reference'] = $donnees['reference'];
        $_SESSION['profil'] = $donnees['profil'];

        switch ($donnees['acces']) {

            case 'users':

                $_SESSION['acces'] = 'users';

                echo 'succes';

            break;

            case 'Agent_bet':

                $_SESSION['acces'] = 'reception';
                $_SESSION['departement'] = $donnees['departement'];
                $_SESSION['fonction'] = $donnees['fonction'];

                header('location:reception/');
                
                break;
            
            default:

                $error = '*accès refusé !';

                break;
        }
    }
    else{
        $error = "*ce compte n'existe pas !";
    }

}
else {
    echo 'echec';
}
?>