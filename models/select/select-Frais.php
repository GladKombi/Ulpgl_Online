<?php
    if (isset($_GET['idFrais'])){
        $id=$_GET['idFrais'];
        $getDataMod=$connexion->prepare("SELECT * FROM `frais` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        
        $url="../models/updat/up-Frais-post.php?idFrais=".$id;
        $btn="Modifier";
        $title="Modifier un frais";
    }
    else{
        $url="../models/add/add-Fais-post.php";
        $btn="Enregistrer";
        $title="Ajouter un frais";
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
        $getData=$connexion->prepare("SELECT frais.*, catfrais.description as categorieF FROM `frais`,catfrais WHERE frais.categorie=catfrais.id AND frais.statut=?;");
        $getData->execute([$statut]);
    }