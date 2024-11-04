<?php 
    include '../../connexion/connexion.php';
    if(isset($_GET['iddel']) && !empty($_GET['iddel'])){
        $id=$_GET['iddel'];
        $supprimer=1;
        //Metter seulement les paramètre lors que vous préparez la requette
        $req=$connexion->prepare("UPDATE entree set supprimer=? where id='$id'");
        $req->execute(array($supprimer));
        if($req){
            $_SESSION['msg']="suppression reussie";
            header('location:../../views/entree.php');
        }else{
            $_SESSION['msg']="Echec de la suppression";
            header('location:../../views/entree.php');
        }
    }else{
        header('location:../../views/entree.php');
    }