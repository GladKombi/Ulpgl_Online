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


                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center">Resultat Premiere Periode</h3>
                        <h4 class="">Noms : Glad </h4>
                        <h4 class="">Postnom : Kombi </h4>
                        <h4 class="">Prenom : Jospin</h4>
                        <h4 class="">Class : 7ieme A</h4>
                        <table class='table table-hover'>
                            <thead>
                                <tr>                                    
                                    <th>Cours</th>
                                    <th>Point Obtenus</th>
                                    <th>Maxima</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Anglais</td>
                                    <td>15</td>
                                    <td>20</td>                                    
                                </tr>
                                <tr>
                                    <td>Mathematique</td>
                                    <td>27</td>
                                    <td>40</td>                                    
                                </tr>
                                <tr>
                                    <td>Technologie</td>
                                    <td>15</td>
                                    <td>20</td>                                    
                                </tr>
                                <tr>
                                    <td>Francais</td>
                                    <td>15</td>
                                    <td>30</td>                                    
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th><h6>Total obtenu: 72 </h6></th>
                                    <th><h6>Total max: 110</h6></th>
                                </tr>
                                <tr>
                                    <th>Pourcentage</th>
                                    <td colspan="2" class="text-center"><h4>65.45 %</h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('script.php') ?>
</body>

</html>