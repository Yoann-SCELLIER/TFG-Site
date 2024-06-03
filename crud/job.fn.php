<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour selectionné un job dans la base de données
function getJobs($bdd) {
    try {
        // Requête SQL pour récupérer tous les emplois de la table 'job'
        $sql = "SELECT * FROM job";
        $stmt = $bdd->query($sql);
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $jobs;
    } catch (PDOException $e) {
        // Gérer les erreurs de requête SQL
        exit("Erreur lors de la récupération des emplois: " . $e->getMessage());
    }
}

