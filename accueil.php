<head>
    <?php
    include "include.php";
    ?>
</head>
<body>
<?php
$sql = "SELECT * FROM CD";
$test = $connexion->query($sql);
$array = ($test->fetch_all(MYSQLI_ASSOC));

for ($i=0; $i < count($array); $i++) {
    print('<div class="card" style="width: 18rem;">');
    print("<a href='detail.php?id=".$array[$i]['id']."'>".'<img src=resize.php?titre='.$array[$i]['titre'].'&img='.$array[$i]['chemin_img'].' class="card-img-top" alt="TEST"></a>');
    print('<div class="card-body">');
    $titre = str_replace('_', ' ', $array[$i]["titre"]);
    print('<h5 class="card-title">'.$titre.'</h5>');
    $auteur = str_replace('_', ' ', $array[$i]["auteur"]);
    print('<p class="card-text">'.$auteur.'</p>');
    $genre = str_replace('_', ' ', $array[$i]["genre"]);
    print('<p class="card-text">'.$genre.'</p>');
    print('<p class="card-text">'.$array[$i]["prix"].'</p>');
    print('</div>');
    print('</div>');
}
?>
</body>

<!--<img src=resize.php?titre='.$array[$i]['titre'].'&img='.$array[$i]['chemin_img'].' class="card-img-top" alt="TEST">-->
