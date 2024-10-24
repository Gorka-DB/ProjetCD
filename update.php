<?php
include "include.php";
include "protection.php";

if(isset($_POST["modifier"]) && $_SESSION["role"] == 1) {
    $titre = urlencode($_POST["titre"]);
    $genre = urlencode($_POST["genre"]);
    $auteur = urlencode($_POST["auteur"]);
    $prix = $_POST["prix"];
    $id = $_POST["id"];

    $insertion = "UPDATE CD SET titre = '$titre', genre='$genre', auteur='$auteur', prix='$prix' WHERE id='$id'";
    var_dump($insertion);
    mysqli_query($connexion, $insertion);
    header("Location: backoffice.php?titre=$titre&action=modif");
}