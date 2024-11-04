<?php
    if (isset($_GET['idPreiode'])){
        $id=$_GET['idPreiode'];
        $getDataMod=$connexion->prepare("SELECT * FROM `periode` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        
        $url="../models/updat/up-Periode-post.php?idPreiode=".$id;
        $btn="Modifier";
        $title="Modifier la periode";
    }
    else{
        $url="../models/add/add-Periode-post.php";
        $btn="Enregistrer";
        $title="Ajouter une periode";
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
        $getData=$connexion->prepare("SELECT * from `periode` WHERE `statut`=?");
        $getData->execute([$statut]);
    }