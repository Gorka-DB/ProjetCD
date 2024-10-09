<?php
include "connexionBD.php";
$sql = "SELECT titre, image, prix, auteur, genre FROM CD";
$test = $connexion->query($sql);
$array = ($test->fetch_all(MYSQLI_ASSOC));

print('<img src='.$array[1].' alt ='.$array[0].'/>');
print('<p></p>')