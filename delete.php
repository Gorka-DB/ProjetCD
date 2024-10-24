<?php
include "include.php";
include "protection.php";
?>
<?php
if(isset($_GET["idAlbum"]) && $_GET["Action"] == "supprimer" && $_SESSION["role"] = 1) {
    $sql = "SELECT chemin_img FROM cd WHERE id = ".$_GET["idAlbum"];
    $requeteChemin = mysqli_query($connexion, $sql);
    $cheminImage = mysqli_fetch_assoc($requeteChemin);
    $suppression = "DELETE FROM cd WHERE id = ".$_GET["idAlbum"];
    $titre = $_GET["Titre"];
    if (mysqli_query($connexion, $suppression)) {
        unlink(urldecode($cheminImage["chemin_img"]));
        //print("<p>Supression de ".urldecode($titre)." réussie</p>");
        header("Location: backoffice.php?titre=$titre&suppression=oui");
    } else {
        //print("<p> Données manquantes pour l'ajout</p>");
        header("Location : backoffice.php?titre=$titre&suppression=non");
    }
};
?>