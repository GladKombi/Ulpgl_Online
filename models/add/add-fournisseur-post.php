<?php
include('../../connexion/connexion.php');

if(isset($_POST['valider'])){
    $nom=htmlspecialchars($_POST['nom']);
    $postnom=htmlspecialchars($_POST['postnom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $genre=htmlspecialchars($_POST['genre']);
    $adresse=htmlspecialchars($_POST['adresse']);
    $telephone=htmlspecialchars($_POST['telephone']);
     //select data from database
        $req=$connexion->prepare("INSERT INTO fornisseur( `nom`, `postnom`, `prenom`, `genre`, `adresse`, `telephone`) values (?,?,?,?,?,?)");
        $resultat=$req->execute([$nom,$postnom,$prenom,$genre,$adresse,$telephone]);
        #Si oui, la variable resultat va retourée true, donc il y a eu un enregistrement
        if($resultat==true){
            $_SESSION['msg']= "L'enreigistrement réussi";//Cette ligne permet d'ajouter un message dans la session Lors qu'il y a eu un enregistrement
            header("location:../../views/fournisseur.php");
        }
        else{
            $_SESSION['msg']= "Echec d'enreigistrement";//Cette ligne permet d'ajouter un message dans la session Lors qu'il n'y a aucun enregistrement
            header("location:../../views/fournisseur.php");
        }
    }else{
        //Cette ligne permet de rediriger l'utiliseteur lors qu'il a pas cliquer sur le button qui sert à enregistrer
        header("location:../../views/fournisseur.php");
    }
