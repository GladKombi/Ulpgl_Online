<?php
include('../../connexion/connexion.php');

if(isset($_POST['valider']) && !empty($_GET['idfour'])){
    $id=$_GET['idfour'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $adresse=htmlspecialchars($_POST['adresse']);
    $telephone=htmlspecialchars($_POST['telephone']);
   
     //select data from database
    
      $req=$connexion->prepare("UPDATE fornisseur SET  nom=?,postnom=?,prenom=?,genre=?,adresse=?,telephone=? WHERE id=?");
      $resultat=$req->execute([$nom,$postnom,$prenom,$genre,$adresse,$telephone, $id]);
      #Si oui, la variable resultat va retourée true, donc il y a eu une modification
    if($resultat==true){
      $_SESSION['msg']= "La modification réussie";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
      header("location:../../views/fournisseur.php");
    }
    else{
        $_SESSION['msg']= "Echec de la modification";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucune modification
        header("location:../../views/fournisseur.php");
    }
  }else{
    //Cette ligne permet de rediriger l'utiliseteur lors qu'il a pas cliquer sur le button qui sert à modifier
    header("location:../../views/fournisseur.php");
  }