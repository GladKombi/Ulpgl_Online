<?php
include('../../connexion/connexion.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idFrais'])) {
    $id = $_GET['idFrais'];
    $description = htmlspecialchars($_POST['description']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $montant = htmlspecialchars($_POST['montant']);
    if (is_numeric($montant)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getClass = $connexion->prepare("SELECT * FROM `frais` WHERE `date`=? AND `description`=? AND statut=?");
        $getClass->execute([$date, $description, $statut]);
        ($Class = $getClass->fetch());
        if ($Class > 0) {
            $msg = 'Un frais similaire existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/Frais.php");
        } else {
            $req = $connexion->prepare("UPDATE `frais` SET `description`=?,`categorie`=?,`Montant`=? WHERE id=?");
            $resultat = $req->execute([$description, $categorie, $montant, $id]);
            if ($resultat == true) {
                $_SESSION['msg'] = "La modification réussi !";
                header("location:../../views/Frais.php");
            } else {
                $_SESSION['msg'] = "Echec de la modification !";
                header("location:../../views/Frais.php");
            }
        }
    }else {
        $_SESSION['msg'] = "Le montant ne doit que contenir des chiffres !";
        header("location:../../views/Frais.php");
    }
} else {
    header("location:../../views/Frais.php");
}
