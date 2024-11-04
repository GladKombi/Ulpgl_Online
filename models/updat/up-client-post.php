<?php
  include('../../connexion/connexion.php');
  if(isset($_POST['Modifier']) && !empty($_GET['idclient'])){
    $id=$_GET['idclient'];
    $nom=htmlspecialchars($_POST['Nom']);
    $telephone=htmlspecialchars($_POST['telephone']);
    if(is_numeric($telephone)){
      #verifier si le client existe ou pas dans la bd
      $getClients=$connexion->prepare("SELECT * FROM `client` WHERE nom=? AND telephone=? AND supprimer=?");
      $getClients->execute([$nom, $telephone, 0]);
      ($tab=$getClients->fetch());
      if($tab>0){
        $msg='Un client avec le meme nom et le meme numero existe deja dans la base de données';  
        $_SESSION['msg']=$msg;
        header("location:../../views/client.php");
      }else{ 
        //Insertion des modifications
        $req=$connexion->prepare("UPDATE `client` SET  nom=?,telephone=? WHERE id='$id'");
        $req->execute([$nom,$telephone]);
        if($req==true){
          $msg="Les Modifications viennent d'etre sauvegardées !";
          $_SESSION['msg']=$msg;
          header("location:../../views/client.php");
        }
        else{
          $_SESSION['msg']="Echec de modification !";
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
    header("location:../../views/client.php");
  }
?>