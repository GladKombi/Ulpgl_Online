<?php
if (isset($_GET['seil'])) {
  $seuil = $_GET['seil'];
  $getSeuil = $connexion->prepare("SELECT seuil.*,periode.libelle as periode FROM `seuil`,periode WHERE seuil.statut=0;");
  $getSeuil->execute();
  if ($idSeuil = $getSeuil->fetch()) {
    $montant = $idSeuil['montant'];
    $periode = $idSeuil['periode'];
  }
}
$service_plan_id = "b511f637327e4576b470fdebd012ab10";
$bearer_token = "b42088bc5ab84517882f5df2893495a4";

//Any phone number assigned to your API
$send_from = "+447441421164";
# Se connecter à la BD
include '../../connexion/connexion.php';
$getData = $connexion->prepare("SELECT `matricule`, `nom`, `postnom`, `prenom`, `genre`, `adresse`, `nomPere`, `nomMere`, `numeroParent`, `photo`, `statut` FROM `eleve` WHERE statut=0;");
$getData->execute();
if ($idEleve = $getData->fetch()) {
  $matricule = $idEleve['matricule'];
  $Numero = $idEleve['numeroParent'];
  $nom = $idEleve['nom'];
  $postnom = $idEleve['postnom'];
  $nomPere = $idEleve['nom'];
  $nomMere = $idEleve['postnom'];
}
while ($idEleve = $getData->fetch(PDO::FETCH_ASSOC))
  //May be several, separate with a comma ,
  $recipient_phone_numbers = "+243978007173";
$message = "Hello Alice";

// Check recipient_phone_numbers for multiple numbers and make it an array.
if (stristr($recipient_phone_numbers, ',')) {
  $recipient_phone_numbers = explode(',', $recipient_phone_numbers);
} else {
  $recipient_phone_numbers = [$recipient_phone_numbers];
}

// Set necessary fields to be JSON encoded
$content = [
  'to' => array_values($recipient_phone_numbers),
  'from' => $send_from,
  'body' => $message
];

$data = json_encode($content);

$ch = curl_init("https://sms.api.sinch.com/xms/v1/b511f637327e4576b470fdebd012ab10/batches");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BEARER);
curl_setopt($ch, CURLOPT_XOAUTH2_BEARER, $bearer_token);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Curl error: ' . curl_error($ch);
} else {
  echo $result;
}
curl_close($ch);
