<?php
    if (isset($_GET['PerClass'])){
        $statut=0;
        $getClass=$connexion->prepare("SELECT * FROM `classe` where supprimer=?");
        $getClass->execute([$statut]);
    }
