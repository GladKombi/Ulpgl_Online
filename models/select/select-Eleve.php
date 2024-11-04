<?php
    if (isset($_GET['idEleve'])){
        $id=$_GET['idEleve'];
        $getDataMod=$connexion->prepare("SELECT * FROM eleve WHERE matricule=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
        # Url du traitement lors de la modification
        $url="../models/updat/up-eleve-post.php?idEleve=".$id;
        $btn="Modifier";
        $title="Modifier un(e) élève(e)";
    }
    else{
        # Url du traitement lors de la modification
        $url="../models/add/add-eleve-post.php";
        $btn="Enregistrer";
        $title="Ajouter un(e) élève(e)";
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
        $getData=$connexion->prepare("SELECT * from eleve WHERE statut=0");
        $getData->execute();
    }