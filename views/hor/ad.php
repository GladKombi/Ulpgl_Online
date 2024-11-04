<?php 
include 'connexion.php';//Se connecter à la BD
 

 //  suppression une cours 
 if (isset($_GET['idSupcat']) && !empty($_GET['idSupcat'])) {
  $id=$_GET['idSupcat'];
  $supprimer=1;
  $bdd-> query("UPDATE cours SET supprimer='$supprimer' WHERE id=$id");
  header("Location:ad.php");
}


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Administration</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="style.css">
    


</head>

<body >

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="ad.php" class="logo d-flex align-items-center">
               
                <span class="d-none d-lg-block ">Page Admin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

       

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar contenu">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="listecours.php">
                    <i class="bi bi-book"></i>
                    <span> Liste Cours</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="listeclasse.php">
              
                    <i class="bi bi-house-door"></i>
                    <span> Liste de Classe</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="listeEnsei.php">
                    <i class="bi bi-person-circle"></i>
                    <span> Liste d'Enseingants</span>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed"  href="listeAffec.php">
        
                    <i class="bi bi-chevron-double-right"></i>
                    <span> Affectation</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed"href="listehoraire.php">
                    <i class="bi bi-list-check"></i>
                    <span> Horaire</span>
                </a>
            </li><!-- End Login Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed"href="listedemande.php">
                    <i class="bi bi-mail"></i>
                    <span> Demande</span>
                </a>
            </li><!-- End Login Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> Bienvenu sur la page Admin</h5>

                            <!-- Table with stripped rows -->
                            
                            <table class="table table-striped table-sm">
                    
              
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>


           
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    
   <!-- End Footer -->

    <a href="#" class="back-to-top d-flex couleur align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
           
   <script src="assetss/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

      <!-- Template Main JS File -->
      <script src="assets/js/main.js"></script>

</body>

</html>