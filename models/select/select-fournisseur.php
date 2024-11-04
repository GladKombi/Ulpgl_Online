<?php
    if (isset($_GET['idfour']) && !empty($_GET['idfour'])){
     $id=$_GET['idfour'];
     $getDataMod=$connexion->prepare("SELECT * FROM fornisseur WHERE id=?");
     $getDataMod->execute([$id]);
     $tab=$getDataMod->fetch();
    
     $url="../models/updat/up-fournisseur-post.php?idfour=".$id;//Cette varible permet de savoir sur quelle page l'action va etre executée lors de la modification
     $btn="Modifier";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Modifier Fournisseur";
    }
    else{
     $url="../models/add/add-fournisseur-post.php";//Cette varible permet de savoir sur quelle page l'action va etre executée lors de l'enregistrement. il sera mit dans l'attribut action dans le form
     $btn="Enregistrer";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Ajouter fournisseur";
    }

    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from fornisseur WHERE supprimer=? AND nom LIKE ? OR postnom LIKE ? OR prenom LIKE ? 
        OR genre LIKE ? OR adresse LIKE ? OR telephone LIKE ?");
        $getData->execute([0,  $search."%", $search."%", $search."%", $search."%", $search."%", $search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT * from fornisseur WHERE supprimer=?");
        $getData->execute([0]);
    }