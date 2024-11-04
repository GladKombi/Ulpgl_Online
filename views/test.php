<?php
// Connexion à la base de données
include '../connexion/connexion.php'; 

// Fonction pour calculer l'année scolaire en cours
function getAnneeScolaire() {
    $mois = date('m');
    $annee = date('Y');
    return ($mois < 9) ? $annee - 1 : $annee;
}

// Récupération de tous les niveaux
$stmt = $pdo->query('SELECT * FROM classe');
while ($niveau = $stmt->fetch()) {
    // Calcul de l'année de début de la promotion en fonction du niveau et de l'année scolaire
    $annee_debut = getAnneeScolaire() - $niveau['duree'] + 1;
    echo $annee_debut;

    // Création du nom de la promotion
    // $nom_promo = $niveau['nom_niveau'] . ' ' . $annee_debut . '-' . ($annee_debut + $niveau['duree'] - 1);

    // Insertion de la promotion si elle n'existe pas déjà
    // $stmt = $pdo->prepare('INSERT INTO promotions (nom_promo, id_niveau, annee_scolaire) VALUES (:nom_promo, :id_niveau, :annee_scolaire)');
    // $stmt->execute(['nom_promo' => $nom_promo, 'id_niveau' => $niveau['id_niveau'], 'annee_scolaire' => $annee_debut]);
}