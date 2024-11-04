<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupFrais']) && !empty($_GET['idSupFrais'])) {
    $id=$_GET['idSupFrais'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE `frais` SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi";
      header("location:../../views/Frais.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";
        header("location:../../views/Frais.php");
    }
  }
  else{
    header("location:../../views/Frais.php");
  }