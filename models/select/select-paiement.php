<?php
    if (isset($_GET['idPaiement'])){
        $id=$_GET['idPaiement'];
        $getDataMod=$connexion->prepare("SELECT * FROM `paiment` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        
        $url="../models/updat/up-Periode-post.php?idPaiement=".$id;
        $btn="Modifier";
        $title="Modifier la le paiement";
    }
    else{
        $url="../models/add/add-Paiement-post.php";
        $btn="Enregistrer";
        $title="Enregistrer un nouveau paiement";
    }
    /**
     * Le code qui permet d'afficher les client, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%","%".$search."%"]);
    }
    else{
        $statut=0;
        $getData=$connexion->prepare("SELECT * from `paiement` WHERE `statut`=?");
        $getData->execute([$statut]);
    }