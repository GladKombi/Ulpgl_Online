<?php
    if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
        $msg=$_SESSION['msg'];
    }
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id=$_GET['id'];
        //Metter seulement les paramètre lors que vous préparez la requette
        $req=$connexion->prepare("SELECT * FROM stock_general where id='$id'");
        $req->execute();
        $sstock=$req->fetch();//Il faut tester si reelement le tableau est remplit 
    
        $action="../models/updat/up-stock-general-post.php?id=$id";
        $btn="Modifier";
        $title="Modifier stock général";
    }else{ 
        $action="../models/add/add-stock-general-post.php";
        $btn="Enregistrer";
        $title="Ajouter stock général";
    }
    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $_getData=$connexion->prepare("SELECT stock_general.id, stock_general.dates, stock_general.description as description, 
        stock_general.quantite as quantite, stock_general.prix_unitaire as prix , (stock_general.quantite * 
        stock_general.prix_unitaire) AS total, fornisseur.nom as nom, fornisseur.postnom as postnom,fornisseur.prenom AS 
        prenom, produit.nom as nompProduit, categorie.description as nomCategorie from stock_general,fornisseur,produit, 
        categorie where stock_general.produit=produit.id and stock_general.frounisseur=fornisseur.id and 
        categorie.id=produit.categorie AND stock_general.supprimer=0 AND fornisseur.supprimer!=1 AND produit.supprimer!=1 
        AND categorie.supprimer!=1 AND (stock_general.dates LIKE ? OR stock_general.description LIKE ? OR stock_general.quantite 
        LIKE ? OR stock_general.prix_unitaire LIKE ? OR produit.nom LIKE ? OR categorie.description LIKE ? OR fornisseur.nom LIKE ? 
        OR fornisseur.postnom LIKE ? OR fornisseur.prenom LIKE ?)");
        $_getData->execute(["%". $search."%","%". $search."%","%". $search."%","%". $search."%","%". $search."%","%". $search."%",
        "%". $search."%","%". $search."%","%". $search."%"]);
    }
    else{
        $_getData=$connexion->prepare("SELECT stock_general.id, stock_general.dates, stock_general.description as description, 
        stock_general.quantite as quantite, stock_general.prix_unitaire as prix , (stock_general.quantite * 
        stock_general.prix_unitaire) AS total, fornisseur.nom as nom, fornisseur.postnom as postnom,fornisseur.prenom AS 
        prenom, produit.nom as nompProduit, categorie.description as nomCategorie from stock_general,fornisseur,produit, 
        categorie where stock_general.produit=produit.id and stock_general.frounisseur=fornisseur.id and 
        categorie.id=produit.categorie AND stock_general.supprimer=0 AND fornisseur.supprimer!=1 AND produit.supprimer!=1 
        AND categorie.supprimer!=1");
        $_getData->execute();
    }