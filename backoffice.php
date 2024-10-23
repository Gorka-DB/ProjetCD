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
</header>
<!--AJOUT D'UN CD DANS LA BD-->
<div>
    <h4>AJOUT DE CD</h4>
    <form ENCTYPE="multipart/form-data" ACTION="upload.php" METHOD="POST">
        <p>Titre <input type="text" name="titre"></p>
        <p>Genre <input type="text" name="genre"></p>
        <p>Auteur <input type="text" name="auteur"></p>
        <p>Prix <input type="number" name="prix"></p>
        <p>Photo <input type=file name="photo"></p>
        <p><input type=submit name="envoiphoto"></p>

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
                print("<p class='alert alert-danger'>Suppression de l'album ".$_GET["titre"]." REUSSIE </p>");
            }
            else if($_GET["suppression"] == "non"){
                print("<p class='alert alert-danger'>Suppression de l'album ".$_GET["titre"]." ECHOUEE"."</p>");
            }
        }
        ?>
    </form>
</div>

<!--SUPRESSION DE CD VIA AFFICHAGE DE LA LISTE + BOUTON SUPPRIMER ?-->
<?php
$sql = "SELECT * FROM CD";
$test = $connexion->query($sql);
$array = ($test->fetch_all(MYSQLI_ASSOC));
?>
<div class="row row-cols-4">
    <?php
    for ($i = 0; $i < count($array); $i++) {
        ?>
        <div class="card col mb-3 mx-1">
            <a href=detail.php?id=<?=$array[$i]['id']?>><img src="resize.php?titre=<?=($array[$i]['titre'])?>&img=<?=($array[$i]['chemin_img'])?>" class='card-img-top' alt="TEST"></a>
            <div class="card-body">
                <?php $titre = urldecode($array[$i]["titre"])?>
                <h5 class="card-title"><?=$titre?></h5>
                <?php $auteur = urldecode($array[$i]["auteur"])?>
                <p class="card-text"><?=$auteur?></p>
                <?php $genre = urldecode($array[$i]["genre"])?>
                <p class="card-text"><?=$genre?></p>
                <p class="card-text"><?=$array[$i]["prix"]?></p>
                <a href="delete.php?idAlbum=<?=$array[$i]["id"]?>&Titre=<?=$array[$i]["titre"]?>&Action=supprimer" class="btn btn-danger">Supprimer du Site et de la BD</a>
            </div>
        </div>
        <?php
    }
    ?>




</body>
