<?php
include('../../connexion/connexion.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idEnseignant'])) {
    $id = $_GET['idEnseignant'];
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $Adresse = htmlspecialchars($_POST['adresse']);
    $phone = htmlspecialchars($_POST['telephone']);
    $photo = $_FILES['photo']['name'];
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    if (is_numeric($phone)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getClass = $connexion->prepare("SELECT * FROM `enseigant` WHERE nom=? AND postnom=? AND prenom=? AND genre=? AND adress=? AND `telephone`=? AND statut=?");
        $getClass->execute([$nom, $postnom, $prenom, $genre, $Adresse, $phone, $statut]);
        ($Class = $getClass->fetch());
        if ($Class > 0) {
            $msg = 'Modifiation reussi !';
            $_SESSION['msg'] = $msg;
            header("location:../../views/Enseigants.php");
        } else {
            $getFourDepli = $connexion->prepare("SELECT * FROM `enseigant` WHERE `telephone`=? AND statut=? AND id!=?");
            $getFourDepli->execute([$phone, $statut, $id]);
            $tab = $getFourDepli->fetch();
            if ($tab > 0) {
                $_SESSION['msg'] = "Vous tenter d'enregister un numero de téléphone qui est utiliser dans le système. Verifier si c'est ne pas la même personne !";
                header("location:../../views/utilisateur.php");
            } else {
                $req = $connexion->prepare("UPDATE `enseigant` SET `nom`=?,`postnom`=?,`prenom`=?,`genre`=?,`telephone`=?,`adress`=?,`photo`=? WHERE id=?");
                $resultat = $req->execute([$nom, $postnom, $prenom, $genre, $phone, $Adresse, $photo, $id]);
                if ($resultat == true) {
                    $_SESSION['msg'] = "La modification réussi";
                    header("location:../../views/Enseigants.php");
                } else {
                    $_SESSION['msg'] = "Echec de la modification";
                    header("location:../../views/Enseigants.php");
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
