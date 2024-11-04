<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['Enregistrer'])){
    $nom=htmlspecialchars($_POST['Nom']);
    $telephone=htmlspecialchars($_POST['telephone']); 
    if(is_numeric($telephone)){
      #verifier si le client existe ou pas dans la bd
      $getClients=$connexion->prepare("SELECT * FROM `client` WHERE telephone=? AND supprimer=?");
      $getClients->execute([$telephone, 0]);
      ($tab=$getClients->fetch());
      if($tab>0){
        $msg='ce client existe dejà dans la base de données';  
        $_SESSION['msg']=$msg;
        header("location:../../views/client.php");
      }else{ 
        //Insertion data from database
        $supprimer=0;
        $req=$connexion->prepare("INSERT INTO `client`(`nom`, `telephone`, `supprimer`) VALUES(?,?,?)");
        $resultat=$req->execute([$nom,$telephone,$supprimer]);
        if($resultat==true){
          $_SESSION['msg']="Un Enregistrement viens d'etre effectué !";
          header("location:../../views/client.php");
        }
        else{
          $_SESSION['msg']="Echec d'enregistrement !";
          header("location:../../views/client.php");
        }
      }
    }
    else{
      $_SESSION['msg']="Le numero du client ne doit pas continir des caracteres alphanumeriques";
      header("location:../../views/client.php");
    }
  }
  else{
    header('location:../../views/client.php');
  }
?>