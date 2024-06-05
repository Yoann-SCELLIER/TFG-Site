<?php

// Inclure la fonction pour récupérer la liste des emplois 
require_once dirname(__DIR__) . '/crud/member.fn.php';

try {
    // Récupérer la liste des emplois depuis la base de données
    $jobs = listJobs($bdd);

    // Inclure la vue pour afficher la liste des emplois
    require_once dirname(__DIR__) . '/views/job_list.php';
} catch (PDOException $e) {
    // En cas d'erreur de base de données, afficher un message d'erreur
    exit("Erreur lors de la récupération de la liste des emplois : " . $e->getMessage());
}
?>