<?php
# Se connecter à la BD
include '../connexion/connexion.php';
require_once("../models/select/Select-paiement.php"); //Appel du script de selection
if (isset($_GET['idcla'])) {
    $idclasse = $_GET['idcla'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payement</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActivePayement = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Organistation des paiement</h4>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- pour afficher les massage  -->
                                    <?php
                                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                                    ?>
                                        <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                                    <?php }
                                    #Cette ligne permet de vider la valeur qui se trouve dans la session message
                                    unset($_SESSION['msg']);

                                    if (isset($_GET['AjoutPaiement']) || isset($_GET['idPaiement'])) {
                                    ?>
                                        <div class="col-xl-12 ">
                                            <form action="<?= $url ?>" class="shadow p-3" method="POST" enctype="multipart/form-data">
                                                <h5 class="text-center"><?= $title ?></h5>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                        <label for="">Description <span class="text-danger">*</span></label>
                                                        <input required type="text" name="description" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idEnseignant'])) { ?>
                                                            value="<?php echo $tab['nom']; ?> <?php } ?>">
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                        <label for="">Eleves <span class="text-danger">*</span></label>
                                                        <select required name="journee" id="" class="form-select">
                                                            <?php
                                                            $rep = $connexion->prepare("SELECT * from `jours` WHERE statut=?");
                                                            $rep->execute([0]);
                                                            $jour = "";
                                                            while ($idJour = $rep->fetch()) {
                                                                $jour = $tab['options'];
                                                                if (isset($_GET['idClass'])) {
                                                            ?>
                                                                    <option <?php if ($idJour['id'] == $jour) { ?> Selected <?php } ?> value="<?php echo $idJour['id']; ?>">
                                                                        <?php echo  $idJour['jour']; ?>
                                                                    </option>
                                                                <?php } else {
                                                                ?>
                                                                    <option value="<?php echo $idJour['id']; ?>">
                                                                        <?php echo  $idJour['jour']; ?>
                                                                    </option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                        <label for="">Frais <span class="text-danger">*</span></label>
                                                        <select required name="journee" id="" class="form-select">
                                                            <?php
                                                            $rep = $connexion->prepare("SELECT * from `jours` WHERE statut=?");
                                                            $rep->execute([0]);
                                                            $jour = "";
                                                            while ($idJour = $rep->fetch()) {
                                                                $jour = $tab['options'];
                                                                if (isset($_GET['idClass'])) {
                                                            ?>
                                                                    <option <?php if ($idJour['id'] == $jour) { ?> Selected <?php } ?> value="<?php echo $idJour['id']; ?>">
                                                                        <?php echo  $idJour['jour']; ?>
                                                                    </option>
                                                                <?php } else {
                                                                ?>
                                                                    <option value="<?php echo $idJour['id']; ?>">
                                                                        <?php echo  $idJour['jour']; ?>
                                                                    </option>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                                        <label for="">Montant <span class="text-danger">*</span></label>
                                                        <input required type="text" name="nom" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idEnseignant'])) { ?>
                                                            value="<?php echo $tab['nom']; ?> <?php } ?>">
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                                        <input type="submit" class="btn btn-success w-100" name="Valider" value="<?= $btn ?>">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-xl-12 mb-3 ">
                                            <a href="payement.php?AjoutPaiement" class="btn btn-success w-100">Nouveau paiement</a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="table-responsive">
                            <h4 class="text-center">
                                Liste des paiement en genral
                            </h4>
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
                                    $affichercour = $connexion->query("SELECT horaire.id, jours.jour,heure.unite,cours.nomcours,classe.nomclasse,classe.options,enseignants.nom,enseignants.postnom FROM affectation,cours,enseignants,horaire,jours,heure,classe WHERE affectation.id=horaire.affectation and affectation.cours=cours.id and affectation.enseignant=enseignants.id AND horaire.jours=jours.id AND horaire.heure=heure.id and horaire.classe=classe.id order by horaire.jours");
                                    $numero = 0;
                                    while ($tab = $affichercour->fetch()) {
                                        $numero += 1;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo  $numero; ?></th>
                                            <td><?php echo $tab['jour']; ?></td>
                                            <td><?php echo $tab['nomclasse'] . "  " . $tab['options']; ?></td>
                                            <td><?php echo $tab['nomcours']; ?></td>
                                            <td><?php echo $tab['unite']; ?></td>
                                            <td><?php echo $tab['nom'] . "  " . $tab['postnom']; ?></td>
                                            <td>
                                                <a href="modifhor.php?idCat=<?php echo $tab['id']; ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="listehoraire.php?idSupcat=<?php echo $tab['id']; ?>" class="btn btn-danger btn-sm mt-1">
                                                    <i class="bi bi-trash "></i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Sainte_Croix</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="wa.me:0997019883">Glad</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php require_once('script.php') ?>
</body>

</html>