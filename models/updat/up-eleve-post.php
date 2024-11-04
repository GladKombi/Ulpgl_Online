<?php
include('../../connexion/connexion.php');
# Appel de la fonction qui permet de vefier la date de naissance
require_once('../../fonction/function.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idEleve'])) {
    $id = $_GET['idEleve'];
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $LieuNaissance = htmlspecialchars($_POST['LieuNaissance']);
    $DateNaissance = htmlspecialchars($_POST['DateNaissance']);
    $Adresse = htmlspecialchars($_POST['adress']);
    $NomPere = htmlspecialchars($_POST['NomPere']);
    $NomMere = htmlspecialchars($_POST['NomMere']);
    $phone = htmlspecialchars($_POST['telephone']);
    $photo = $_FILES['photo']['name'];
    $upload = "../../photo/profilEleve/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    $statut = 0;
    if (is_numeric($phone)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getEleve = $connexion->prepare("SELECT * FROM `eleve` WHERE nom=? AND postnom=? AND prenom=? AND genre=? AND adresse=? AND lieuNaissance=? AND nomPere=? AND nomMere=? AND numeroParent=? AND statut=?");
        $getEleve->execute([$nom, $postnom, $prenom, $genre, $Adresse, $LieuNaissance, $NomPere, $NomMere, $phone, $statut]);
        ($Eleve = $getEleve->fetch());
        if ($Eleve > 0) {
            $msg = 'Modification reussi !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/eleves.php");
        }
        $getEleve = $connexion->prepare("SELECT * FROM `eleve` WHERE nom=? AND Postnom=? AND Prenom=? AND `numeroParent`=? AND statut=? AND matricule!=?");
        $getEleve->execute([$nom, $postnom, $prenom, $phone, $statut,$id]);
        ($Eleve = $getEleve->fetch());
        if ($Eleve > 0) {
            $msg = 'Cet élève existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/eleves.php");
        } else {
            $aujourd_hui = date("Y-m-d");
            if ($DateNaissance > $aujourd_hui) {
                $_SESSION['msg'] = "Veillez selectionner Séléctionner une date Anterieur !";
                header("location:../../views/eleves.php");
            } else {
                $age = calculerAge($DateNaissance);
                if ($age < 3) {
                    $_SESSION['msg'] = "L'âge de : " . $age . " ans ne pas autoriser !";
                    header("location:../../views/eleves.php");
                } else {
                    //Insertion data from database
                    $req = $connexion->prepare("UPDATE `eleve` SET nom=?, postnom=?, prenom=?, genre=?, adresse=?, lieuNaissance=?, dateNaissance=?, nomPere=?, nomMere=?, numeroParent=?, photo=?, statut=? WHERE matricule=?");
                    $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $Adresse, $LieuNaissance, $DateNaissance, $NomPere, $NomMere, $phone, $photo, $statut, $id]);
                    if ($resultat == true) {
                        $_SESSION['msg'] = "Modification reussi !";
                        header("location:../../views/eleves.php");
                    } else {
                        $_SESSION['msg'] = "Echec d'enregistrement !";
                        header("location:../../views/eleves.php");
                    }
                }
            }
        }
    } else {
        $_SESSION['msg'] = "Le numero de telephone ne doit pas contenir des caracteres Alphanumerique";
        header("location:../../views/Enseigants.php");
    }
} else {
    header("location:../../views/Enseigants.php");
}
