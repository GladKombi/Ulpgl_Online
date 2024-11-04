<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupEleve']) && !empty($_GET['idSupEleve'])) {
    $id=$_GET['idSupEleve'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE `eleve` SET statut=? WHERE matricule=?");
    $resultat=$req->execute([$supprimer,$id]);
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi";
      header("location:../../views/eleves.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";
        header("location:../../views/eleves.php");
    }
  }
  else{
    header("location:../../views/eleves.php");
  }