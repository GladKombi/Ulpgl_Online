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
        $ActiveHoraire = 1;
        require_once('aside1.php');
        ?>
        <div id="main">
            <?php require_once('navbar.php') ?>
            <div class="main-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Horaire</h4>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title text-center">Les paramettres de l'horaire</h4>
                                    <p class="card-text text-center">
                                        ces paramettre servent à consulter et à mettre à jour l'horaire
                                    </p>
                                    <center>
                                      <a href="Horaire-View.php" class="btn icon icon-left btn-success"><i class="bi bi-gear"></i> Gerer horaire</a>  
                                    </center>
                                    
                                </div>                                
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="#" class="btn btn-success w-100">Voir Tout l'horaire</a>
                            </div>
                        </div>
                    </div>

                    <!-- pour afficher les massage  
                    <div class="alert-info alert text-center">Message</div>-->
                    <!-- Le form qui enregistrer les données  
                    <div class="col-xl-12 ">
                        <form action="" class="shadow p-3">
                            <div class="row">
                                <h5 class="text-center">Ajouter l'horaire </h5>

                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Classe <span class="text-danger">*</span></label>
                                    <select required name="" id="" class="form-select">
                                        <option value="">Description</option>
                                        <option value="">Description</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Cours <span class="text-danger">*</span></label>
                                    <select required name="" id="" class="form-select">
                                        <option value="">Description</option>
                                        <option value="">Description</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Proffesseur <span class="text-danger">*</span></label>
                                    <select required name="" id="" class="form-select">
                                        <option value="">Description</option>
                                        <option value="">Description</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                    <label for="">Heure <span class="text-danger">*</span></label>
                                    <select required name="" id="" class="form-select">
                                        <option value="">Description</option>
                                        <option value="">Description</option>
                                    </select>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                    <input type="submit" class="btn btn-success w-100" value="Enregistrer">
                                </div>
                            </div>
                        </form>
                    </div>-->
                    <!-- La table qui affiche les données  
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <table class="table table-sm text-center shadow">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Heure</th>
                                    <th>Classe/Option</th>
                                    <th>Cours</th>
                                    <th>Professeur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <th>1</th>
                                <td>Description</td>
                                <td>Description</td>
                                <td>Description</td>
                                <td>Description</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm "><i class="bi bi-pencil-square"></i></a>
                                    <a href="" class="btn btn-danger btn-sm "><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tbody>
                        </table>
                    </div>-->
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