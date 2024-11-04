<?php 
      include 'connexion.php';

      if (isset($_POST['Suivant'])) {
        $jours=htmlspecialchars($_POST['jours']);
        header("Location: choisirclasse.php?idjour=$jours");

     
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
            <h2 class="fw-bold mb-0">Choisir le jour</h2>
            <a href="listehoraire.php" class="btn-close" ></a>
          </div>    
          <div class="modal-body p-5 pt-0">

            <form method="POST">

            <div class="mb-3">
            <label> Jours</label>
          <select class=" form-control mb-2" name="jours">
                    <?php 
  
                   $repChat=   $bdd-> query("SELECT * from jours");
                   while ($tab=$repChat->fetch()) {
                    
                  ?>
                  
                  <option  value="<?php echo $tab['id']; ?>">
  
                      <?php echo $tab['jour'] ?>
                          
                      </option>
                  <?php 
  
                 }
  
                 ?>
                   
                </select>
          </div>
         


          
              
         
         
        
              <p class="text-warning text-center"><?php if(isset($notification))echo $notification; ?></p>

              <div class="col-12">
                            <button class="btn1 w-100" type="submit" name="Suivant">Suivant</button>
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