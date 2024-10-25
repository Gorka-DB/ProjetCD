<?php
include "connexionBD.php";
include "protection.php";
$uploaddir = 'img/';
    if(isset($_GET["idAlbum"]) && $_GET["Action"] == "supprimer" && $_SESSION["role"] = 1) {
        $sql = "SELECT chemin_img FROM cd WHERE id = ".$_GET["idAlbum"];
        $requeteChemin = mysqli_query($connexion, $sql);
        $cheminImage = mysqli_fetch_assoc($requeteChemin);
        $suppression = "DELETE FROM cd WHERE id = ".$_GET["idAlbum"];
        $titre = $_GET["Titre"];
        if (mysqli_query($connexion, $suppression)) {
            unlink(urldecode($cheminImage["chemin_img"]));
            //print("<p>Supression de ".urldecode($titre)." réussie</p>");
            //header("Location: backoffice.php?titre=$titre&suppression=oui");
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php?titre='.$titre.'&suppression=oui">';
        } else {
            //print("<p> Données manquantes pour l'ajout</p>");
            //header("Location : backoffice.php?titre=$titre&suppression=non");
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php?titre='.$titre.'&suppression=non">';
        }
    }
    else if((isset($_POST["envoiphoto"]) || $_FILES != null) && $_SESSION["role"] == 1) {
        if (isset($_FILES['photo']['name'], $_POST["titre"], $_POST["auteur"], $_POST["genre"], $_POST["prix"])) {
            $uploadfile = $uploaddir . str_replace(' ', '_', $_FILES['photo']['name']);
            $titre = urlencode($_POST["titre"]);
            $genre = urlencode($_POST["genre"]);
            $auteur = urlencode($_POST["auteur"]);
            $uploadfilebd = urlencode($uploadfile);
            $prix = $_POST["prix"];
    
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                $insertion = "INSERT INTO cd(titre, genre, auteur, prix, chemin_img) VALUES ('$titre', '$genre', '$auteur', $prix, '$uploadfilebd')";
                mysqli_query($connexion, $insertion);
                //print("<p>Ajout de $titre réussi</p>");
                //header("Location: backoffice.php?titre=$titre&erreur=non");
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php?titre='.$titre.'&erreur=non">';
            }
            else{
                //print("<p>Erreur lors de l'upload</p>");
                //header("Location: backoffice.php?titre=$titre&erreur=upload");
                echo '<meta http-equiv="refresh" content="0;URL=backoffice.php?titre='.$titre.'&erreur=upload">';
            }
        }
    
        else {
            //print("<p> Données manquantes pour l'ajout</p>");
            //header("Location: backoffice.php?titre=$titre&erreur=donnees");
            echo '<meta http-equiv="refresh" content="0;URL=backoffice.php?titre='.$titre.'&erreur=donnees">';
        }
    }
    else if(isset($_POST["modifier"]) && $_SESSION["role"] == 1) {
        $titre = urlencode($_POST["titre"]);
        $genre = urlencode($_POST["genre"]);
        $auteur = urlencode($_POST["auteur"]);
        $prix = $_POST["prix"];
        $id = $_POST["id"];
    
        $insertion = "UPDATE cd SET titre = '$titre', genre='$genre', auteur='$auteur', prix='$prix' WHERE id='$id'";
        mysqli_query($connexion, $insertion);
        echo '<meta http-equiv="refresh" content="0;URL=backoffice.php?titre='.$titre.'&action=modifier">';
    }
    include "importBootstrap.php";
    ?>
