<?php
// Inclusion des fichiers contenant les fonctions CRUD nécessaires
require_once dirname(__DIR__) . '/crud/member.fn.php';
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Récupération de l'ID du membre depuis l'URL
$member_id = $_GET['id'] ?? null;

// Vérification si l'ID est spécifié
if ($member_id === null) {
    exit("ID du membre non spécifié.");
}

// Récupération des détails du membre à partir de l'ID
$member = getMemberById($bdd, $member_id);

// Vérification si le membre existe
if ($member === null) {
    exit("Membre non trouvé.");
}

// Récupération des jobs disponibles
$jobs = listJobs($bdd);

// Récupération des jeux disponibles
$games = view_list_game($bdd);

// Récupération des départements disponibles
$departements = getDepartements($bdd);

// Récupération des jeux sélectionnés pour le membre
$selected_games = getMemberGames($bdd, $member_id);

// Récupération des jobs sélectionnés pour le membre
$jobs_selected = getMemberJobs($bdd, $member_id);

// Vérification si la méthode HTTP est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupération des données soumises par le formulaire
        $cover = $_POST['cover'] ?? $member['cover'] ?? '';
        $username = $_POST['username'] ?? $member['username'] ?? '';
        $email = $_POST['email'] ?? $member['email'] ?? '';
        $content = $_POST['content'] ?? $member['content'] ?? '';
        $role_id = $_POST['role_id'] ?? $member['role_id'] ?? '';
        $departement_id = $_POST['departement_id'] ?? $member['departement_id'] ?? '';
        $jobs_selected = isset($_POST['jobs']) ? $_POST['jobs'] : [];
        $games_selected = isset($_POST['games']) ? $_POST['games'] : [];

        // Mise à jour des détails du membre dans la base de données
        updateMember($bdd, $member_id, $cover, $username, $email, $content, $role_id, $departement_id);

        // Mise à jour des compétences (jobs) du membre
        updateMemberJobs($bdd, $member_id, $jobs_selected);

        // Mise à jour des jeux sélectionnés pour le membre
        updateMemberGames($bdd, $member_id, $games_selected);

        // Redirection après la mise à jour réussie
        header('Location: /TFG/index.php');
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur lors de la mise à jour du membre : " . $e->getMessage();
    }
}
?>
