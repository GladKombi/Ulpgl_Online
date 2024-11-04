<?php

if (isset($_GET['idMod']) && !empty($_GET['idMod'])) {
    $_id = $_GET['idMod'];        #affichage simple
    $_getDataMod = $connexion->prepare("SELECT * FROM dettes WHERE id=?");
    $_getDataMod->execute([$_id]);

    if ($_tab = $_getDataMod->fetch()) {
        $_description = $_tab[2];
        $_montant = $_tab[3];
        $_commande = $_tab[4];
    }

    $_url = "../models/updat/up-dettes-post.php?id=" . $_tab[0];
    $_btn = "Modifier";
    $title = "Modifier dette";
} else {
    $_url = "../models/add/add-dette-post.php";
    $_btn = "Enregistrer";
    $title = "Ajouter dette";
}

//la requete qui recupere les commandes pour les ajouter dans le combobox
$_getCommande = $connexion->prepare("SELECT commande.id,commande.client,client.nom,client.postnom FROM commande,client WHERE 
    commande.client=client.id AND commande.supprimer=0 AND client.supprimer=0");
$_getCommande->execute();

//la requete qui permet d'afficher les données
if (isset($_GET['search']) && !empty($_GET['search'])) {
    #La recherche...
    $_search = $_GET['search'];
    $_getData = $connexion->prepare("SELECT dettes.*,client.nom,client.postnom,client.prenom from dettes,
        client,commande where commande.id=dettes.commande and commande.client=client.id AND dettes.supprimer=0
        AND(dettes.dates LIKE ? OR dettes.montant LIKE ? OR dettes.description LIKE ? OR client.nom LIKE ? OR 
        client.postnom LIKE ? OR client.prenom LIKE ?)");
    $_getData->execute(["%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%", "%" . $_search . "%"]);
} else {
    #affichage simple
    $_getData = $connexion->prepare("SELECT dettes.*,client.nom,client.postnom,client.prenom from dettes,
        client,commande where commande.id=dettes.commande and commande.client=client.id AND dettes.supprimer=0");
    $_getData->execute();
}
