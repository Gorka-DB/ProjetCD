<?php
include "include.php";
?>
<?php
if(isset($_GET["idAlbum"]) && $_GET["Action"] == "supprimer") {
    $suppression = "DELETE FROM cd WHERE id = ".$_GET["idAlbum"];
    $titre = $_GET["Titre"];
    if (mysqli_query($connexion, $suppression)) {
        print("<p>Supression de ".urldecode($titre)." réussie</p>");
        header("Location: backoffice.php?titre=$titre&suppression=oui");
    } else {
        print("<p> Données manquantes pour l'ajout</p>");
        header("Location : backoffice.php?titre=$titre&suppression=non");
    }
};
?>