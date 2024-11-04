<?php 
    include '../../connexion/connexion.php';
    //Supprimer dans le panier 
    if(isset($_GET['idpanier']) && !empty($_GET['idpanier'])){
        $id=$_GET['idpanier'];
        $supprimer=1;
        $req=$connexion->prepare("UPDATE panier set statut=? where id=?");
        $resultat=$req->execute(array($supprimer,$id));   
        if( $resultat==true){
            $_SESSION['msg']="suppression reussie";
            header('location:../../views/commande.php');
        }else{
            $_SESSION['msg']="Echec de la suppression";
            header('location:../../views/commande.php');
        }
    }else{
        header('location:../../views/commande.php');
    }