<?php
// Inclusion du fichier contenant les fonctions CRUD pour les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Récupération de l'ID du membre depuis l'URL
$member_id = $_GET['id'] ?? null;

// Vérification de la présence de l'ID du membre
if ($member_id === null) {
    exit("ID du membre non spécifié.");
}

try {
    // Récupération des détails du membre depuis la base de données
    $member = getMemberById($bdd, $member_id);

    // Vérification si le membre existe
    if (!$member) {
        exit("Membre non trouvé.");
    }

    // Récupération de la liste des emplois disponibles
    $jobs = listJobs($bdd);

    // Récupération des emplois sélectionnés pour ce membre
    $selected_jobs = getMemberJobs($bdd, $member_id);

} catch (PDOException $e) {
    // En cas d'erreur PDO, affichage du message d'erreur
    exit("Erreur lors de la récupération des données du membre : " . $e->getMessage());
}
?>