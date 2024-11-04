<?php
include('../../connexion/connexion.php');
$jour = $_GET['idjour'];
$classee = $_GET['idclasse'];
$heure = $_GET['idheure'];
if (isset($_POST['envoyer'])) {
    $jours = $jour;
    $classe = $classee;
    $heures = $heure;
    $affectation = htmlspecialchars($_POST['affectation']);    
    $supprimer = 0;
    # Data insertion
    if (!empty($affectation) && !empty($jours) && !empty($classe) && !empty($heures)) {
        $sendData = $connexion->prepare(" INSERT INTO `horaire`(`affectation`, `classe`, `jours`, `heure`, `supprimer`) VALUES (?,?,?,?,?)");
        $resultat = $sendData->execute([$affectation, $jours, $classe, $heures, $supprimer]);
        if ($resultat == true) {
            $_SESSION['msg'] = "L'horaire viens d'etre mis à jour !";
            header("location:../../views/Horaire-View.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement !";
            header("location:../../views/Horaire-View.php");
        }
    } else {
        $_SESSION['msg'] = "Echec d'enregistrement, Nous n'arrivons pas à trouver des données pour mettre à jour l'horaire !";
        header("location:../../views/Horaire-View.php");
    }
} else {
    $_SESSION['msg'] = "Echec d'enregistrement !";
    header("location:../../views/Horaire-View.php");
}
