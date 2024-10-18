<?php

include "connexionBD.php";
// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) {
    // on vérifie les informations saisies
    $sql = "SELECT * FROM COMPTE WHERE pswrd = '".$_POST['pwd']."' AND login = '".$_POST['login']."'";
    $test = $connexion->query($sql);
    $array = ($test->fetch_all(MYSQLI_ASSOC));
    var_dump($array);
    if (count($array) > 0) {
        session_start ();
        // on enregistre les paramètres de notre visiteur comme variables
        //de session ($login et $pwd) (
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['pwd'] = $_POST['pwd'];
        $_SESSION['idCompte'] = $array[0]['id'];
        $_SESSION['role'] = $array[0]['role'];
        $_SESSION['panier'] = array();

        // on redirige notre visiteur vers une page de notre section membre
        header ('location: panier.php');
    }
    else {
        echo '<body onLoad="alert(\'Membre non reconnu...\')">';
        // puis on le redirige vers la page d'accueil
        echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }
} else {
    echo 'Les variables du formulaire ne sont pas déclarées.';
}
?>
