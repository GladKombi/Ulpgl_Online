<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $description = htmlspecialchars($_POST['description']);
    $maxima = htmlspecialchars($_POST['maxima']);
    if (!empty($description)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getCours = $connexion->prepare("SELECT * FROM `cours` WHERE `nomcours`=? AND supprimer=?");
        $getCours->execute([$description, $statut]);
        ($Cours = $getCours->fetch());
        if ($Cours > 0) {
            $msg = 'Cette Cours de frais existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/Cours.php");
        } else {
            //Insertion data from database
            $req = $connexion->prepare("INSERT INTO `cours`(`nomcours`, `maxima`, `supprimer`) VALUES(?,?,?)");
            $resultat = $req->execute([$description, $maxima, $statut]);
            if ($resultat == true) {
                $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
                header("location:../../views/Cours.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement !";
                header("location:../../views/Cours.php");
            }
        }
    } else {
        $_SESSION['msg'] = "Completer tous les champs SVP !";
        header("location:../../views/Cours.php");
    }
} else {
    header('location:../../views/Cours.php');
}
