<?php
include '../connexion/connexion.php';
# My selection query
require_once('../models/select/select-Fix-Horaire.php');
// if (isset($_POST['Suivant'])) {
//     $jours = htmlspecialchars($_POST['jours']);
//     header("Location: choisirclasse.php?idjour=$jours");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horaire</title>
    <?php require_once('style.php') ?>
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-xl-2">

            </div>
            <?php
            if (isset($_GET['idjour']) && !isset($_GET['idclasse'])) {
                $jour = $_GET['idjour'];
            ?>
                <div class="col-xl-8 col-lg-8 col-md-6  col-sm-6 p-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="modal-header p-5 pb-4 border-bottom-0">
                                    <h4 class="fw-bold mb-0">Choisir la classe </h4>
                                    <a href="Horaire-View.php" class="btn-close"></a>
                                </div>
                                <form method="POST" action="../models/select/select-Fix-Horaire.php?idjour=<?= $jour ?>">
                                    <div class="mb-3">
                                        <label> Classe</label>
                                        <select class="form-select" id="basicSelect" name="classe">
                                            <?php
                                            $GetClass = $connexion->prepare("SELECT * from classe where supprimer=0");
                                            $GetClass->execute();
                                            while ($Class = $GetClass->fetch()) {
                                            ?>
                                                <option name="idclasse" value="<?php echo $Class['id']; ?>">
                                                    <?php echo $Class['nomclasse'] . "  " . $Class['options']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit" name="envoyer">Suivant</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } elseif (isset($_GET['idjour']) && isset($_GET['idclasse']) && !isset($_GET['idheure'])) {
                $classee = $_GET['idclasse'];
                $jour = $_GET['idjour'];
            ?>
                <div class="col-xl-8 col-lg-8 col-md-6  col-sm-6 p-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="modal-header p-5 pb-4 border-bottom-0">
                                    <h4 class="fw-bold mb-0">Choisir l'heure</h4>
                                    <a href="Horaire-View.php" class="btn-close"></a>
                                </div>
                                <form method="POST" action="../models/select/select-Fix-Horaire.php?idjour=<?= $jour ?>&idclasse=<?= $classee ?>">
                                    <div class="mb-3">
                                        <label> Heures</label>
                                        <select class="form-select" id="basicSelect" name="heure">
                                            <?php
                                            $GetHeure = $connexion->prepare("SELECT id,unite from heure WHERE (id) NOT IN (SELECT heure FROM horaire where horaire.jours='$jour' AND horaire.classe='$classee')");
                                            $GetHeure->execute();
                                            while ($heure = $GetHeure->fetch()) {
                                            ?>
                                                <option value="<?php echo $heure['id']; ?>">
                                                    <?php echo $heure['unite']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit" name="envoyer">Suivant</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } elseif (isset($_GET['idjour']) && isset($_GET['idclasse']) && isset($_GET['idheure'])) {
                $classee = $_GET['idclasse'];
                $jour = $_GET['idjour'];
                $heure = $_GET['idheure'];                
            ?>
                <div class="col-xl-8 col-lg-8 col-md-6  col-sm-6 p-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="modal-header p-5 pb-4 border-bottom-0">
                                    <h4 class="fw-bold mb-0">Choisir l'affectation</h4>
                                    <a href="Horaire-View.php" class="btn-close"></a>
                                </div>
                                <form method="POST" action="../models/add/add-Horaire-post.php?idjour=<?= $jour ?>&idclasse=<?= $classee ?>&idheure=<?= $heure ?>">
                                    <div class="mb-3">
                                        <label> Choisir l'affectation</label>
                                        <select class="form-select" id="basicSelect" name="affectation">
                                            <?php
                                            $GetAffectation =   $connexion->query("SELECT affectation.id,cours.nomcours,enseignants.nom,enseignants.postnom FROM `affectation`,cours,enseignants WHERE affectation.cours=cours.id and enseignants.id=affectation.enseignant and enseignants.jrnepeda!='$jour'  and (affectation.id) NOT IN (SELECT affectation FROM horaire where horaire.jours='$jour' AND  horaire.heure='$heure')");
                                            while ($Affectation = $GetAffectation->fetch()) {
                                            ?>
                                                <option value="<?php echo $Affectation['id']; ?>">
                                                    <?php echo $Affectation['nomcours'] . " prof " . $Affectation['nom'] . "  " . $Affectation['postnom']; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit" name="envoyer">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="col-xl-8 col-lg-8 col-md-6  col-sm-6 p-3">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="modal-header p-5 pb-4 border-bottom-0">
                                    <h4 class="fw-bold mb-0">Choisir le jour</h4>
                                    <a href="Horaire-View.php" class="btn-close"></a>
                                </div>
                                <form method="POST" action="../models/select/select-Fix-Horaire.php">
                                    <div class="mb-3">
                                        <label> Jours</label>
                                        <select class="form-select" id="basicSelect" name="jours">
                                            <?php
                                            $GetDay = $connexion->prepare("SELECT * from jours");
                                            $GetDay->execute();
                                            while ($day = $GetDay->fetch()) {
                                            ?>
                                                <option value="<?php echo $day['id']; ?>">
                                                    <?php echo $day['jour'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-success w-100" type="submit" name="Suivant">Suivant</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="col-xl-2">

            </div>
        </div>
    </div>
    <?php require_once('script.php') ?>
</body>

</html>