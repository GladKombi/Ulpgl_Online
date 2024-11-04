<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupCours']) && !empty($_GET['idSupCours'])) {
    $id=$_GET['idSupCours'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE cours SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    #Si oui, la variable resultat va retourée true, donc il y a eu une modification
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi";
      header("location:../../views/CatFrais.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";
        header("location:../../views/CatFrais.php");
    }
  }
  else{
    header("location:../../views/CatFrais.php");
  }