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
        $ActiveInformation = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Informations</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <div class="alert-info alert text-center"> Message </div>
                    <!-- Le form qui enregistrer les données  -->
                    <div class="col-xl-12 ">
                        <form action="" method="POST" class="shadow p-3">
                            <div class="row">
                                <?php if (isset($_GET['idinfo'])) {
                                ?>
                                    <h4 class="text-center">Modifier une information </h4>
                                <?php
                                } else {
                                ?>
                                    <h4 class="text-center">Ajouter une information </h4>
                                <?php
                                }
                                ?>

                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Intituler <span class="text-danger">*</span></label>
                                    <input required type="text" name="" class="form-control" placeholder="Intituler votre information" value="">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <textarea required name="" placeholder="Decrivez votre information ..." class="form-control" id="about" style="height: 100px"></textarea>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                    <input type="submit" name="valider" class="btn btn-success w-100" value="Enregistrer">
                                </div>


                            </div>
                        </form>
                    </div>
                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Intituler</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">1</th>
                                    <td>Description</td>
                                    <td>Description</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm">
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