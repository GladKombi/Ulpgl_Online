<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $date = date('Y-m-d');
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
            //Insertion data into the database
            $req = $connexion->prepare("INSERT INTO `frais`(`date`, `description`, `categorie`, `Montant`, `statut`) VALUES(?,?,?,?,?)");
            $resultat = $req->execute([$date, $description, $categorie, $montant, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Frais Enregistré !";
                header("location:../../views/Frais.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/Frais.php");
            }
        }
    } else {
        $_SESSION['msg'] = "Le montant ne doit que contenir des chiffres !";
        header("location:../../views/Frais.php");
    }
} else {
    header('location:../../views/Frais.php');
}
