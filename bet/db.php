<?php
session_start();
$connect = NULL;
$recherche = null;
try
{
	$db = new PDO('mysql:host=localhost;dbname=trans2235742;charset=utf8;', 'root', '');
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
