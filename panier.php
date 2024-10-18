<?php
include 'protection.php';
include 'include.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Votre panier</title>
</head>
<body>
    <?php
    //var_dump($_SESSION);
    $sql = "SELECT * FROM COMPTE WHERE id = ".$_SESSION['idCompte'];
    $test = $connexion->query($sql);
    $array = ($test->fetch_all(MYSQLI_ASSOC));
    ?>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="accueil.php">ProjetCD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="accueil.php">Catalogue</a>
                        <a class="nav-link active" aria-current="page" href="panier.php">Mon panier</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <?php
        if (is_array($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        ?>
    <div class="row row-cols-4">
        <?php
        //var_dump($_SESSION['panier']);
        for ($i = 0; $i < count($_SESSION['panier']); $i++) {

            $sql = "SELECT * FROM CD WHERE id = ".$_SESSION['panier'][$i];
            $test = $connexion->query($sql);
            $cd = $test->fetch_row();

            $titre = urldecode($cd[0]);
            $genre = urldecode($cd[1]);
            $auteur = urldecode($cd[2]);
            $prix = urldecode($cd[3]);
            $chemin = urldecode($cd[4]);
            $id = urldecode($cd[5]);

            ?>
            <div class="card col mb-3 mx-1">
                <a href=detail.php?id=<?=$id?>><img src="resize.php?titre=<?=$titre?>&img=<?=$chemin?>" class='card-img-top' alt="TEST"></a>
                <div class="card-body">
                    <h5 class="card-title"><?=$titre?></h5>
                    <p class="card-text"><?=$auteur?></p>
                    <p class="card-text"><?=$genre?></p>
                    <p class="card-text"><?=$prix?></p>
                </div>
            </div>
            <?php
        }
        echo '<p><a href="accueil.php">Retour au catalogue </a></p>';
        }
        else {
            echo "Votre panier est vide.";
        }
        ?>
</body>
