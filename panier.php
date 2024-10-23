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
                            <a class="nav-link active" aria-current="page" href="panier.php">Mon panier</a>
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
        if (isset($_GET["action"]) && $_GET["action"] == "suppr") {
            unset($_SESSION['panier'][$_GET["num"]]);
        }
        if (is_array($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        ?>
    <div class="row row-cols-4">
        <?php
        $total = 0;
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

            $total += floatval($prix);

            ?>
            <div class="card col mb-3 mx-1">
                <img src="resize.php?titre=<?=$titre?>&img=<?=$chemin?>" class='card-img-top' alt="TEST">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?=$titre?></h5>
                    <p class="card-text"><?=$auteur?></p>
                    <p class="card-text"><?=$genre?></p>
                    <p class="card-text text-primary"><?=$prix?>€</p>
                    <a href="panier.php?action=suppr&num=<?=$i?>" class="btn btn-danger">Supprimer du pannier</a>
                </div>
            </div>
            <?php
        }
        ?>
        <h1>Prix total du panier : <?=$total?>€</h1>
        <form action='checkout.php' method='post'>
            <input type="hidden" name="prix" value="<?=$total?>">
            <button class="btn btn-primary w-100 py-2" type="submit">payer</button>
        </form>
        <?php
        }
        else {
            echo "<h1 class='text-primary'>Votre panier est vide.</h1>";
        }
        ?>
</body>
