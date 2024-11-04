<?php
    if (isset($_GET['idAffectation'])){
        $id=$_GET['idAffectation'];
        $getDataMod=$connexion->prepare("SELECT * FROM `affectation` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();

        $url="../models/updat/up-affectation-post.php?idAffectation=".$id;
        $btn="Modifier";
        $title="Modifier une affectation ";
    }
    else{
        $url="../models/add/add-affectation-post.php";
        $btn="Enregistrer";
        $title="Ajouter une affectation";
    }
    /**
     * Le code qui permet d'afficher la affectation, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%","%".$search."%"]);
    }
    else{
        $statut=0;
        $getData=$connexion->prepare("SELECT affectation.*,enseignants.nom,enseignants.postnom,enseignants.tel,cours.nomcours FROM `affectation`,enseignants,cours WHERE affectation.enseignant=enseignants.id AND affectation.cours=cours.id AND affectation.supprimer=?;");
        $getData->execute([$statut]);
    }