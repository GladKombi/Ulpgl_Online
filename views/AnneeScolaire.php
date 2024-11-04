<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-Annee.php'); //Appel du script de selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Année</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveAnee = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                    ?><div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div><?php
                                                                                            }
                                                                                            #Cette ligne permet de vider la valeur qui se trouve dans la session message
                                                                                            unset($_SESSION['msg']);
                                                                                                ?>
                    <!-- Le form qui enregistrer les données  -->
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <form action="<?= $url ?>" class="shadow p-3" method="POST">
                            <h5 class="text-center">Année Scolaire</h5>
                            <?php
                            if (isset($_GET['NewYeah'])) {
                            ?>
                                <div class="row">
                                    <a href="../models/add/add-annee.php?btn=annee" class="btn btn-success bi bi-plus"> Ajouter Nouvelle Annee Scolaire</a>
                                </div>
                            <?php
                            }else{
                                ?>
                                 <div class="row">
                                    <a href="AnneeScolaire.php?NewYeah" class="btn btn-success bi bi-plus"> Annee Scolaire</a>
                                </div>
                                <?php
                            }
                            ?>
                           
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="row">
                            <form action="<?= $url ?>" class="shadow p-3" method="POST">
                                <h5 class="text-center">Seuil Paiement</h5>
                                <?php
                                if (isset($_GET['NewSeil'])) {
                                ?>
                                    <h5 class="text-center"><?= $title ?></h5>
                                    <div class="col-12 p-3">
                                        <label for="">Montant<span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" name="montant" placeholder="EX:50" <?php if (isset($_GET['idCatFrais'])) { ?>
                                            value="<?php echo $tab['description']; ?> <?php } ?>">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-6 p-3">
                                        <label for="">periode <span class="text-danger">*</span></label>
                                        <select required name="periode" id="" class="form-select">
                                            <?php
                                            $rep = $connexion->prepare("SELECT * from `periode` WHERE statut=?");
                                            $rep->execute([0]);
                                            $Orientation = "";
                                            while ($periode = $rep->fetch()) {
                                                $idPeriod = $tab['options'];
                                                if (isset($_GET['idClass'])) {
                                            ?>
                                                    <option <?php if ($periode['id'] == $idPeriod) { ?> Selected <?php } ?> value="<?php echo $periode['id']; ?>">
                                                        <?php echo  $periode['libelle']; ?>
                                                    </option>
                                                <?php } else {
                                                ?>
                                                    <option value="<?php echo $periode['id']; ?>">
                                                        <?php echo  $periode['libelle']; ?>
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
                    <?php
                                } else {
                    ?>
                        <div class="row">
                            <a href="AnneeScolaire.php?NewSeil" class="btn btn-success btn-sm bi bi-plus">Nouveau seuil de paiement</a>
                        </div>
                    <?php
                                }

                    ?>


                    </form>
                    </div>
                </div>
                <div class="row">
                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 col-lg-12 col-md-8 table-responsive px-3 pt-3">
                        <h3 class="text-center mt-2">Les seuils pour l'année scolaire 2024-2025</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Description</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idCatFrais = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td> <?= $idCatFrais["libelle"] ?></td>
                                        <td> <?= $idCatFrais["montant"] ?></td>
                                        <td>
                                            <a href='CatFrais.php?idCatFrais=<?= $idCatFrais['id'] ?>' class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-CatFrais-post.php?idSupCatFrais=<?= $idCatFrais['id'] ?>" class="btn btn-danger btn-sm mt-1">
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