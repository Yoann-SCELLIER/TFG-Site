<?php
// Assurez-vous que le chemin vers member.fn.php est correct
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Récupération de l'ID du membre depuis l'URL
$member_id = $_GET['id'] ?? null;

// Vérification si l'ID est valide
if ($member_id === null) {
    exit("ID du membre non spécifié.");
}

// Récupération du membre à partir de l'ID
$member = getMemberById($bdd, $member_id);

// Vérification si le membre existe
if ($member === null) {
    exit("Membre non trouvé.");
}

// Récupération de tous les jobs disponibles
$jobs = listJobs($bdd);

// Récupération des jobs sélectionnés par le membre
$member_jobs = getMemberJobs($bdd, $member_id);
$selected_jobs = array_column($member_jobs, 'job_id'); // Assurez-vous que cette ligne est bien présente

?>
