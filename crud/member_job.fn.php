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

function getMemberJobs($member_id, $bdd) {
    try {
        $sql = "SELECT job.title, job.content, member.username 
                FROM job 
                INNER JOIN member_job ON job.job_id = member_job.job_id 
                INNER JOIN member ON member_job.member_id = member.member_id 
                WHERE member_job.member_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($jobs); // Pour déboguer, vous pouvez le supprimer en production
        return $jobs;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des emplois du membre: " . $e->getMessage());
    }
}