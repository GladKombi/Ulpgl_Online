<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-Classe.php'); //Appel du script de selection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
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
                        <h4>Classe</h4>
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
                                <div class="col-12 p-3">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" name="description" placeholder="Entrez la description" <?php if (isset($_GET['idClass'])) { ?> value="<?php echo $tab['nomclasse']; ?> <?php } ?>">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-6 p-3">
                                    <label for="">Orientation <span class="text-danger">*</span></label>
                                    <select required name="Option" id="" class="form-select">
                                        <?php
                                        $rep = $connexion->prepare("SELECT * from `option` WHERE statut=?");
                                        $rep->execute([0]);
                                        $Orientation = "";
                                        while ($Option = $rep->fetch()) {
                                            $Orientation = $tab['options'];
                                            if (isset($_GET['idClass'])) {
                                            ?>
                                                <option <?php if ($Option['id'] == $Orientation) { ?> Selected <?php } ?> value="<?php echo $Option['id']; ?>">
                                                    <?php echo  $Option['Description']; ?>
                                                </option>
                                            <?php } else {
                                            ?>
                                                <option value="<?php echo $Option['id']; ?>">
                                                    <?php echo  $Option['Description']; ?>
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
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($idClass = $getData->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td> <?= $idClass["nomclasse"] . " " . $idClass["Description"] ?></td>
                                        <td>
                                            <a href='classe.php?idClass=<?= $idClass['id'] ?>' class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-boutique-post.php?idSupcat=<?= $idClass['id'] ?>" class="btn btn-danger btn-sm mt-1">
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