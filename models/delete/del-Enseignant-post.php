<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupEns']) && !empty($_GET['idSupEns'])) {
    $id=$_GET['idSupEns'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE `enseigant` SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi";
      header("location:../../views/Enseigants.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";
        header("location:../../views/Enseigants.php");
    }
  }
  else{
    header("location:../../views/Enseigants.php");
  }