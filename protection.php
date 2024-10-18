<?php
session_start();
// on teste si nos variables sont définies
if (!isset($_SESSION['login']) or !isset($_SESSION['pwd'])) {
    // on vérifie les informations saisies

        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
        // puis on le redirige vers la page d'accueil
        header('location: login.php');
}
?>

