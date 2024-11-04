<?php 
        include_once '../../connexion/connexion.php'; // Appel de la connexion
        // Enregistrement de la commande
        if(isset($_POST['Enregistrercom'])){
            $date=date('Y-m-d');      
            $client=htmlspecialchars($_POST['client']);
            $req=$connexion->prepare("INSERT INTO commande (client, dates) VALUES (?, ?)");
            $resultat=$req->execute(array($client,$date));
            $id=$connexion->lastInsertId();
            if($resultat==true){
                $_SESSION['msge']="Votre commande viens d'être enregistrer avec succes";
                header("location:../../views/commande.php?idcom=$id");
            }
        }elseif(isset($_POST['Enregistrer'])){ //Ajout au panier
            $id=$_GET['id'];          
            $Description=htmlspecialchars($_POST['Description']);
            $Quantite=htmlspecialchars($_POST['Quantite']);            
            $entree=htmlspecialchars($_POST['entree']); 
            /**
             * Cette requette retourne la quantité et le prix de produit qui est en stock
             */
            $req= $connexion->prepare("SELECT quantite, prix FROM `entree` WHERE id=?"); //Recuperation de la quantité et du prix
            $req->execute(array($entree));
            if($tab=$req->fetch()){
                $QuantiteEnre=$tab['quantite'];
                $prix=$tab['prix'];  
            }else{
                $QuantiteEnre=0;
                $prix=0;  
            }
           /**
            * Cette requette retourne la quantité de produit qui est deja vandu
            */
            $requete= $connexion-> prepare("SELECT SUM(quantite) as stock FROM panier WHERE entree=?");
            $requete->execute(array($entree));
            if( $table=$requete->fetch()){
                $stockVendu=$table['stock'];
            }else{
                $stockVendu=0;
            }
            $stockResta=$QuantiteEnre-$stockVendu;   
            //Ici on verifie si quantité qu'on a besion de commandée est supperieur à ce qui est en stok                  
            if($Quantite > $stockResta){
                $_SESSION['msge']="Nous pouvons servir la quantité que vous avez saisi. Le stock est insufisant !";
                header("location:../../views/commande.php?idcom=$id");  
            }else{
                $req=$connexion->prepare("INSERT INTO panier (description,quantite,prix,entree,commande) VALUES (?,?,?,?,?)");
                $req->execute(array($Description,$Quantite,$prix,$entree,$id));
                if($req){
                    $_SESSION['msge']="Un nouvel ajout à la commande vient d'être effectuer !";
                    if(isset($_GET['idpanier']))
                    {
                    header("location:../../views/commande.php?idcom=$id&idpanier=0");
                    }
                    else
                    {
                        header("location:../../views/commande.php?idcom=$id");
                    }
                }
            }
        }else{
            header("location:../../views/commande.php");
        }