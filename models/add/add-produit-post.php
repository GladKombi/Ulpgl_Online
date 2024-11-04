<?php
include('../../connexion/connexion.php');

if(isset($_POST['valider'])){
    $nom=htmlspecialchars($_POST['nom']);   
    $categorie=htmlspecialchars($_POST['categorie']);
    //Insertion data from database
    $statut=0;
    
    $req=$connexion->prepare("INSERT INTO catproduit (typeproduit,`description`,  `supprimer`) values (?,?,?)");
    $resultat=$req->execute([$categorie,$nom,$statut]);
    #Si oui, la variable resultat va retourée true, donc il y a eu un enregistrement
    if($resultat==true){
        $_SESSION['msg']= "L'enreigistrement réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
        header("location:../../views/produits.php");
    }
    else{
        $_SESSION['msg']= "Echec d'enreigistrement";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucun enregistrement
        header("location:../../views/produits.php");
    }
}else{
    //Cette ligne permet de rediriger l'utiliseteur lors qu'il a pas cliquer sur le button qui sert à enregistrer
    header("location:../../views/produits.php");
}
?> 