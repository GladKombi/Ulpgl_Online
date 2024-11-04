<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $description = htmlspecialchars($_POST['description']);
    $annee = htmlspecialchars($_POST['annee']);
    if (!empty($description)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getPromo = $connexion->prepare("SELECT * FROM `promotion` WHERE nom=? and`anneeSco`=? AND statut=?");
        $getPromo->execute([$description, $annee, $statut]);
        ($promotion = $getPromo->fetch());
        if ($promotion > 0) {
            $msg = 'Cette promotion de frais existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/promotion.php");
        } else {
            //Insertion data from database
            $req = $connexion->prepare("INSERT INTO `promotion`(`nom`, `anneeSco`, `statut`) VALUES (?,?,?)");
            $resultat = $req->execute([$description, $annee, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
                header("location:../../views/promotion.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/promotion.php");
            }
        }
    } else {
        $_SESSION['msg'] = "Completer tous les champs SVP !";
        header("location:../../views/promotion.php");
    }
} else {
    header('location:../../views/promotion.php');
}
