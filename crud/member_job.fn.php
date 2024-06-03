<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

//---------------------------------------------------------------------------------------------------------------------------------------------

function addMemberJob($bdd, $member_id, $job_id) {
    try {
        // Requête SQL pour ajouter un emploi à un membre dans la table de liaison
        $sql = "INSERT INTO member_job (member_id, job_id) VALUES (?, ?)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id, $job_id]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de requête SQL
        exit("Erreur lors de l'ajout de l'emploi au membre: " . $e->getMessage());
    }
}


// Fonction pour récupérer les titres des emplois d'un membre
function getMemberJobsTitles($bdd, $member_id) {
    try {
        $sql = "SELECT job.title 
                FROM job 
                INNER JOIN member_job ON job.job_id = member_job.job_id 
                WHERE member_job.member_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        $titles = $stmt->fetchAll(PDO::FETCH_COLUMN); // Récupère seulement les titres des jobs
        return $titles;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des titres des emplois du membre: " . $e->getMessage());
    }
}