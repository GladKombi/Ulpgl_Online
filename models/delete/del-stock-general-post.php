<?php 
    include '../../connexion/connexion.php';
    if(isset($_GET['iddel']) && !empty($_GET['iddel'])){
        $id=$_GET['iddel'];
        $supprimer=1;
        //Metter seulement les paramètre lors que vous préparez la requette
        $req=$connexion->prepare("UPDATE stock_general set supprimer=? where id='$id'");
        $req->execute(array($supprimer));
        if($req){
            $_SESSION['msg']="suppression reussie";
            header('location:../../views/stock-general.php');
        }else{
            $_SESSION['msg']="Echec de la suppression ";
            
        }
    }else{
        header('location:../../views/stock-general.php');
    }
