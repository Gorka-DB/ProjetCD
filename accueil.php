<?php
include "include.php";

$sql = "SELECT titre, chemin_img, auteur, genre, prix FROM CD";
$test = $connexion->query($sql);
$array = ($test->fetch_all(MYSQLI_ASSOC));
for ($i=0; $i < count($array); $i++) {
    print('<img src='.$array[$i]['chemin_img'].' alt ='.$array[$i]['titre'].'/>');
    print('<p>Titre : '.$array[$i]['titre'].'</p>');
    print('<p>Auteur : '.$array[$i]['auteur'].'</p>');
    print('<p>Genre : '.$array[$i]['genre'].'</p>');
    print('<p>Prix : '.$array[$i]['prix'].'</p>');
}
