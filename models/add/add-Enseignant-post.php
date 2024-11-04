<?php
include('../../connexion/connexion.php');
if (isset($_POST['Valider'])) {
  $nom = htmlspecialchars($_POST['nom']);
  $postnom = htmlspecialchars($_POST['postnom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $genre = htmlspecialchars($_POST['genre']);
  $Adresse = htmlspecialchars($_POST['adresse']);
  $phone = htmlspecialchars($_POST['telephone']);
  $journee = htmlspecialchars($_POST['journee']);
  $photo = $_FILES['photo']['name'];
  $upload = "../../photo/profilProf/" . $photo;
  move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
  if (is_numeric($phone)) {
    #verifier si le client existe ou pas dans la bd
    $statut = 0;
    $getClass = $connexion->prepare("SELECT * FROM `enseignants` WHERE `tel`=? AND supprimer=?");
    $getClass->execute([$phone, $statut]);
    ($Class = $getClass->fetch());
    if ($Class > 0) {
      $msg = 'Cet Enseigant existe déjà dans la base de données !';
      $_SESSION['msg'] = $msg;
      header("location:../../views/Enseigants.php");
    } else {
      //Insertion data from database
      $req = $connexion->prepare("INSERT INTO `enseignants`(`nom`, `postnom`, `prenom`, `tel`, `genre`, `adresse`, `jrnepeda`, `photo`, `supprimer`) VALUES(?,?,?,?,?,?,?,?,?)");
      $resultat = $req->execute([$nom, $postnom, $prenom, $phone, $genre, $Adresse, $journee, $photo, $statut]);
      if ($resultat == true) {
        $_SESSION['msg'] = "Un Enregistrement viens d'etre effectué !";
        header("location:../../views/Enseigants.php");
      } else {
        $_SESSION['msg'] = "Echec d'enregistrement !";
        header("location:../../views/Enseigants.php");
      }
    }
  } else {
    $_SESSION['msg'] = "Le numero de telephone ne doit containir que des chiffre !";
    header("location:../../views/Enseigants.php");
  }
} else {
  header('location:../../views/Enseigants.php');
}
