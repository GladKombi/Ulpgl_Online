<?php
    if (isset($_GET['idInscription'])){
        $id=$_GET['idInscription'];
        $getDataMod=$connexion->prepare("SELECT * FROM `inscrition` WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();

        $url="../models/updat/up-inscription-post.php?idInscription=".$id;
        $btn="Modifier";
        $title="Modifier une Classe ";
    }
    else{
        $url="../models/add/add-inscription-post.php";
        $btn="Enregistrer";
        $title="Nouvelle inscription";
    }
    /**
     * Le code qui permet d'afficher la classe, lors de l'affichage simple, et lors de la recherche
     */
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from client WHERE supprimer=0 AND client.nom LIKE ? OR client.postnom LIKE ? OR 
        client.prenom LIKE ? OR client.genre LIKE ? OR client.adresse LIKE ? OR client.telephone LIKE ?");
        $getData->execute(["%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%", "%".$search."%","%".$search."%"]);
    }
    else{
        $statut=0;
        $getData=$connexion->prepare("SELECT inscription.*, eleve.matricule ,eleve.nom,eleve.postnom,eleve.prenom,eleve.numeroParent,classe.nomclasse,`option`.Description, anneescolaire.libelle,anneescolaire.libelle2 FROM `inscription`,eleve,`promotion`,classe,`option`,anneescolaire WHERE inscription.eleve=eleve.matricule AND inscription.promotion=promotion.id and promotion.classe=classe.id AND classe.options=`option`.`id`AND promotion.anneeSco=anneescolaire.id AND inscription.statut=?;");
        $getData->execute([$statut]);
    }