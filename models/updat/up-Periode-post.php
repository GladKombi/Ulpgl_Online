<?php
include('../../connexion/connexion.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idPreiode'])) {
    $id = $_GET['idPreiode'];
    $description = htmlspecialchars($_POST['description']);
    if (!empty($description)) {
       #verifier si la periode existe ou pas dans la bd
      $statut=0;
      $getPeriode=$connexion->prepare("SELECT * FROM `periode` WHERE `libelle`=? AND statut=?");
      $getPeriode->execute([$description,$statut]);
      ($periode=$getPeriode->fetch());
      if($periode>0){
        $msg='Cette periode existe déjà dans la base de données !';  
        $_SESSION['msg']=$msg;
        header("location:../../views/Periode.php");
        } else {
            $req = $connexion->prepare("UPDATE `periode` SET `libelle`=?  WHERE id='$id'");
            $resultat = $req->execute([$description]);
            if ($resultat == true) {
                $_SESSION['msg'] = "La modification réussi";
                header("location:../../views/Periode.php");
            } else {
                $_SESSION['msg'] = "Echec de la modification";
                header("location:../../views/Periode.php");
            }
        }
    }
} else {
    header("location:../../views/Periode.php");
}
