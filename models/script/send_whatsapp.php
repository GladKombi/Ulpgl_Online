<?php

// Script d'insertion des boutiques dans la base de données
include('../../connexion/connexion.php');

if (isset($_GET['whatsapp'])) {
    // Préparation des requêtes SQL
    $getData = $connexion->prepare("SELECT `matricule`, `nom`, `postnom`, `prenom`, `genre`, `adresse`, `nomPere`, `nomMere`, `numeroParent`, `photo`, `statut` FROM `eleve` WHERE `statut` = 0");
    $getData->execute();

    $getSeuil = $connexion->prepare("SELECT seuil.*, periode.libelle AS periode FROM `seuil` JOIN `periode` ON seuil.periode = periode.id WHERE seuil.statut = 0");
    $getSeuil->execute();

    // Récupération des seuils
    $seuils = $getSeuil->fetchAll(PDO::FETCH_ASSOC);
    
    // Pour chaque élève
    while ($idEleve = $getData->fetch(PDO::FETCH_ASSOC)) {
        $matricule = htmlspecialchars($idEleve['matricule']);
        $numeroParent = htmlspecialchars($idEleve['numeroParent']);
        $nom = htmlspecialchars($idEleve['nom']);
        $postnom = htmlspecialchars($idEleve['postnom']);
        $nomPere = htmlspecialchars($idEleve['nomPere']);
        $nomMere = htmlspecialchars($idEleve['nomMere']);

        // Associer chaque élève avec un seuil
        foreach ($seuils as $idSeuil) {
            $montant = htmlspecialchars($idSeuil['montant']);
            $periode = htmlspecialchars($idSeuil['periode']);

            // Générer le lien WhatsApp
            $message = urlencode("Sainte Croix Notification !\n $nomPere et $nomMere nous vous informons que le seuil de paiement des frais scolaire pour cette periode est de $montant ");
            $url = "https://wa.me/$numeroParent?text=$message";

            // Debugging : afficher l'URL générée
            echo "<p>URL générée pour $numeroParent : <a href=\"$url\" target=\"_blank\">$url</a></p>";

            ?>
            <a href="<?= htmlspecialchars($url) ?>" class="linkedin" target="_blank">
                <i class="bi bi-whatsapp"></i>
            </a>
            <?php
        }
    }
}
?>
