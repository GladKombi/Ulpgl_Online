<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['Valider'])){
    $description=htmlspecialchars($_POST['description']);
    if(!empty($description)){
      #verifier si le client existe ou pas dans la bd
      $statut=0;
      $getCatFrais=$connexion->prepare("SELECT * FROM `catfrais` WHERE `Description`=? AND statut=?");
      $getCatFrais->execute([$description,$statut]);
      ($Categorie=$getCatFrais->fetch());
      if($Categorie>0){
        $msg='Cette Categorie de frais existe déjà dans la base de données !';  
        $_SESSION['msg']=$msg;
        header("location:../../views/CatFrais.php");
      }else{ 
        //Insertion data from database
        $req=$connexion->prepare("INSERT INTO `catfrais`(`Description`, `statut`) VALUES(?,?)");
        $resultat=$req->execute([$description,$statut]);
        if($resultat==true){
          $_SESSION['msg']="Un Enregistrement viens d'etre effectué !";
          header("location:../../views/CatFrais.php");
        }
        else{
          $_SESSION['msg']="Echec d'enregistrement !";
          header("location:../../views/CatFrais.php");
        }
      }
    }
    else{
      $_SESSION['msg']="Completer tous les champs SVP !";
      header("location:../../views/CatFrais.php");
    }
  }
  else{
    header('location:../../views/CatFrais.php');
  }
