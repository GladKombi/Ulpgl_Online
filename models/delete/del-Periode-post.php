<?php
  include('../../connexion/connexion.php');

  if (isset($_GET['idSupPeriode']) && !empty($_GET['idSupPeriode'])) {
    $id=$_GET['idSupPeriode'];
    $supprimer=1;
    $req=$connexion->prepare("UPDATE periode SET statut=? WHERE id=?");
    $resultat=$req->execute([$supprimer,$id]);
    #Si oui, la variable resultat va retourée true, donc il y a eu une modification
    if($resultat==true){
      $_SESSION['msg']= "La Suppression réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
      header("location:../../views/Periode.php");
    }
    else{
        $_SESSION['msg']= "Echec de Suppression";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucune modification
        header("location:../../views/Periode.php");
    }
  }
  else{
    header("location:../../views/Periode.php");
  }