<?php
//la connexion a la base de données
include_once('../../connexion/connexion.php');

//la creation de l'evenement qui sert à envoyer les données à la base de données
//Lors qu'on a cliquer sur le bouton valider

if (isset($_POST['send'])) {
    $_description = htmlspecialchars($_POST['description']);
    $_montant = htmlspecialchars($_POST['montant']);
    $_commande = htmlspecialchars($_POST['commande']);
    $_supp = 0;


    //la requete qui envoi les données de la base de données
    $_sendData = $connexion->prepare("INSERT INTO dettes VALUES (NULL,NOW(),?,?,?,?)");
    $_rows = $_sendData->execute([$_description, $_montant, $_commande, $_supp]);
    if ($_rows == true) {
        $_SESSION['msg'] = "Enregistrement reussie";
        header("Location:../../views/dettes.php");
    } else {
        $_SESSION['msg'] = "Echec d'enregistrement";
        header("Location:../../views/dettes.php");
    }
} else {
    header("Location:../../views/dettes.php");
}
