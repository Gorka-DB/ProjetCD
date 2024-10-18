<head>
    <?php
    include "include.php";
    ?>
</head>
<body>
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
<form ENCTYPE="multipart/form-data" ACTION="upload.php" METHOD="POST">
    <p><input type="text" name="titre"></p>
    <p><input type="text" name="genre"></p>
    <p><input type="text" name="auteur"></p>
    <p><input type="number" name="prix"></p>
    <p><input type=file name="photo"></p>
    <p><input type=submit name="envoiphoto"></p>
</form>
</body>
