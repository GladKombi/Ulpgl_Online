<?php
  include('../../connexion/connexion.php');
  #modification
  if(isset($_POST['valider']) && !empty($_GET['idcat'])){
    $id=$_GET['idcat'];
    $description=htmlspecialchars($_POST['description']);

    $req=$connexion->prepare("UPDATE `typeproduit` SET description=?  WHERE id='$id'");
    $resultat=$req->execute([$description]);//Il faut stocker la requette dans la variable qui s'appel resultat, pour qu'on sache que la requette a été exequitée ou pas

    #Si oui, la variable resultat va retourée true, donc il y a eu une modification
    if($resultat==true){
      $_SESSION['msg']= "La modification réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
      header("location:../../views/categories.php");
    }
    else{
        $_SESSION['msg']= "Echec de la modification";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucune modification
        header("location:../../views/categories.php");
    }
  }else{
    //Cette ligne permet de rediriger l'utiliseteur lors qu'il a pas cliquer sur le button qui sert à modifier
    header("location:../../views/categories.php");
  }