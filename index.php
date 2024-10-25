<?php
session_start();
include "include.php";
if (isset($_GET['idAlbum'])) {
    $_SESSION['panier'][$_GET['idAlbum']] += 1;

    var_dump($_GET['idAlbum']);
    var_dump($_SESSION['panier']);
    var_dump(array_search($_GET['idAlbum'], $_SESSION['panier']));
    header('location: panier.php');
}
else{?>
    <head>
        <meta charset="UTF-8">
        <title>Votre panier</title>
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
                        <a class="nav-link active" href="index.php">Catalogue</a>
                        <!--condition d'affichage du bandeau-->
                        <?php
                        if(isset($_SESSION['role'])) {
                            ?>
                            <a class="nav-link" aria-current="page" href="panier.php">Mon panier</a>
                            <a class="nav-link" aria-current="page" href="logout.php">Se deconnecter</a>
                            <?php
                            if ($_SESSION['role'] == 1 ){
                                ?>
                                <a class="nav-link" aria-current="page" href="backoffice.php">Back office</a>
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
    <?php
    $sql = "SELECT * FROM cd";
    $test = $connexion->query($sql);
    $array = ($test->fetch_all(MYSQLI_ASSOC));
    ?>
        <div class="row row-cols-5">
            <?php
    for ($i = 0; $i < count($array); $i++) {
        ?>
        <div class="card col mb-3 mx-1">
            <a href=detail.php?id=<?=$array[$i]['id']?>><img src="resize.php?titre=<?=($array[$i]['titre'])?>&img=<?=($array[$i]['chemin_img'])?>" class='card-img-top' alt="TEST"></a>
            <div class="card-body">
                <?php $titre = urldecode($array[$i]["titre"])?>
                <h5 class="card-title text-primary"><?=$titre?></h5>
                <?php $auteur = urldecode($array[$i]["auteur"])?>
                <p class="card-text"><?=$auteur?></p>
                <?php $genre = urldecode($array[$i]["genre"])?>
                <p class="card-text"><?=$genre?></p>
                <p class="card-text text-primary"><?=$array[$i]["prix"]?>€</p>
                <?php
                if(isset($_SESSION['role'])) {
                ?>
                <a href="index.php?idAlbum=<?=$array[$i]["id"]?>" class='btn btn-primary'">Ajouter au panier</a>
                    <?php
                }
                ?>
            </div>
        </div>
    <?php
        }
    ?>
        </div>
    </body>
<?php
}
?>