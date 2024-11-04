<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $montant = htmlspecialchars($_POST['montant']);
    $periode = htmlspecialchars($_POST['periode']);
    if (!empty($montant)) {
        //Insertion data from database
        $statut=0;
        $req = $connexion->prepare("INSERT INTO `seuil`(`montant`, `periode`, `statut`) VALUES(?,?,?)");
        $resultat = $req->execute([$montant, $periode, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/AnneeScolaire.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/AnneeScolaire.php");
        }
    } else {
        $_SESSION['msg'] = "Completer tous les champs SVP !";
        header("location:../../views/AnneeScolaire.php");
    }
} else {
    $_SESSION['msg'] = "Completer tous les champs SVP !";
    header("location:../../views/AnneeScolaire.php");
}
