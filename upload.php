<?php
include "include.php";
include "protection.php";
?>
<?php
$uploaddir = 'img/';
var_dump($_FILES);
if((isset($_POST["envoiphoto"]) || $_FILES != null) && $_SESSION["role"] = 1) {
        $uploadfile = $uploaddir . str_replace(' ','_', $_FILES['photo']['name']);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
            $titre = urlencode($_POST["titre"]);
            $genre = urlencode($_POST["genre"]);
            $auteur = urlencode($_POST["auteur"]);
            $uploadfile = urlencode($uploadfile);
            $prix = $_POST["prix"];
            $insertion = "INSERT INTO cd(titre, genre, auteur, prix, chemin_img) VALUES ('$titre', '$genre', '$auteur', $prix, '$uploadfile')";
            mysqli_query($connexion, $insertion);
            print("<p>Ajout de $titre réussi</p>");

            header("Location: backoffice.php?titre=$titre&erreur=non");
        } else {
            print("<p> Données manquantes pour l'ajout</p>");
            header("Location : backoffice.php?titre=$titre&erreur=oui");
        }

};
?>