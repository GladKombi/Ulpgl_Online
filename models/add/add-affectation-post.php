<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $date = date("Y-m-d");
    $enseignants = htmlspecialchars($_POST['enseignants']);
    $cours = htmlspecialchars($_POST['cours']);
    if (!empty($enseignants)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getAffectation = $connexion->prepare("SELECT * FROM `affectation` WHERE `enseignant`=? AND enseignant=? AND supprimer=?");
        $getAffectation->execute([$enseignants, $cours, $statut]);
        ($Affectation = $getAffectation->fetch());
        if ($Affectation > 0) {
            $msg = "Le cours que vous avez selectionner a deja été attribuer à l'enseignant que vous avez selectionner  !";
            $_SESSION['msg'] = $msg;
            header("location:../../views/Affectation.php");
        } else {
            //Insertion data from database
            $req = $connexion->prepare("INSERT INTO `affectation`(`cours`, `enseignant`, `date_affectation`, `supprimer`) VALUES (?,?,?,?)");
            $resultat = $req->execute([$cours, $enseignants, $date, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
                header("location:../../views/Affectation.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/Affectation.php");
            }
        }
    } else {
        $_SESSION['msg'] = "Completer tous les champs SVP !";
        header("location:../../views/Affectation.php");
    }
} else {
    header('location:../../views/Affectation.php');
}
