<?php 
    include '../../connexion/connexion.php';
    if(isset($_POST['Enregistrer']))
    {
        $date=date("Y-m-d");
        $descriptoin=htmlspecialchars($_POST['description']);
        $qte=htmlspecialchars($_POST['qte']);
        $PU=htmlspecialchars($_POST['pu']);
        $produit=htmlspecialchars($_POST['produit']);
        $fourniseur=htmlspecialchars($_POST['fournisseur']);

        //Verifier bien cette requette 
        $req=$connexion->prepare("SELECT * FROM stock_general where description=? and quantite=? and prix_unitaire=? and produit=? and frounisseur=?");
        $req->execute(array($descriptoin,$qte,$PU,$produit,$fourniseur));
        
        if($exist=$req->fetch()){
           // $id=$exist['id'];
            //  $req=$connexion->prepare("UPDATE stock_general set quantite=?,prix_unitaire=? where id=?");
            // $req->execute(array($qte,$PU, $id));
            $_SESSION['msg']=" ce produit  existe deja ";
            header('location:../../views/stock-general.php');
        }else{
            if(is_numeric($_POST['pu']))
            {
               
                $req=$connexion->prepare("INSERT INTO stock_general (dates, description, quantite, prix_unitaire, produit, frounisseur) values (?,?,?,?,?,?) ");
                $req->execute(array($date,$descriptoin,$qte,$PU,$produit,$fourniseur));
                if($req){
                    $_SESSION['msg']="enregistrement reussie";
                    header('location:../../views/stock-general.php');
                }
            }
            else 
            {
                $_SESSION['msg']="le prix unitaire  doit etre numerique";
                header('location:../../views/stock-general.php');
            }
           
        }
    }else{
        header('location:../../views/stock-general.php');
    }