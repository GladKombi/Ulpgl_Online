<?php 
include 'connexion.php';//Se connecter à la BD
 ?>
<body>
  

<div class=" mt-2">
<?php
		
      include_once("ad.php");

      //  suppression horaire 
 if (isset($_GET['idSupcat']) && !empty($_GET['idSupcat'])) {
  $id=$_GET['idSupcat'];
  $bdd->query("DELETE from  `horaire` where id=$id");
    if($bdd){
      echo"<script>alert('Données supprimé avec succès')</script>"; 
    // header("Location:listehoraire.php");
  }
 
}

		?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
      <div class="d-flex justify-content-between flex-wrap  flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5 class="">Horaire</h5>
        <div class="">
        
                 <div class="col">
                    <button class="btn1 w-100" type="submit"><a type="button" href="choisirjours.php" class="text-decoration-none text-white">Ajouter Horaire</a></button>
                    </div>
          
        </div>
      </div>
     
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
                            <tr>
                                <th>N°</th>
                                <th>Jours</th>
                                <th>Classe</th>
                                <th>Cours</th>
                                <th>Heure</th>
                                <th>Noms Enseignant</th>
                                <th>Actions</th>
                                
                               
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                 $affichercour= $bdd->query("SELECT horaire.id, jours.jour,heure.unite,cours.nomcours,classe.nomclasse,classe.options,enseignants.nom,enseignants.postnom FROM affectation,cours,enseignants,horaire,jours,heure,classe WHERE affectation.id=horaire.affectation and affectation.cours=cours.id and affectation.enseignant=enseignants.id AND horaire.jours=jours.id AND horaire.heure=heure.id and horaire.classe=classe.id order by horaire.jours");
                 $numero=0;
                 while($tab=$affichercour->fetch())
                  {
                    $numero+=1;
                      ?>

                        <tr>
                          <th scope="row"><?php echo  $numero; ?></th>
                          <td><?php echo $tab['jour']; ?></td>
                          <td><?php echo $tab['nomclasse']."  ". $tab['options']; ?></td>
                          <td><?php echo $tab['nomcours']; ?></td>
                          <td><?php echo $tab['unite']; ?></td>
                          <td><?php echo $tab['nom']."  ". $tab['postnom']; ?></td>
                         
                          <td>
                  
                          <td><a href='modifhor.php?idCat=<?php echo $tab['id'];?>' class='text-primary'><i class='bi-solid bi bi-pencil-square text-primary'></i></a></td>
                          <td><a href='listehoraire.php?idSupcat=<?php echo $tab['id']; ?>' type="button" 
                          class="text-light" data-toggle="modal" data-target="#boite">
                          <i class='bi-solid bi bi-trash text-danger'></i></a></td>
                </td>  
                        </tr>

                      <?php 
                    }
             ?>
                
                        </tbody>
                    </table>
                    <!-- modal -->
<div class="container ">
   <div class="modal fade" id="boite">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
              <h4>Etes-vous sûr de vouloir supprimer ceci?</h4>  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger"><a href="./index.php?voir_realisation" 
               class="text-light text-decoration-none">Non</a></button>
               <button type="button" class="btn btn-primary"><a href='index.php?delete_realisation=<?php echo $realisations['idreal'] ?>' 
               class="text-light text-decoration-none">Oui</a></button>
            </div>
        </div>
    </div>
   </div>
  </div>
               </div>
    </main>
</div>
 
 

<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>