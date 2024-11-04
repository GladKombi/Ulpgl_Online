<?php
// $ActiveClasse=0;
// $ActiveOption=0;
?>
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <!-- <img src="../assets/images/logo.png" alt="" srcset=""> -->
             <h4>Sainte_Croix</h4>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Menus</li>
                <li <?php if($ActiveClasse==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="classe.php" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Classes</span>
                    </a>
                </li>
                <li <?php if($ActiveEleve==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="eleves.php" class='sidebar-link'>
                        <i class="bi bi-people-fill" width="25"></i>
                        <span>Eleves</span>
                    </a>
                </li>
                <li <?php if($ActiveEseigant==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Enseigants.php" class='sidebar-link'>
                        <i class="bi bi-file-earmark-person" width="25"></i>
                        <span>Enseigants</span>
                    </a>
                </li>
                <li <?php if($ActiveOption==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="option.php" class='sidebar-link'>
                        <i class="bi bi-journals" width="25"></i>
                        <span>Options</span>
                    </a>
                </li>
                <li <?php if($ActiveCours==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="cours.php" class='sidebar-link'>
                        <i class="bi bi-clipboard" width="25"></i>
                        <span>Cours</span>
                    </a>
                </li>
                <li <?php if($ActiveAffectation==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Affectation.php" class='sidebar-link'>
                        <i class="bi bi-clipboard" width="25"></i>
                        <span>Affectation</span>
                    </a>
                </li>
                <li <?php if($ActiveHoraire==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Horaire.php" class='sidebar-link'>
                        <i class="bi bi-journals" width="25"></i>
                        <span>Horaire</span>
                    </a>
                </li>
                <li <?php if($ActiveInformation==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="information.php" class='sidebar-link'>
                        <i class="bi bi-camera-reels" width="25"></i>
                        <span>Informations</span>
                    </a>
                </li>    
                <li <?php if($ActiveCommunique==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Communique.php" class='sidebar-link'>
                        <i class="bi bi-chat-right-dots" width="25"></i>
                        <span>Communiqué</span>
                    </a>
                </li>
                <li <?php if($ActiveCatFrais==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="CatFrais.php" class='sidebar-link'>
                        <i class="bi bi-calculator" width="25"></i>
                        <span>Catégorie Frais</span>
                    </a>
                </li>
                <li <?php if($ActiveFrais==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Frais.php" class='sidebar-link'>
                        <i class="bi bi-calculator" width="25"></i>
                        <span>Frais</span>
                    </a>
                </li>
                <li <?php if($ActivePayement==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="payement.php" class='sidebar-link'>
                        <i class="bi bi-calculator" width="25"></i>
                        <span>Payement</span>
                    </a>
                </li>
                <li <?php if($ActivePeriode==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Periode.php" class='sidebar-link'>
                        <i class="bi bi-calendar-day-fill" width="25"></i>
                        <span>Periodes</span>
                    </a>
                </li>
                <li <?php if($ActiveAnee==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="AnneeScolaire.php" class='sidebar-link'>
                        <i class="bi bi-calendar-day-fill" width="25"></i>
                        <span>Année Scolaire</span>
                    </a>
                </li>
                <li <?php if($ActivePromo==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="promotion.php" class='sidebar-link'>
                        <i class="bi bi-calendar-day-fill" width="25"></i>
                        <span>Promotion</span>
                    </a>
                </li>
                <li <?php if($ActiveInscription==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="inscription.php" class='sidebar-link'>
                        <i class="bi bi-calendar-day-fill" width="25"></i>
                        <span>Inscription</span>
                    </a>
                </li>
                <li <?php if($ActiveCotations==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="Cote.php" class='sidebar-link'>
                        <i class="bi bi-clipboard" width="25"></i>
                        <span>Cotations</span>
                    </a>
                </li>
                <li <?php if($ActiveUser==1){?> class="sidebar-item active"<?php } ?>>
                    <a href="utilisateurs.php" class='sidebar-link'>
                        <i data-feather="user" width="25"></i>
                        <span>Utilisateur</span>
                    </a>
                </li>



                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="user" width="20"></i>
                        <span>Widgets</span>
                    </a>


                    <ul class="submenu ">

                        <li>
                            <a href="ui-chatbox.html">Chatbox</a>
                        </li>

                        <li>
                            <a href="ui-pricing.html">Pricing</a>
                        </li>

                        <li>
                            <a href="ui-todolist.html">To-do List</a>
                        </li>

                    </ul>

                </li>



                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="trending-up" width="20"></i>
                        <span>Charts</span>
                    </a>


                    <ul class="submenu ">

                        <li>
                            <a href="ui-chart-chartjs.html">ChartJS</a>
                        </li>

                        <li>
                            <a href="ui-chart-apexchart.html">Apexchart</a>
                        </li>

                    </ul>

                </li>



                <li class='sidebar-title'>Pages</li>



                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="user" width="20"></i>
                        <span>Authentication</span>
                    </a>


                    <ul class="submenu ">

                        <li>
                            <a href="auth-login.html">Login</a>
                        </li>

                        <li>
                            <a href="auth-register.html">Register</a>
                        </li>

                        <li>
                            <a href="auth-forgot-password.html">Forgot Password</a>
                        </li>

                    </ul>

                </li>



                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="alert-circle" width="20"></i>
                        <span>Errors</span>
                    </a>


                    <ul class="submenu ">

                        <li>
                            <a href="error-403.html">403</a>
                        </li>

                        <li>
                            <a href="error-404.html">404</a>
                        </li>

                        <li>
                            <a href="error-500.html">500</a>
                        </li>

                    </ul>

                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>