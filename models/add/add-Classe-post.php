<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['Valider'])){
    $description=htmlspecialchars($_POST['description']);
    $Option=htmlspecialchars($_POST['Option']);
    if(!empty($description)){
      #verifier si le client existe ou pas dans la bd
      $statut=0;
      $getClass=$connexion->prepare("SELECT * FROM `classe` WHERE `nomclasse`=? AND options=? AND supprimer=?");
      $getClass->execute([$description,$Option,$statut]);
      ($Class=$getClass->fetch());
      if($Class>0){
        $msg='Cette Class existe déjà dans la base de données !';  
        $_SESSION['msg']=$msg;
        header("location:../../views/classe.php");
      }else{ 
        //Insertion data from database
        $req=$connexion->prepare("INSERT INTO `classe`(`nomclasse`, `options`, `supprimer`) VALUES (?,?,?)");
        $resultat=$req->execute([$description,$Option,$statut]);
        if($resultat==true){
          $_SESSION['msg']="Un Enregistrement viens d'etre effectué !";
          header("location:../../views/classe.php");
        }
        else{
          $_SESSION['msg']="Echec d'enregistrement !";
          header("location:../../views/classe.php");
        }
      }
    }
    else{
      $_SESSION['msg']="Completer tous les champs SVP !";
      header("location:../../views/classe.php");
    }
  }
  else{
    header('location:../../views/classe.php');
  }
