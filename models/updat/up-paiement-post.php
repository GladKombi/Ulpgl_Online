<?php
//la connexion a la base de donnees
include_once('../../connexion/connexion.php');

//la creation de l'evenement qui sert à envoyer les données à la base de données
//Lors qu'on a cliquer sur le bouton valider

if (isset($_POST['send']) && isset($_GET['id']) && !empty($_GET['id'])) {
    $_id = $_GET['id'];
    $_description = htmlspecialchars($_POST['description']);
    $_montant = htmlspecialchars($_POST['montant']);
    $_commande = htmlspecialchars($_POST['commande']);

    $_upData = $connexion->prepare("UPDATE paiement SET description=?, montant=?, commande=? WHERE id=?");
    $_rows = $_upData->execute([$_description, $_montant, $_commande, $_id]);
    if ($_rows == 1) {
        $_SESSION['msg'] = "La modification reussie";
        header("Location:../../views/paiement.php");
    } else {
        $_SESSION['msg'] = "Echec de la modification";
        header("Location:../../views/paiement.php?idMod=" . $_id);
    }
} else {
    header("Location:../../views/paiement.php");
}
