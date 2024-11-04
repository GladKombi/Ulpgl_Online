<?php
    if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){
        $msg=$_SESSION['msg'];
    }
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id=$_GET['id'];
        //Metter seulement les paramètre lors que vous préparez la requette
        $req=$connexion->prepare("SELECT * FROM entree where id='$id'");
        $req->execute();
        $ent=$req->fetch();//Il faut tester si reelement le tableau est remplit 
        $action="../models/updat/up-entree-post.php?id=$id";
        $btn="Modifier";
        $title="Modifier stock boutique";
    }else{ 
        $action="../models/add/add-entree-post.php";
        $btn="Enregistrer";
        $title="Ajouter stock boutique";
    }

   //la requete qui permet d'afficher les données
   if(isset($_GET['search']) && !empty($_GET['search'])){
        #La recherche...
        $_search=$_GET['search'];
        $_getData=$connexion->prepare("SELECT entree.*, stock_general.description as sdescription,produit.nom, categorie.description as 
        categorie, (entree.quantite * entree.prix )  as total, boutique.nom as boutique FROM stock_general,entree,produit, 
        categorie,boutique where entree.stock_general=stock_general.id and produit.id=stock_general.produit AND 
        boutique.id=entree.boutique  AND categorie.id=produit.categorie AND entree.supprimer!=1 AND stock_general.supprimer!=1 AND 
        categorie.supprimer!=1 AND (entree.dates LIKE ? OR entree.description LIKE ? OR entree.quantite LIKE ? OR
        entree.prix LIKE ? OR boutique.nom LIKE ? )");
        $_getData->execute(["%".$_search."%", "%".$_search."%", "%".$_search."%", "%".$_search."%", "%".$_search."%"]);
    }else{
        #L'affichage simple
        $_getData=$connexion->prepare("SELECT entree.id, entree.date,typeproduit.description, catproduit.description, entree.quantite, entree.prixAchat, boutique.nom, entree.photo FROM entree, catproduit,boutique,typeproduit WHERE typeproduit.id=catproduit.typeproduit and catproduit.id=entree.categorie; ;");
        $_getData->execute();


        // $_getData=$connexion->prepare("SELECT entree.*, stock_general.description as sdescription,produit.nom, categorie.description as 
        // categorie, (entree.quantite * entree.prix )  as total, boutique.nom as boutique FROM stock_general,entree,produit, 
        // categorie,boutique where entree.stock_general=stock_general.id and produit.id=stock_general.produit AND 
        // boutique.id=entree.boutique  AND categorie.id=produit.categorie AND entree.supprimer!=1 AND stock_general.supprimer!=1 AND 
        // categorie.supprimer!=1");
        // $_getData->execute();
    } 