<?php 
include 'connexion.php';//Se connecter à la BD
$idclasse=$_GET['idcla']
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HORAIRE</title>
    <link rel="stylesheet" href="assetss/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assetss/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>




<div>
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Twelfth navbar example">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
          <ul class="navbar-nav">
           
            <li class="nav-item">
              <a class="nav-link active" href="index.php">accueil</a>
            </li>

            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="about.php">A propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active " aria-current="page" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active " aria-current="page" href="horairens.php">tout l'horaire</a>
          </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown" aria-expanded="false">Choisir la classe</a>
              <ul class="dropdown-menu lesclasses" aria-labelledby="dropdown10">

              <?php 
  
                          $repChat=   $bdd-> query("SELECT * from classe");
                          while ($tab=$repChat->fetch()) {

                          $id=$tab['id']; 

                      
                    ?>
                        
                        <li value=<?php $id=$tab['id']?> ><a  class="anavbar"class="dropdown-item" href="horaireparclasse.php?idcla=<?php echo $tab['id']?> "><?php echo $tab['nomclasse']." ".$tab['options'] ; ?></a>
                             


                      </li>
                      <?php 
                      
                    }
                    ?>
               
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</div>

    <div class="container">
  
   
    <?php
      $affichclass= $bdd->query("SELECT * FROM classe where id='$idclasse'");
      $numero=0;
      while($tabo=$affichclass->fetch())
       {
      


     
                    
                      

          ?>
          <h3><?php echo $tabo['nomclasse']."  ". $tabo['options'];?></h3>
          <table class="table table-striped table-sm">
    <thead>
        <tr>
        
        <th></th>

       <?php $afficherheure= $bdd->query("SELECT `unite` FROM `heure`");
                  $numero=0;
                  while($heure=$afficherheure->fetch())
                   {
                    
                    $heures=$heure['unite'];

                      
                    if($heures=="5e heure")
                   {
                    ?>
                    <th> <?php echo "recreation"?></th>
<?php
                   }
                    
                      

          ?>
            <th> <?php echo $heures?></th>
            

            <?php 
                    }
             ?>

         
        </tr>

    </thead>
    <tbody>
    <?php 
                  $affichercour= $bdd->query("SELECT `id`,`jour` FROM `jours`");
                  $numero=0;
                  while($jour=$affichercour->fetch())
                   {
                    $numero+=1;
                    $jours=$jour['id'];
                      ?>

                        <tr class="table-primary">
                        <td><?php echo $jour['jour']?></td>
                        <?php  
                     $afficherjour= $bdd->query("SELECT heure.unite, heure.id as idHeure,horaire.id,cours.nomcours,enseignants.nom,enseignants.postnom FROM heure, affectation,cours,enseignants,horaire WHERE heure.id=horaire.heure AND affectation.id=horaire.affectation and affectation.cours=cours.id and affectation.enseignant=enseignants.id and horaire.heure=heure.id and classe='$idclasse' and jours='$jours' order by horaire.heure");
                     $numero=0;
                     while($tab=$afficherjour->fetch())
                      {
                          $numero+=1;
                          $heurs=$tab['unite'];
                          if($heurs=="5e heure")
                        {
                         ?>
                         <th> <?php echo "recreation"?></th>
     <?php
                        }

                        if($tab['nomcours']=='Etude')
                        { ?>
                          <td><?php echo  "<strong>".$tab['nomcours']."</strong><br>"   ; ?><a href="demander.php?idhor=<?php echo $tab['id'] ?>&idjours=<?php echo $jours?>&idheures=<?php echo $tab['idHeure'] ?>"class="btn btn-primary " >Demander</a></td>
                      <?php } 
                      else
                      { ?>
                        <td><?php echo  "<strong>".$tab['nomcours']."</strong><br> prof ".$tab['nom']   ; ?></td>
                        <?php 
                    }
             ?>
                 

                        

                  
                    
                        
                   
                          
                          

                          <?php 
                    }
             ?>
                         
                     

       </tr>

       <?php 
                    }
             ?>

              
               
                
                        </tbody>
</table>


          <?php } ?>

      






   

    </div>
    <?php
			include('footer.php');
		?>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	
	<script src="assetss/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>