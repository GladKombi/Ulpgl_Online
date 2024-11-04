<?php
if (isset($_GET['NewSeil'])) {
    $url = "../models/add/add-Seuil-post.php";
    $btn = "Enregister";
    $title = "Enregistrer un nouveau seuil";
}
$statut = 0;
$getData = $connexion->prepare("SELECT seuil.*, periode.libelle from `seuil`,periode WHERE seuil.statut=?");
$getData->execute([$statut]);
