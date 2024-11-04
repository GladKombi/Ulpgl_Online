<?php
  include('../../connexion/connexion.php');
  #modification
  if(isset($_POST['valider'])){
    $id=$_GET['idpro'];
    $nom=htmlspecialchars($_POST['nom']);
    $seuil=htmlspecialchars($_POST['seuil']);
    $categorie=htmlspecialchars($_POST['categorie']);

    $req=$connexion->prepare("UPDATE produit SET  nom=?,seuil=?,categorie=? WHERE id='$id'");
    $resultat=$req->execute([$nom,$seuil,$categorie]);
    #Si oui, la variable resultat va retourée true, donc il y a eu une modification
    if($resultat==true){
      $_SESSION['msg']= "La modification réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
      header("location:../../views/produits.php");
    }
    else{
        $_SESSION['msg']= "Echec de la modification";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucune modification
        header("location:../../views/produits.php");
    }
  }else{
    //Cette ligne permet de rediriger l'utiliseteur lors qu'il a pas cliquer sur le button qui sert à modifier
    header("location:../../views/produits.php");
  }