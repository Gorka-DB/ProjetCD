<?php

$servername = "localhost";
$username = "root";
$password = "";

$connexion = mysqli_connect($servername, $username, $password, $database = "ProjetCD");

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>



