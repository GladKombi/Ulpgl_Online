<?php 
    include '../../connexion/connexion.php';
    if(isset($_POST['Modifier']) && !empty($_GET['id'])){
        $id=$_GET['id'];
        $descriptoin=htmlspecialchars($_POST['description']);
        $qte=htmlspecialchars($_POST['qte']);
        $stock=htmlspecialchars($_POST['stock']);
        $prix=htmlspecialchars($_POST['prix']);
        $boutique=htmlspecialchars($_POST['boutique']);
        $user=htmlspecialchars($_POST['user']);


        $reqee=$connexion->prepare("SELECT sum(quantite) as quantite  from entree where id=? and supprimer=0");
        $reqee->execute(array($id));
        if($quantite=$reqee->fetch())
        {
            $quantite_operation=$quantite['quantite'];
        }
        

       
        
        $req=$connexion->prepare("SELECT quantite,prix_unitaire from stock_general where id='$stock' and supprimer=0");
        $req->execute();
        if($stock_general=$req->fetch())
        {
            $qtegeneral=$stock_general['quantite'];
            $ancienprix=$stock_general['prix_unitaire'];
            
        }
        $reqe=$connexion->prepare("SELECT sum(quantite) as quantite  from entree where stock_general=? and supprimer=0");
        $reqe->execute(array($stock));
        if($stockentree=$reqe->fetch())
        {
            $qteentree=$stockentree['quantite']-$quantite_operation;
        }
        

        
        if(empty($qteentree)){
            $qtestock=$qtegeneral;
        }else{
            $qtestock=$qtegeneral+-$qteentree;
        }
        
        if($qtestock<$qte){
            $_SESSION['msg']="le stock  est insuffisant il reste $qtestock pieces  en stock";
             header('location:../../views/entree.php');
            
        }elseif($ancienprix>$prix)
        {
            $_SESSION['msg']="le prix est inferieur au prix d'entree en stock general qui est de $ancienprix $ par piece";
            header('location:../../views/entree.php');
        }else{
            
            $req=$connexion->prepare("UPDATE entree SET description=?,quantite=?,prix=?,stock_general=?,boutique=?,utilisateur=? where id='$id'");
            $req->execute(array($descriptoin,$qte,$prix,$stock,$boutique,$user));
            if($req){
                 $_SESSION['msg']="Modification reussie ";
                 header('location:../../views/entree.php');
            }else{
                $_SESSION['msg']="Echec de la modification ";
                header('location:../../views/entree.php');
            }
        }
    }else{
        header('location:../../views/entree.php');
    }