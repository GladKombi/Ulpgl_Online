<?php
include('../../connexion/connexion.php');
#modification
if (isset($_POST['Valider']) && !empty($_GET['idClass'])) {
  $id = $_GET['idClass'];
  $description = htmlspecialchars($_POST['description']);
  $Option = htmlspecialchars($_POST['Option']);
  if (!empty($description)) {
    #verifier si le client existe ou pas dans la bd
    $statut = 0;
    $getClass = $connexion->prepare("SELECT * FROM `classe` WHERE `nomclasse`=? AND options=? AND supprimer=?");
    $getClass->execute([$description, $Option, $statut]);
    ($Class = $getClass->fetch());
    if ($Class > 0) {
      $msg = 'Cette Class existe déjà dans la base de données !';
      $_SESSION['msg'] = $msg;
      header("location:../../views/classe.php");
    } else {
      $req = $connexion->prepare("UPDATE `classe` SET `nomclasse`=?,`options`=? WHERE id=?");
      $resultat = $req->execute([$description,$Option,$id]);
      if ($resultat == true) {
        $_SESSION['msg'] = "La modification réussi";
        header("location:../../views/classe.php");
      } else {
        $_SESSION['msg'] = "Echec de la modification";
        header("location:../../views/classe.php");
      }
    }
  }
} else {
  header("location:../../views/classe.php");
}
