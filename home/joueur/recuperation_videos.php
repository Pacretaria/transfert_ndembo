<?php
include('../db.php');

$recuperation_videos = $db->prepare('SELECT * FROM `media` WHERE (`type` = ?) ORDER BY id DESC LIMIT 5');
$recuperation_videos->execute(array("video"));

$nbr_recuperation_videos = $recuperation_videos->rowCount();

$donnees_videos = array();

if ($recuperation_videos->rowCount() > 0) {
    $i = 0;
    
    while ($donnees = $recuperation_videos->fetch()) {

        $donnees_videos[$i] = $donnees['fichier'];
        
        $i++;
    }

}

//header('Content-Type : application/json');
echo json_encode($donnees_videos);

$recuperation_videos->closeCursor();