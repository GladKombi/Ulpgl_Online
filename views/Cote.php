<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div id="app">
        <?php
        require_once('Active.php');
        $ActiveCotations = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-center">Enregistrement de cote</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <div class="alert-info alert text-center">Message</div>
                    <div class="col-xl-12 col-lg-12 col-md-6 ">
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                            <h5 class="">classe:(Description)</h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                            <h5 class="">Cours:(Description)</h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                            <h5 class="">Tutilaire du cours:(Description)</h5>
                        </div>
                    </div>
                    <!-- Le form qui enregistrer les données  -->
                    <div class="col-xl-12 col-lg-12 col-md-6 table-responsive px-3 pt-3">
                        <form action="" class="shadow p-3">
                            <table class='table table-hover' id="table1">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Noms</th>
                                        <th>Maxima</th>
                                        <th>Cote</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>
                                            MUHINDO
                                            KOMBI
                                            Glad
                                        </td>
                                        <td>20 Pts</td>
                                        <td>
                                            <input required type="text" class="form-control" placeholder="Saisir la cote de Glad">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                <input type="submit" class="btn btn-success w-100" value="Enregistrer">
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-6 ">
                        <h4 class="text-center">Fiche de cote</h4>
                        <table class="table table-sm text-center shadow">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Noms</th>
                                    <th>Cote</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>
                                        MUHINDO
                                        KOMBI
                                        Glad
                                    </td>
                                    <td> <span class="text-danger bolder">8</span>/20</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="#" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
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