<head>
<?php
    include 'include.php';
?>
    <meta charset="UTF-8">
</head>

<body>
<?php

$sql = "SELECT * FROM CD WHERE id =".$_GET['id'];
$test = $connexion->query($sql);
$array = ($test->fetch_array(MYSQLI_ASSOC));

    print('<img src='.$array['chemin_img'].' alt="TEST">');
    $titre = str_replace('_', ' ', $array["titre"]);
    print('<h5 class="">'.$titre.'</h5>');
    $auteur = str_replace('_', ' ', $array["auteur"]);
    print('<p class="">'.$auteur.'</p>');
    $genre = str_replace('_', ' ', $array["genre"]);
    print('<p class="">'.$genre.'</p>');
    print('<p class="">'.$array["prix"].'</p>');
    print('<a href="accueil.php">Retour</a>');
?>
</body>

<!--$_POST["titre"]-->