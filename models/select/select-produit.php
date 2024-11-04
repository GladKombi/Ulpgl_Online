<?php
    if (isset($_GET['idpro'])){
     $id=$_GET['idpro'];
     $getDataMod=$connexion->prepare("SELECT * FROM catproduit WHERE id= ?");
     $getDataMod->execute([$id]);
     $tab=$getDataMod->fetch();
        
     $url="../models/updat/up-produit-post.php?idpro=".$id;//Cette varible permet de savoir sur quelle page l'action va etre executée lors de la modification
     $btn="Modifier";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Modifier Produit";
    }
    else{
     $url="../models/add/add-produit-post.php";//Cette varible permet de savoir sur quelle page l'action va etre executée lors de l'enregistrement. il sera mit dans l'attribut action dans le form
     $btn="Enregistrer";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Ajouter Produit";
    }

    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT  catproduit.`description`, typeproduit.description,catproduit.id  FROM typeproduit,`catproduit`  
        WHERE catproduit.typeproduit=typeproduit.id AND produit.supprimer=? AND typeproduit.statut=? AND (catproduit.`nom` LIKE ? OR 
        produit.`seuil` LIKE ? OR typeproduit.description LIKE ?)");
        $getData->execute([0, 0, "%". $search."%", "%". $search."%", "%". $search."%" ]);
    }
    else{
        $getData=$connexion->prepare("SELECT  catproduit.`description`, typeproduit.description,catproduit.id  FROM typeproduit,`catproduit` 
        WHERE catproduit.typeproduit=typeproduit.id AND catproduit.supprimer=? AND typeproduit.statut=?");
        $getData->execute([0, 0]);
    }