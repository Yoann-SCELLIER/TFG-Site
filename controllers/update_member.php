<?php
// Assurez-vous que le chemin vers les fichiers CRUD est correct
require_once dirname(__DIR__) . '/crud/member.fn.php';
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Récupération de l'ID du membre depuis l'URL
$member_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Vérification si l'ID est valide
if ($member_id === false || $member_id === null) {
    exit("ID de membre non valide.");
}

// Récupération des données du membre et vérification de son existence
$member = getMemberById($bdd, $member_id);
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

// Vérification si la méthode HTTP est POST pour effectuer la mise à jour
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

        // Début de la transaction pour assurer l'intégrité des données
        $bdd->beginTransaction();

        // Mise à jour des détails du membre dans la base de données
        updateMember($bdd, $member_id, $cover, $username, $email, $content, $role_id, $departement_id);

        // Mise à jour des compétences (jobs) du membre
        updateMemberJobs($bdd, $member_id, $jobs_selected);

        // Mise à jour des jeux sélectionnés pour le membre
        updateMemberGames($bdd, $member_id, $games_selected);

        // Validation des opérations et commit de la transaction
        $bdd->commit();

        // Redirection après la mise à jour réussie
        header('Location: /TFG/index.php');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, annulation de la transaction et gestion de l'erreur
        $bdd->rollBack();
        echo "Erreur lors de la mise à jour du membre : " . $e->getMessage();
    }
}