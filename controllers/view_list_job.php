<?php
// Inclusion du fichier contenant les fonctions CRUD pour les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['member_id'])) {
    header('Location: /log.php');
    exit();
} 

// Récupération et validation de l'ID du membre depuis l'URL 
$member_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$member_id) {
    exit("ID du membre non spécifié ou invalide.");
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
    exit("Erreur lors de la récupération des données du membre : " . htmlspecialchars($e->getMessage()));
}
?>
