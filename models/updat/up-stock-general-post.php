<?php
    include '../../connexion/connexion.php';
    if(isset($_POST['Modifier']) && !empty($_GET['id'])){
        $id=$_GET['id'];
        $descriptoin=htmlspecialchars($_POST['description']);
        $qte=htmlspecialchars($_POST['qte']);
        $PU=htmlspecialchars($_POST['pu']);
        $produit=htmlspecialchars($_POST['produit']);
        $fourniseur=htmlspecialchars($_POST['fournisseur']);
        $req=$connexion->prepare("SELECT * FROM stock_general where description=? and quantite=? and prix_unitaire=? and produit=? and frounisseur=?");
        $req->execute(array($descriptoin,$qte,$PU,$produit,$fourniseur));
        $exist=$req->fetch();
            if($exist['id']>=1){
                $_SESSION['msg']=" ce stock general existe deja";
                header('location:../../views/stock-general.php');
            }else{
                
                if(is_numeric($_POST['pu']))
                {
                
                    $req=$connexion->prepare("UPDATE  stock_general set description=?,quantite=?,prix_unitaire=?,produit=?,frounisseur=? where id='$id'");
                    $req->execute(array($descriptoin,$qte,$PU,$produit,$fourniseur));
                    if($req){
                        $_SESSION['msg']="Modification reussie";
                        header('location:../../views/stock-general.php');
                    }else{
                        $_SESSION['msg']="Echec de la modification";
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