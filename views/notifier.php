<?php
# Se connecter à la BD
include '../connexion/connexion.php';
$getData = $connexion->prepare("SELECT `matricule`, `nom`, `postnom`, `prenom`, `genre`, `adresse`, `nomPere`, `nomMere`, `numeroParent`, `photo`, `statut` FROM `eleve` WHERE statut=0;");
$getData->execute();
if ($idEleve = $getData->fetch()) {
    $matricule = $idEleve['matricule'];
    $Numero = $idEleve['numeroParent'];
    $nom = $idEleve['nom'];
    $postnom = $idEleve['postnom'];
    $nomPere = $idEleve['nom'];
    $nomMere = $idEleve['postnom'];
}
if (isset($_GET['idPeriode'])) {
    $idPeriod=$_GET['idPeriode'];
    $statut=0;
    $getSeuil = $connexion->prepare("SELECT seuil.*,periode.libelle as periode FROM `seuil`,periode WHERE seuil.statut=? and seuil.periode=?;");
    $getSeuil->execute([$statut,$idPeriod]);
    if ($idSeuil = $getSeuil->fetch()) {
        $montant = $idSeuil['montant'];
        $periode = $idSeuil['periode'];
        echo $periode;
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
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
                        <h4>Message de seuil</h4>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Notifier seuil </h4>
                                    <center>
                                        <div class="row mt-3">
                                            <?php
                                            if (isset($_GET['notfier'])) {
                                            ?>
                                                <form action="#" class="shadow p-3" method="POST">
                                                    <div class="row">
                                                        <div class="form-group mb-3">
                                                            <label for="exampleFormControlTextarea1" class="form-label">Intituler</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Envoyer</button>
                                                </form>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="send.php?seuil=<?= $idSeul ?>" class="btn btn-success mb-2"><i class="bi bi-chat"></i> Par SMS</a>
                                                <a href="../models/script/send_whatsapp.php?whatsapp=whatsapp" class="btn btn-success"><i class="bi bi-whatsapp"></i> Par Whatsapp</a>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 mt-3">
                        <div class="table-responsive">
                            <h4 class="text-center">
                                Liste des notification anterieurs
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