<head>
    <meta charset="UTF-8">
    <title>Back office</title>  
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">ProjetCD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Catalogue</a>
                    <!--condition d'affichage du bandeau-->
                    <?php
                    if(isset($_SESSION['role'])) {
                        ?>
                        <a class="nav-link" aria-current="page" href="panier.php">Mon panier</a>
                        <a class="nav-link" aria-current="page" href="logout.php">Se deconnecter</a>
                        <?php
                        if ($_SESSION['role'] == 1 ){
                            ?>
                            <a class="nav-link active" aria-current="page" href="backoffice.php">Back office</a>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <a class="nav-link" aria-current="page" href="login.php">Se connecter</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <?php
    if(isset($_GET["titre"]) && isset($_GET["erreur"])){
        if ($_GET["erreur"] == "non") {
            print("<p class='alert alert-danger'>Insertion de l'album " . $_GET["titre"] . " réussie" . "</p>");
        }
        else if ($_GET["erreur"] == "upload") {
            print("<p class='alert alert-danger'>Erreur d'Upload de l'image de l'album</p>");
        }
        else if ($_GET["erreur"] == "donnees") {
            print("<p class='alert alert-danger'>Données manquantes pour insertion de l'album " . $_GET["titre"] . "</p>");
        }
    }
    if (isset($_GET["titre"]) && isset($_GET["suppression"])){
        if($_GET["suppression"] == "oui"){
            print("<p class='alert alert-danger'>Suppression de l'album ".$_GET["titre"]." Réussie </p>");
        }
        else if($_GET["suppression"] == "non"){
            print("<p class='alert alert-danger'>Suppression de l'album ".$_GET["titre"]." Échouée"."</p>");
        }
    }
    if (isset($_GET["titre"]) && isset($_GET["action"])){
        print("<p class='alert alert-primary'>Modification de l'album ".$_GET["titre"]." effectuée"."</p>");
    }
    ?>
</header>
<!--AJOUT D'UN CD DANS LA BD-->
<?php
$sql = "SELECT * FROM cd";
$test = $connexion->query($sql);
$array = ($test->fetch_all(MYSQLI_ASSOC));
?>
<div class="row row-cols-5">
    <div class="card col mb-3 mx-1">
        <h4 class="text-primary"><strong>Ajouter un CD sur le site</strong></h4>
        <form ENCTYPE="multipart/form-data" ACTION="backoffice.php" METHOD="POST">
            <p><label>Photo : </label>
                <input class="card-text" type=file name="photo"></p>
            <p><label>Titre : </label>
                <input class="card-text" type="text" name="titre"></p>
            <p><label>Auteur : </label>
                <input class="card-text" type="text" name="auteur"></p>
            <p><label>Genre : </label>
                <input class="card-text" type="text" name="genre"></p>
            <p><label>Prix (€) : </label>
                <input class="card-text" type="text" name="prix"></p>
            <p><input type=submit name="envoiphoto"</p>
        </form>
    </div>
    <?php
    for ($i = 0; $i < count($array); $i++) {
        ?>
        <div class="card col mb-3 mx-1">
            <a href=detail.php?id=<?=$array[$i]['id']?>><img src="resize.php?titre=<?=($array[$i]['titre'])?>&img=<?=($array[$i]['chemin_img'])?>" class='card-img-top' alt="TEST"></a>
            <div class="card-body">
                <form action="backoffice.php" method="POST">
                <?php $titre = urldecode($array[$i]["titre"])?>
                    <p><label>Titre : </label>
                    <input class="card-text" type="text" name="titre" value="<?=$titre?>"></p>
                <?php $auteur = urldecode($array[$i]["auteur"])?>
                    <p><label>Auteur : </label>
                    <input class="card-text" type="text" name="auteur" value="<?=$auteur?>"></p>
                <?php $genre = urldecode($array[$i]["genre"])?>
                    <p><label>Genre : </label>
                    <input class="card-text" type="text" name="genre" value="<?=$genre?>"></p>
                    <p><label>Prix (€) : </label>
                    <input class="card-text" type="text" name="prix" value="<?=$array[$i]["prix"]?>"></p>
                    <input type="hidden" name="id" value="<?=$array[$i]["id"]?>"></p>
                    <input type="submit" name="modifier" value="Mettre à jour">
                </form>
                <a href="backoffice.php?idAlbum=<?=$array[$i]["id"]?>&Titre=<?=$array[$i]["titre"]?>&Action=supprimer" class="btn btn-danger">Supprimer du Site et de la BD</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</body>
