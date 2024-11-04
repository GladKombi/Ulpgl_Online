<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horaire</title>
    <?php require_once('style.php'); ?>
    <link rel="stylesheet" href="../assets/css/sainte.css">
  </head>
  <body>
    <!-- navbar start -->
    <div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Twelfth navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample10"
            aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
            <ul class="navbar-nav">

              <li class="nav-item">
                <a class="nav-link active" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="about.php">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="about.php">A propos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="horaire.php">Horaire General</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-bs-toggle="dropdown"
                  aria-expanded="false">Choisir la classe</a>
                <ul class="dropdown-menu lesclasses" aria-labelledby="dropdown10">
                  <li value="">
                    <a class="anavbar" class="dropdown-item" href="#">Description</a>
                  </li>
                  <li value="">
                    <a class="anavbar" class="dropdown-item" href="#">Description</a>
                  </li>
                  <li value="">
                    <a class="anavbar" class="dropdown-item" href="#">Description</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <!-- navbar End -->
    <!-- table container start -->
    <div class="container">
      <h3 class="text-center">Nom de la Clase</h3>
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Heure</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-primary">
            <td>Jour</td>
            <td>nom cours</td>
            <td></td>
        </tbody>
      </table>
    </div>
    <!-- table container End -->
    <?php
    include('footer.php');
    ?>
    <script src="assetss/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>