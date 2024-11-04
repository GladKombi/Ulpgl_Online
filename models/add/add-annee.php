<?php
#script d'insertion des boutiques dans la base de données
include('../../connexion/connexion.php');
if (isset($_GET['btn'])) {

    $date1 = date('Y');
    $date2 = $date1 + 1;

    // Récupérer la dernière ligne insérée en utilisant la colonne auto-incrémentée 'id'
    $query = "SELECT * FROM anneescolaire ORDER BY id DESC LIMIT 1";
    $stmt = $connexion->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $libelle2 = $data['libelle2'] + 1;

            $query1 = "INSERT INTO anneescolaire(libelle, libelle2, `statut`) VALUES (?, ?, ?)";
            $smt = $connexion->prepare($query1);
            $smt->execute([$data['libelle2'], $libelle2, 0]);
            $id = $connexion->lastInsertId();
            if ($smt == true) {
                $selection = "SELECT * FROM `classe` WHERE classe.supprimer=?";
                $getClass = $connexion->prepare($selection);
                $getClass->execute([0]);
                while ($idClass = $getClass->fetch()) {
                    $class = $idClass['id'];
                    $queryProm = "INSERT INTO `promotion`(`classe`, `anneeSco`, `statut`) VALUES (?, ?, ?)";
                    $resultat = $connexion->prepare($queryProm);
                    $resultat->execute([$class, $id, 0]);
                }
            }
        }
    } else {
        $query1 = "INSERT INTO anneescolaire(libelle, libelle2, `statut`) VALUES (?, ?, ?)";
        $smt = $connexion->prepare($query1);
        $smt->execute([$date1, $date2, 0]);
    }

    header("Location:../../views/AnneeScolaire.php");
}
