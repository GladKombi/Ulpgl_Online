<?php
    if (isset($_GET['idEnseignant'])){
        $id=$_GET['idEnseignant'];
        $getDataMod=$connexion->prepare("SELECT * FROM `enseigant` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        
        $url="../models/updat/up-Enseigant-post.php?idEnseignant=".$id;
        $btn="Modifier";
        $title="Modifier un Enseignant ";
    }
    else{
        $url="../models/add/add-Enseignant-post.php";
        $btn="Enregistrer";
        $title="Ajouter un Enseignant";
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
        $getData=$connexion->prepare("SELECT * from `enseignants` WHERE `supprimer`=?");
        $getData->execute([$statut]);
    }