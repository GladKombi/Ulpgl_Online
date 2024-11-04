<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupCatFrais']) && !empty($_GET['idSupCatFrais'])) {
    $id=$_GET['idSupCatFrais'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE catfrais SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    #Si oui, la variable resultat va retourée true, donc il y a eu une modification
    if($resultat==true){
      $_SESSION['msg']= "La Suppression a réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
      header("location:../../views/CatFrais.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucune modification
        header("location:../../views/CatFrais.php");
    }
  }
  else{
    header("location:../../views/CatFrais.php");
  }