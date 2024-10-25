<?php
    session_start();
    
    include 'include.php';
    $sql = "SELECT * FROM cd WHERE id =".$_GET['id'];
    $test = $connexion->query($sql);
    $array = ($test->fetch_array(MYSQLI_ASSOC));
    $titre = urldecode($array["titre"]);
    $auteur = urldecode($array["auteur"]);
    $genre = urldecode($array["genre"]);
?>
<head>
    <meta charset="UTF-8">
    <title>Catalogue - détails de <?=$titre?></title>
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
    print('<img src='.str_replace(' ','_',urldecode($array['chemin_img'])).' alt="TEST" >');
    print('<h5 class="">'.$titre.'</h5>');
    print('<p class="">'.$auteur.'</p>');
    print('<p class="">'.$genre.'</p>');
    print('<p class="">'.$array["prix"].'</p>');
    print('<a href="index.php">Retour</a>');
?>
</body>