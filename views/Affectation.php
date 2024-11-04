<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-Affectation.php'); //Appel du script de selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affectaion</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveClasse = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Affectation des cours Au Enseigants</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                    ?>
                        <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                    <?php  }
                    #Cette ligne permet de vider la valeur qui se trouve dans la session message  
                    unset($_SESSION['msg']);
                    ?>
                    <!-- Le form qui enregistrer les données  -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <form action="<?= $url ?>" class="shadow p-3" method="POST">
                            <h5 class="text-center"><?= $title ?></h5>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-6 p-3">
                                    <label for="">Enseigant <span class="text-danger">*</span></label>
                                    <select required name="enseignants" id="" class="form-select">
                                        <?php
                                        $statut = 0;
                                        $rep = $connexion->prepare("SELECT * FROM `enseignants` WHERE supprimer=?");
                                        $rep->execute([$statut]);
                                        $enseignants = "";
                                        while ($prof = $rep->fetch()) {
                                            $enseignants = $tab['id'];
                                            if (isset($_GET['idAffectation'])) {
                                        ?>
                                                <option <?php if ($prof['id'] == $enseignants) { ?> Selected <?php } ?> value="<?php echo $prof['id']; ?>">
                                                    <?php echo  $prof['nom']; ?>
                                                </option>
                                            <?php } else {
                                            ?>
                                                <option value="<?php echo $prof['id']; ?>">
                                                    <?php echo  $prof['nom']; ?>
                                                </option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-6 p-3">
                                    <label for="">Cours <span class="text-danger">*</span></label>
                                    <select required name="cours" id="" class="form-select">
                                        <?php
                                        $statut = 0;
                                        $rep = $connexion->prepare("SELECT * FROM `cours` WHERE supprimer=?");
                                        $rep->execute([$statut]);
                                        $cours = "";
                                        while ($course = $rep->fetch()) {
                                            $cours = $tab['id'];
                                            if (isset($_GET['idAffectation'])) {
                                        ?>
                                                <option <?php if ($course['id'] == $cours) { ?> Selected <?php } ?> value="<?php echo $course['id']; ?>">
                                                    <?php echo  $course['nomcours']; ?>
                                                </option>
                                            <?php } else {
                                            ?>
                                                <option value="<?php echo $course['id']; ?>">
                                                    <?php echo  $course['nomcours']; ?>
                                                </option>
                                        <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 p-3">
                                    <input type="submit" class="btn btn-success w-100" name="Valider" value="<?= $btn ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-8 col-lg-8 col-md-6 table-responsive px-3 pt-3">
                        <h4 class="text-center">Les affectations</h4>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Enseigant</th>
                                    <th>Cours</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idAffectation = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td> <?= $idAffectation["nom"] . " " . $idAffectation["postnom"]. " " . $idAffectation["tel"]  ?></td>
                                        <td> <?= $idAffectation["nomcours"] ?></td>
                                        <td>
                                            <a href='Affectation.php?idAffectation=<?= $idAffectation['id'] ?>' class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-boutique-post.php?idSupcat=<?= $idAffectation['id'] ?>" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash"></i>
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