<?php
include "include.php";
?>
<?php
$uploaddir = 'img/';
if(isset($_POST["envoiphoto"]) || $_FILES != null) {
    foreach ($_FILES as $photo) {
        $uploadfile = $uploaddir . $photo['name'];
        if (move_uploaded_file($photo['tmp_name'], $uploadfile)) {
            $titre = urlencode($_POST["titre"]);
            $genre = urlencode($_POST["genre"]);
            $auteur = urlencode($_POST["auteur"]);
            $uploadfile = urlencode($uploadfile);
            $prix = $_POST["prix"];
            $insertion = "INSERT INTO cd(titre, genre, auteur, prix, chemin_img) VALUES ('$titre', '$genre', '$auteur', $prix, '$uploadfile')";
            mysqli_query($connexion, $insertion);
        } else {
            print("<p> Données manquantes </p>");
        }
    }
};
?>
//AJOUTER RETOUR VERS BACK OFFICE AVEC MESSAGE TYPE "AJOUT DE [TITRE] REUSSI"