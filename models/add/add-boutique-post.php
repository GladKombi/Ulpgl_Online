
<?php
    #script d'insertion des boutiques dans la base de données
    include('../../connexion/connexion.php');

    if(isset($_POST['valider'])){       
        $description=htmlspecialchars($_POST['description']);
        $adresse=htmlspecialchars($_POST['adresse']);
        $nom=htmlspecialchars($_POST['nom']);

        #verifier si la boutique existe ou pas dans la bd
        $statut=0;
        $getBoutiqueDeplicant=$connexion->prepare("SELECT * FROM `boutique` WHERE nom=? AND statut=?");
        $getBoutiqueDeplicant->execute([$nom, $statut]);
        $tab=$getBoutiqueDeplicant->fetch();
            if($tab>0){
                $_SESSION['msg']='cette boutique existe dejà dans la base de données';//Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
                header("location:../../views/boutique.php");
            }
            else{
                $sendDate=$connexion->prepare("INSERT INTO boutique VALUES (Null,?,?,?, 0)");
                $resultat=$sendDate->execute([ $nom,$description,$adresse]);
                if($resultat==true){
                    $_SESSION['msg']="L'enregistrement réussi";
                    header("location:../../views/boutique.php");
                }
                else{
                    $_SESSION['msg']="Echec d'enregistrement";
                    header("location:../../views/boutique.php");
                }
            }

    } else{

        /**
         * Lors que  l'utilisateur n'a pas cliquer sur le button enregistrer, on va lui demandé de cliquer 
         */
        header("location:../../views/boutique.php");
    }
?> 