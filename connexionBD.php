<?php

$servername = "lakartxela.iutbayonne.univ-pau.fr";
$username = "gdbelascain_bd";
$password = "gdbelascain_bd";
$database = "gdbelascain_bd";

$connexion = mysqli_connect($servername, $username, $password, $database);

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>



