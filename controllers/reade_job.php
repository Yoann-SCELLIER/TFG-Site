<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

// Inclure la fonction pour récupérer les emplois
require_once dirname(__DIR__) . '\crud\job.fn.php';

// Appeler la fonction pour récupérer les emplois
$jobs = getJobs($bdd);

// Créer un tableau pour stocker uniquement les titres des emplois
$jobTitles = array();
foreach ($jobs as $job) {
    $jobTitles[] = $job['title'];
}