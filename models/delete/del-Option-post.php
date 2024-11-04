<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupOption']) && !empty($_GET['idSupOption'])) {
    $id=$_GET['idSupOption'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE `option` SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi";
      header("location:../../views/Option.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";
        header("location:../../views/Option.php");
    }
  }
  else{
    header("location:../../views/Option.php");
  }