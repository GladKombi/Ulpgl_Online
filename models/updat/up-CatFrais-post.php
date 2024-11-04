<?php
include('../../connexion/connexion.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idCatFrais'])) {
    $id = $_GET['idCatFrais'];
    $description = htmlspecialchars($_POST['description']);
    if (!empty($description)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getCatFrais = $connexion->prepare("SELECT * FROM `catfrais` WHERE `Description`=? AND statut=?");
        $getCatFrais->execute([$description, $statut]);
        ($option = $getCatFrais->fetch());
        if ($option > 0) {
            $msg = 'Cette Categorie de frais existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/CatFrais.php");
        } else {
            $req = $connexion->prepare("UPDATE `catfrais` SET `description`=?  WHERE id='$id'");
            $resultat = $req->execute([$description]);
            if ($resultat == true) {
                $_SESSION['msg'] = "La modification réussi";
                header("location:../../views/catfrais.php");
            } else {
                $_SESSION['msg'] = "Echec de la modification";
                header("location:../../views/catfrais.php");
            }
        }
    }
} else {
    header("location:../../views/catfrais.php");
}
