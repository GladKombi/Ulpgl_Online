<?php
## Connexion to the DB
include 'connexion/connexion.php';
if (isset($_GET['idcla'])) {
    $idclasse = $_GET['idcla'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sainte Croix</title>
    <meta content="school complex Sainte_crois" name="description">
    <meta content="sainte croix" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assetts/img/favicon.png" rel="icon">
  <link href="assetts/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assetts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assetts/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assetts/vendor/aos/aos.css" rel="stylesheet">
    <link href="assetts/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assetts/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assetts/css/main.css" rel="stylesheet">

</head>

<body>

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assetts/img/logo.png" alt=""> -->
                <h1 class="">Sainte_Croix</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="courses.html">Courses</a></li>
                    <li><a href="trainers.html">Home Work</a></li>
                    <li><a href="trainers.html">Activities</a></li>
                    <li class="dropdown has-dropdown"><a href="#"><span>Tieme table per class</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <?php
                            $repChat =   $connexion->prepare("SELECT * from classe");
                            $repChat->execute();
                            while ($tab = $repChat->fetch()) {
                                $id = $tab['id'];
                            ?>
                                <li value=<?php $id = $tab['id'] ?>><a href="HoraireClasse.php?idcla=<?php echo $tab['id'] ?> "><?php echo $tab['nomclasse'] . " " . $tab['options']; ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="courses.html">Login</a>

        </div>
    </header>

    <main class="main">

        <section id="pricing" class="pricing section">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-xl-12 col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="pricing-item featured">
                            <?php
                            $affichclass = $connexion->prepare("SELECT * FROM classe where id='$idclasse'");
                            $affichclass->execute();
                            $numero = 0;
                            while ($tabo = $affichclass->fetch()) {
                            ?>
                                <h3><?php echo $tabo['nomclasse'] . "  " . $tabo['options']; ?></h3>
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <?php
                                            $afficherheure = $connexion->prepare("SELECT `unite` FROM `heure`");
                                            $afficherheure->execute();
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
                                        $affichercour = $connexion->prepare("SELECT `id`,`jour` FROM `jours`");
                                        $affichercour->execute();
                                        $numero = 0;
                                        while ($jour = $affichercour->fetch()) {
                                            $numero += 1;
                                            $jours = $jour['id'];
                                        ?>
                                            <tr class="table-primary">
                                                <td><?php echo $jour['jour'] ?></td>
                                                <?php
                                                $afficherjour = $connexion->prepare("SELECT heure.unite, cours.nomcours,enseignants.nom,enseignants.postnom FROM affectation,cours,enseignants,horaire,heure WHERE affectation.id=horaire.affectation and affectation.cours=cours.id and affectation.enseignant=enseignants.id and horaire.heure=heure.id and horaire.heure=heure.id and classe='$idclasse' and jours='$jours' order by horaire.heure");
                                                $afficherjour->execute();
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

                            <div class="btn-wrap">
                                <a href="#" class="btn-buy">Exit</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Pricing Section -->

    </main>

    <footer id="footer" class="footer position-relative">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1">Sainte_Croix</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="tel:0997019883">Lad_77</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assetts/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assetts/vendor/php-email-form/validate.js"></script>
    <script src="assetts/vendor/aos/aos.js"></script>
    <script src="assetts/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assetts/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assetts/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assetts/js/main.js"></script>

</body>

</html>