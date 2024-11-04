<?php
include('../../connexion/connexion.php');
# Appel de la fonction qui permet de vefier la date de naissance
require_once('../../fonction/function.php');
if (isset($_POST['Valider'])) {
    # Creation du matricule
    $req = $connexion->prepare("SELECT * FROM eleve ORDER BY matricule DESC LIMIT 1 ");
    $req->execute();
    if ($mat = $req->fetch()) {
        $valeur = $mat['matricule'];
        if (strlen($valeur) == 9) {
            $numero = substr($valeur, 4, 1) + 1;
            echo $numero;
        } else {
            $nb = strlen($valeur) - 9 + 1;
            $numero = substr($valeur, 4, $nb) + 1;
            echo $numero;
        }
    } else {
        $numero = 1;
    }
    $annee= date('Y');
    $matricule="CSSC".$numero."/".$annee;
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
        $getEleve = $connexion->prepare("SELECT * FROM `eleve` WHERE nom=? AND Postnom=? AND Prenom=? AND `numeroParent`=? AND statut=?");
        $getEleve->execute([$nom, $postnom, $prenom, $phone, $statut]);
        ($Eleve = $getEleve->fetch());
        if ($Eleve > 0) {
            $msg = 'Cet élève existe déjà dans la base de données !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/eleves.php");
        } else {
            $aujourd_hui = date("Y-m-d");
            if ($DateNaissance > $aujourd_hui) {
                $_SESSION['msg'] = "la date Connard !";
                header("location:../../views/eleves.php");
            } else {
                $age = calculerAge($DateNaissance);
                if ($age < 3) {
                    $_SESSION['msg'] = "L'âge de : " . $age . " ans ne pas autoriser !";
                    header("location:../../views/eleves.php");
                } else {
                    //Insertion data from database
                    $req = $connexion->prepare("INSERT INTO `eleve`(matricule, nom, postnom, prenom, genre, adresse, lieuNaissance, dateNaissance, nomPere, nomMere, numeroParent, photo, statut) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $resultat = $req->execute([$matricule, $nom, $postnom, $prenom, $genre, $Adresse, $LieuNaissance, $DateNaissance, $NomPere, $NomMere, $phone, $photo, $statut]);
                    if ($resultat == true) {
                        $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
                        header("location:../../views/eleves.php");
                    } else {
                        $_SESSION['msg'] = "Echec d'enregistrement !";
                        header("location:../../views/eleves.php");
                    }
                }
            }
        }
    } else {
        $_SESSION['msg'] = "Le numero de télèphone ne doit containir que des chiffres !";
        header("location:../../views/eleves.php");
    }
} else {
    header('location:../../views/eleves.php');
}
