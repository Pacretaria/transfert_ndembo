<?php
session_start();
$connect = NULL;
$recherche = null;
try
{
	$db = new PDO('mysql:host=localhost;dbname=u911414181_ndembo;charset=utf8;', 'u911414181_ndembo', 'ndemboSynapse2025@');
    $connect = 'connect';
}
catch(Exception $e)
{
    ?>
    <script>
        alert("Verifié que vous disposez d'une connexion internet");
    </script>
    <?php
}
