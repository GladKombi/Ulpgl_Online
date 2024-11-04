<?php
include('../../connexion/connexion.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idOption'])) {
    $id = $_GET['idOption'];
    $description = htmlspecialchars($_POST['description']);
    if (!empty($description)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getOption = $connexion->prepare("SELECT * FROM `option` WHERE `Description`=? AND statut=?");
        $getOption->execute([$description, $statut]);
        ($option = $getOption->fetch());
        if ($option > 0) {
            $msg = 'Cette Option existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/Option.php");
        } else {
            $req = $connexion->prepare("UPDATE `option` SET `description`=?  WHERE id='$id'");
            $resultat = $req->execute([$description]); 
            if ($resultat == true) {
                $_SESSION['msg'] = "La modification réussi"; 
                header("location:../../views/Option.php");
            } else {
                $_SESSION['msg'] = "Echec de la modification";
                header("location:../../views/Option.php");
            }
        }
    }
} else {
    header("location:../../views/Option.php");
}
