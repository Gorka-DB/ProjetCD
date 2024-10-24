<head>
<?php
    session_start();
    include 'include.php';
?>
    <meta charset="UTF-8">
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

$sql = "SELECT * FROM CD WHERE id =".$_GET['id'];
$test = $connexion->query($sql);
$array = ($test->fetch_array(MYSQLI_ASSOC));
    print('<img src='.str_replace(' ','_',urldecode($array['chemin_img'])).' alt="TEST" >');
    $titre = urldecode($array["titre"]);
    print('<h5 class="">'.$titre.'</h5>');
    $auteur = urldecode($array["auteur"]);
    print('<p class="">'.$auteur.'</p>');
    $genre = urldecode($array["genre"]);
    print('<p class="">'.$genre.'</p>');
    print('<p class="">'.$array["prix"].'</p>');
    print('<a href="index.php">Retour</a>');
?>
</body>