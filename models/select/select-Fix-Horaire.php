<?php
if (isset($_POST['Suivant'])) {
    $jours = htmlspecialchars($_POST['jours']);
    header("location: ../../views/fix-horaire.php?idjour=$jours");
    #header("Location: choisirclasse.php?idjour=$jours");
}
if (isset($_POST['envoyer']) && !empty($_GET['idjour'])) {
    $jour = $_GET['idjour'];
    $classe = htmlspecialchars($_POST['classe']);
    header("location: ../../views/fix-horaire.php?idjour=$jour&idclasse=$classe");
    #header("Location: choisirheure.php?idjour=$jour&idclasse=$classe ");
}
if (isset($_POST['envoyer']) && !empty($_GET['idjour']) && !empty($_GET['idclasse'])) {
    $classee = $_GET['idclasse'];
    $jour = $_GET['idjour'];
    $heure = htmlspecialchars($_POST['heure']);
    header("location: ../../views/fix-horaire.php?idjour=$jour&idclasse=$classee&idheure=$heure"); 
    #header("Location: ajouterhoraire.php?idjour=$jour&idclasse=$classee&idheure=$heure ");
}
