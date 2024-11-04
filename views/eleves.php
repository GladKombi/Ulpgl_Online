<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-Eleve.php'); //Appel du script de selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eleves</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveEleve = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Eleves</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                        <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                    <?php }
                    #Cette ligne permet de vider la valeur qui se trouve dans la session message
                    unset($_SESSION['msg']);
                    ?>
                    <!-- Le form qui enregistrer les données  -->
                    <?php
                    if (isset($_GET['AjoutElev']) || isset($_GET['idEleve'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                    <h4 class="text-center"><?= $title ?></h4>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom <span class="text-danger">*</span></label>
                                        <input required type="text" name="nom" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['nom']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Postnom <span class="text-danger">*</span></label>
                                        <input required type="text" name="postnom" class="form-control" placeholder="Entrez le postnom" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['postnom']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Prenom <span class="text-danger">*</span></label>
                                        <input required type="text" name="prenom" class="form-control" placeholder="Entrez le prenom" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['prenom']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Genre <span class="text-danger">*</span></label>
                                        <select required id="" name="genre" class="form-select">
                                            <?php if (isset($_GET['idEleve'])) {
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
                                        <label for="">Lieu de naissance <span class="text-danger">*</span></label>
                                        <input required type="text" name="LieuNaissance" class="form-control" placeholder="Entrez le lieu de naissance" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['lieuNaissance']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Date de naissance <span class="text-danger">*</span></label>
                                        <input required type="Date" name="DateNaissance" class="form-control" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['dateNaissance']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adresse <span class="text-danger">*</span></label>
                                        <input required type="text" name="adress" class="form-control" placeholder="Entrez l'adresse" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['adresse']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom du pere ou Tutaire <span class="text-danger">*</span></label>
                                        <input required type="text" name="NomPere" class="form-control" placeholder="Entrez le Nom du père et/ou tutaire" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['nomPere']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom de la mère ou Tutaire <span class="text-danger">*</span></label>
                                        <input required type="text" name="NomMere" class="form-control" placeholder="Entrez le Nom de la mère et/ou tutaire" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['nomMere']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Telephone du parent et/ou tutaire <span class="text-danger">*</span></label>
                                        <input required type="text" name="telephone" class="form-control" placeholder="Entrez le N° Tel" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['numeroParent']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Photo de l'eleve <span class="text-danger">*</span></label>
                                        <input required type="file" name="photo" class="form-control" placeholder="Choisir la photo de l'eleve" <?php if (isset($_GET['idEleve'])) { ?>
                                            value="<?php echo $tab['photo']; ?> <?php } ?>">
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                        <input type="submit" name="Valider" class="btn btn-success w-100" value="<?= $btn ?>">
                                    </div>


                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 ">
                            <a href="eleves.php?AjoutElev" class="btn btn-success w-100">Ajouter un(e) Elève</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Matricule</th>
                                    <th>Noms</th>
                                    <th>Genre</th>
                                    <th>Adresse</th>
                                    <th>Telphone responsable</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idEleve = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $idEleve["matricule"] ?></td>
                                        <td><?= $idEleve["nom"] . " " . $idEleve["postnom"] . " " . $idEleve["prenom"] ?></td>
                                        <td><?= $idEleve["genre"] ?></td>
                                        <td><?= $idEleve["adresse"] ?></td>
                                        <td><?= $idEleve["numeroParent"] ?></td>
                                        <td>
                                            <img src="../photo/profilEleve/<?= $idEleve["photo"] ?>" class="rounded-circle" width="90px" height="90px" alt="">
                                        </td>
                                        <td>
                                            <a href="eleves.php?idEleve=<?= $idEleve['matricule'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-Eleve-post.php?idSupEleve=<?= $idEleve['matricule'] ?>" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash-fill"></i>
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