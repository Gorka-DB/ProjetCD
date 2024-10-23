<?php
session_start();
session_unset();
session_destroy();
echo '<body onLoad="alert(\'Vous avez été deconnecté\')">';
header('Location: index.php');
