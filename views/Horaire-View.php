<?php
# Se connecter à la BD
include '../connexion/connexion.php';
require_once("../models/select/Select-Horaire-View.php"); //Appel du script de selection
if(isset($_GET['idcla'])){
    $idclasse = $_GET['idcla'];
}

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
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveHoraireV = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Horaire</h4>
                    </div>
                    <?php
                    if (isset($_GET['PerClass'])) {
                    ?>
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Horaire par classe</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                        <a href="fix-horaire.php" class="btn icon icon-left btn-success"><i class="bi bi-node-plus"></i> Ajouter horaire</a>
                                            <div class="sidebar-menu">
                                                <ul class="menu">
                                                    <h6 class="text-center">Les classes</h6>
                                                    <?php
                                                    while ($class = $getClass->fetch()) {
                                                        $id = $class['id'];
                                                    ?>
                                                        <li class="sidebar-item active btn btn-successsuccess" value=<?php $id = $class['id'] ?>>
                                                            <a href="Horaire-View.php?PerClass&idcla=<?php echo $class['id'] ?> " class='sidebar-link'>
                                                                <i data-feather="home" width="20"></i>
                                                                <span><?php echo $class['nomclasse'] . " " . $class['options']; ?></span>
                                                            </a>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <?php
                                            $affichclass = $connexion->query("SELECT * FROM classe where id='$idclasse'");
                                            $numero = 0;
                                            while ($tabo = $affichclass->fetch()) {
                                            ?>
                                                <h3><?php echo $tabo['nomclasse'] . "  " . $tabo['options']; ?></h3>
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <?php $afficherheure = $connexion->query("SELECT `unite` FROM `heure`");
                                                            $numero = 0;
                                                            while ($heure = $afficherheure->fetch()) {
                                                                $heures = $heure['unite'];
                                                                if ($heures == "5e heure") {
                                                            ?>
                                                                    <th> <?php echo "recreation" ?></th>
                                                                <?php
                                                                }
                                                                ?>
                                                                <th> <?php echo $heures ?></th>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $affichercour = $connexion->query("SELECT `id`,`jour` FROM `jours`");
                                                        $numero = 0;
                                                        while ($jour = $affichercour->fetch()) {
                                                            $numero += 1;
                                                            $jours = $jour['id'];
                                                        ?>
                                                            <tr class="table-primary">
                                                                <td><?php echo $jour['jour'] ?></td>
                                                                <?php
                                                                $afficherjour = $connexion->query("SELECT heure.unite, cours.nomcours,enseignants.nom,enseignants.postnom FROM affectation,cours,enseignants,horaire,heure WHERE affectation.id=horaire.affectation and affectation.cours=cours.id and affectation.enseignant=enseignants.id and horaire.heure=heure.id and horaire.heure=heure.id and classe='$idclasse' and jours='$jours' order by horaire.heure");
                                                                $numero = 0;
                                                                while ($tab = $afficherjour->fetch()) {
                                                                    $numero += 1;
                                                                    $heurs = $tab['unite'];
                                                                    if ($heurs == "5e heure") {
                                                                ?>
                                                                        <th> <?php echo "recreation" ?></th>
                                                                    <?php
                                                                    }

                                                                    if ($tab['nomcours'] == 'Etude') { ?>
                                                                        <td><?php echo  "<strong>" . $tab['nomcours'] . "</strong><br>"; ?></td>
                                                                    <?php } else { ?>
                                                                        <td><?php echo  "<strong>" . $tab['nomcours'] . "</strong><br> prof " . $tab['nom']; ?></td>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    } else {
                    ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title text-center">Les paramettres de l'horaire</h4>
                                        <!-- pour afficher les massage  -->
                                        <?php
                                        if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                                        ?>
                                            <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                                        <?php }
                                        #Cette ligne permet de vider la valeur qui se trouve dans la session message
                                        unset($_SESSION['msg']);
                                        ?>

                                        <center>
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="Horaire-View.php?PerClass&idcla=1" class="btn icon icon-left btn-success"><i class="bi bi-node-plus"></i> Voir l'horaire</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="fix-horaire.php" class="btn icon icon-left btn-success"><i class="bi bi-node-plus"></i> Ajouter horaire</a>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                    <div class="col-12 mt-3">
                        <div class="table-responsive">
                            <h4 class="text-center">
                                Liste_Horaire
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