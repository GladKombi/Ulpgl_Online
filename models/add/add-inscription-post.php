<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
    $date = date("Y-m-d");
    $eleve = htmlspecialchars($_POST['eleve']);
    $promotion = htmlspecialchars($_POST['promotion']);
    $statut = 0;
    
    if (!empty($eleve)) {
        //Insertion data from database
        $req = $connexion->prepare("INSERT INTO `inscription`(`date`, `eleve`, `promotion`, `statut`) VALUES (?,?,?,?)");
        $resultat = $req->execute([$date, $eleve, $promotion, $statut]);
        if ($resultat == true) {
            $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
            header("location:../../views/inscription.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/inscription.php");
        }
    } else {
        $_SESSION['msg'] = "Completer tous les champs SVP !";
        header("location:../../views/inscription.php");
    }
} else {
    header("location:../../views/inscription.php");
}
