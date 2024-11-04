<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-Enseignant.php'); //Appel du script de selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseigants</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveEseigant = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Enseigants</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                        <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                    <?php  }
                    #Cette ligne permet de vider la valeur qui se trouve dans la session message
                    unset($_SESSION['msg']);
                    # Le form qui enregistrer les données  
                    if (isset($_GET['AjoutEnseig']) || isset($_GET['idEnseignant'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <form action="<?= $url ?>" class="shadow p-3" method="POST" enctype="multipart/form-data">
                                <h5 class="text-center"><?= $title ?></h5>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom <span class="text-danger">*</span></label>
                                        <input required type="text" name="nom" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idEnseignant'])) { ?>
                                            value="<?php echo $tab['nom']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Postnom <span class="text-danger">*</span></label>
                                        <input required type="text" name="postnom" class="form-control" placeholder="Entrez le postnom" <?php if (isset($_GET['idEnseignant'])) { ?>
                                            value="<?php echo $tab['postnom']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Prenom <span class="text-danger">*</span></label>
                                        <input required type="text" name="prenom" class="form-control" placeholder="Entrez le prenom" <?php if (isset($_GET['idEnseignant'])) { ?>
                                            value="<?php echo $tab['prenom']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Genre <span class="text-danger">*</span></label>
                                        <select required id="" name="genre" class="form-select">
                                            <?php if (isset($_GET['idEnseignant'])) {
                                                $genre = $tab['genre'];
                                            ?>
                                                <option value="Masculin">Masculin</option>
                                                <option <?php if ($genre == "Feminin") { ?> Selected <?php } ?>value="Feminin">Feminin</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option desabled>Choisir un genre</option>
                                                <option value="Masculin">Masculin</option>
                                                <option value="Feminin">Feminin</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adresse <span class="text-danger">*</span></label>
                                        <input required type="text" name="adresse" class="form-control" placeholder="Entrez l'adresse" <?php if (isset($_GET['idEnseignant'])) { ?>
                                            value="<?php echo $tab['adress']; ?> <?php } ?>">
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Telephone <span class="text-danger">*</span></label>
                                        <input required type="text" name="telephone" class="form-control" placeholder="Entrez le N° Tel" <?php if (isset($_GET['idEnseignant'])) { ?>
                                            value="<?php echo $tab['telephone']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Orientation <span class="text-danger">*</span></label>
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
                                        <label for="">Photo de l'Enseignant <span class="text-danger">*</span></label>
                                        <input required type="file" name="photo" class="form-control" placeholder="Choisir la photo de l'enseignant" <?php if (isset($_GET['idEnseignant'])) { ?>
                                            value="<?php echo $tab['photo']; ?> <?php } ?>">
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
                            <a href="Enseigants.php?AjoutEnseig" class="btn btn-success w-100">Ajouter un Enseigant</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h4 class="text-center">Liste des enseigants</h4>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Noms</th>
                                    <th>Genre</th>
                                    <th>Adresse</th>
                                    <th>Tel</th>
                                    <th>Profil</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idEnseignant = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td> <?= $idEnseignant["nom"] . " " . $idEnseignant["postnom"] . " " . $idEnseignant["prenom"] ?></td>
                                        <td> <?= $idEnseignant["genre"] ?></td>
                                        <td> <?= $idEnseignant["adresse"] ?></td>
                                        <td> <?= $idEnseignant["tel"] ?></td>
                                        <td>
                                            <img src="../photo/profilProf/<?= $idEnseignant["photo"] ?>" class="rounded-circle" width="70px" height="70px" alt="">
                                        </td>
                                        <td>
                                            <a href='Enseigants.php?idEnseignant=<?= $idEnseignant['id'] ?>' class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-Enseignant-post.php?idSupEns=<?= $idEnseignant['id'] ?>" class="btn btn-danger btn-sm mt-1">
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