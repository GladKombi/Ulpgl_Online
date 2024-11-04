<?php
include 'connexion.php';
$jour = $_GET['idjour'];
$classee = $_GET['idclasse'];
$heure = $_GET['idheure'];

if (isset($_POST['envoyer'])) {
  $jours = $jour;
  $classe = $classee;
  $heures = $heure;


  $affectation = htmlspecialchars($_POST['affectation']);

  if (!empty($jours) && !empty($classe)  && !empty($heure)) {
    $bdd->query("INSERT INTO horaire (affectation,jours,classe,heure) VALUES ('$affectation','$jours','$classe','$heure')");
    $notification = "Réussie";
  } else {
    $notification = "completer tout les champs";
  }
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
          <h2 class="fw-bold mb-0">Ajouter Horaire</h2>
          <a href="listehoraire.php" class="btn-close"></a>
        </div>
        <div class="modal-body p-5 pt-0">

          <form method="POST">







            <div class="mb-3">
              <label> Choisir l'affectation</label>
              <select class=" form-control mb-2" name="affectation">
                <?php

                $repChat =   $bdd->query("SELECT affectation.id,cours.nomcours,enseignants.nom,enseignants.postnom FROM `affectation`,cours,enseignants WHERE affectation.cours=cours.id and enseignants.id=affectation.enseignant and enseignants.jrnepeda!='$jour'  and (affectation.id) NOT IN (SELECT affectation FROM horaire where horaire.jours='$jour' AND  horaire.heure='$heure')");
                while ($tab = $repChat->fetch()) {

                ?>

                  <option value="<?php echo $tab['id']; ?>">

                    <?php echo $tab['nomcours'] . " prof " . $tab['nom'] . "  " . $tab['postnom']; ?>

                  </option>
                <?php

                }

                ?>

              </select>
            </div>


            <p class="text-warning text-center"><?php if (isset($notification)) echo $notification; ?></p>

            <div class="col-12">
              <button class="btn1 w-100" type="submit" name="envoyer">Enregistrer</button>
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