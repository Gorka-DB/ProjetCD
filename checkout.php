<?php
include "protection.php";
include "include.php";
?>
<?php
if(isset($_POST['cc-expiration'], $_POST['cc-number'], $_POST['cc-name'], $_POST['cc-cvv'])){
    $timezone = new DateTimeZone('Europe/Paris');
    $datedujour = new DateTime('now', $timezone);
    $datemini = (clone $datedujour);
    $datemini->modify(' + 3 months');
    $dateclient = DateTime::createFromFormat('m/y', $_POST['cc-expiration'], $timezone);

    if($_POST['cc-number'][-1] != $_POST['cc-number'][0]){
        echo '<body onLoad="alert(\'NUMERO INVALIDE...\')">';
    }
    if($dateclient < $datemini){
        echo '<body onLoad="alert(\'DATE INVALIDE...\')">';
    }
    else if($dateclient >= $datemini && $_POST['cc-number'][-1] == $_POST['cc-number'][0]){
        echo '<body onLoad="alert(\'ACHAT OK...\')">';
        $_SESSION['panier'] = array();
        $_SESSION['total'] = 0.00;
        echo '<meta http-equiv="refresh" content="0;URL=panier.php?achat=oui">';
        //header('location: panier.php?achat=oui');
        //retour sur page panier avec panier vidé + notif de paiement effectué sur page panier
    }
}
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

<div class="container mt-5">
    <main>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                        <span>Total (EUR)</span>
                        <strong><?=$_SESSION['total']?>€</strong>
            </div>
            <div class="col-md-7 col-lg-8">
                <form class="needs-validation" action="checkout.php" method="POST">
                    <h4 class="mb-3">Paiement</h4>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Nom sur la carte</label>
                            <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required>
                            <small class="text-body-secondary">Nom complet écrit sur la carte</small>
                            <div class="invalid-feedback">
                                Nom sur la carte requis
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Numéro de carte</label>
                            <input type="text" pattern='[0-9]{16}' maxlength="16" class="form-control" id="cc-number" name="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Numéro de carte requis
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" maxlength="5" id="cc-expiration" name="cc-expiration" placeholder="MM/AA" required>
                            <div class="invalid-feedback">
                                date d'expiration requise
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" maxlength="3" id="cc-cvv" name="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Payer</button>
                </form>
            </div>
        </div>
    </main>
</div>

</html>

