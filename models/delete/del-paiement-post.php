<?php
//la connexion a la base de donnees
include_once('../../connexion/connexion.php');

//la creation de l'evenement qui sert à envoyer les données à la base de données
//Lors qu'on a cliquer sur le bouton valider

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $_id = $_GET['id'];
    $_supprimer = 1;

    $_delData = $connexion->prepare("UPDATE paiement SET supprimer=? WHERE id=?");
    $_rows = $_delData->execute([$_supprimer, $_id]);
    if ($_rows == 1) {
        $_SESSION['msg'] = "La suppression reussie";
        header("Location:../../views/paiement.php");
    } else {
        $_SESSION['msg'] = "Echec de la suppression";
        header("Location:../../views/paiement.php");
    }
} else {
    header("Location:../../views/paiement.php");
}
