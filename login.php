<?php
include "include.php"
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Formulaire d'identification</title>
</head>
<body>

<main class="form-signin w-100 m-auto">
    <form action="test_login.php" method="post">
        <h1 class="h3 mb-3 fw-normal">Connectez-vous</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="login" name="login" placeholder="Votre identifiant">
            <label for="floatingInput">Nom d'utilisateur</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
            <label for="floatingPassword">Mot de passe</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
    </form>
</main>
</body>
</html>



