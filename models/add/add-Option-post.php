<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['Valider'])){
    $description=htmlspecialchars($_POST['description']);
    if(!empty($description)){
      #verifier si le client existe ou pas dans la bd
      $statut=0;
      $getOption=$connexion->prepare("SELECT * FROM `option` WHERE `Description`=? AND statut=?");
      $getOption->execute([$description,$statut]);
      ($option=$getOption->fetch());
      if($option>0){
        $msg='Cette Option existe déjà dans la base de données !';  
        $_SESSION['msg']=$msg;
        header("location:../../views/Option.php");
      }else{ 
        //Insertion data from database
        $req=$connexion->prepare("INSERT INTO `option`(`Description`, `statut`) VALUES(?,?)");
        $resultat=$req->execute([$description,$statut]);
        if($resultat==true){
          $_SESSION['msg']="Un Enregistrement viens d'etre effectué !";
          header("location:../../views/Option.php");
        }
        else{
          $_SESSION['msg']="Echec d'enregistrement !";
          header("location:../../views/Option.php");
        }
      }
    }
    else{
      $_SESSION['msg']="Completer tous les champs SVP !";
      header("location:../../views/Option.php");
    }
  }
  else{
    header('location:../../views/Option.php');
  }
