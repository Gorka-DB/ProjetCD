<head>
    <?php
    include "include.php";
    include "protection.php";
    ?>
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
        if ($_GET["erreur"] == "oui") {
            print("<p class='alert alert-danger'>Erreur d'insertion de l'album " . $_GET["titre"] . "</p>");
        } else if ($_GET["erreur"] == "non") {
            print("<p class='alert alert-danger'>Insertion de l'album " . $_GET["titre"] . "Réussie" . "</p>");
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
$sql = "SELECT * FROM CD";
$test = $connexion->query($sql);
$array = ($test->fetch_all(MYSQLI_ASSOC));
?>
<div class="row row-cols-5">
    <div class="card col mb-3 mx-1">
        <h4 class="text-primary"><strong>Ajouter un CD sur le site</strong></h4>
        <form ENCTYPE="multipart/form-data" ACTION="upload.php" METHOD="POST">
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
                <form action="update.php" method="POST">
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
                <a href="delete.php?idAlbum=<?=$array[$i]["id"]?>&Titre=<?=$array[$i]["titre"]?>&Action=supprimer" class="btn btn-danger">Supprimer du Site et de la BD</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</body>
