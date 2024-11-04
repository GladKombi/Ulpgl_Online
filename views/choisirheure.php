<?php 
      include 'connexion.php';
      $classee=$_GET['idclasse'];
      $jour=$_GET['idjour'];

      if (isset($_POST['envoyer'])) {
       

        
        
        $heure=htmlspecialchars($_POST['heure']);
        
        header("Location: ajouterhoraire.php?idjour=$jour&idclasse=$classee&idheure=$heure ");

      }
    



      
      

 ?>


<body>
<?php
			include('navbar.php');
		?>
   <div class="container">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
          <div class="modal-header p-5 pb-4 border-bottom-0">
            <!-- <h5 class="modal-title">Modal title</h5> -->
            <h2 class="fw-bold mb-0">Choisir l'heure</h2>
            <a href="listehoraire.php" class="btn-close" ></a>
          </div>    
          <div class="modal-body p-5 pt-0">

            <form method="POST">

            
          


          <div class="mb-3">
            <label> Heures</label>
          <select class=" form-control mb-2" name="heure">
                    <?php 
  
                   $repChat=   $bdd-> query("SELECT id,unite from heure WHERE (id) NOT IN (SELECT heure FROM horaire where horaire.jours='$jour' AND horaire.classe='$classee')");
                   while ($tab=$repChat->fetch()) {
                    
                  ?>
                  
                  <option  value="<?php echo $tab['id']; ?>">
  
                      <?php echo $tab['unite']; ?>
                          
                      </option>
                  <?php 
  
                 }
  
                 ?>
                   
                </select>
          </div>
              
          
         
        
              <p class="text-warning text-center"><?php if(isset($notification))echo $notification; ?></p>

              <div class="col-12">
                            <button class="btn1 w-100" type="submit" name="envoyer">Suivant</button>
                        </div>
                
            </form>
          </div>
        </div>
      </div>
   </div>
   <?php
			include('footer.php');
		?>
   <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>