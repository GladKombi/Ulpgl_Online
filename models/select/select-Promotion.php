<?php
if (isset($_GET['idPromo'])) {
    $id = $_GET['idPromo'];
    $getDataMod = $connexion->prepare("SELECT * FROM `promotion` WHERE id=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();

    $url = "../models/updat/up-promo-post.php?idPromo=" . $id;
    $btn = "Modifier";
    $title = "Modifier une promotion";
} else {
    $url = "../models/add/add-promo-post.php";
    $btn = "Enregistrer";
    $title = "Ajouter une promotion";
}
/**
 * Le code qui permet d'afficher les client, lors de l'affichage simple, et lors de la recherche
 */
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $getData = $connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
    $getData->execute(["%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%", "%" . $search . "%"]);
} else {
    $statut = 0;
    $getData = $connexion->prepare("SELECT * from `promotion` WHERE `statut`=?");
    $getData->execute([$statut]);
}
