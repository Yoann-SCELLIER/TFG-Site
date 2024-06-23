<?php
// Inclusion des fichiers contenant les fonctions CRUD pour les membres et les jeux/consoles, situés dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/member.fn.php';
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

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

// Vérifie si la méthode de requête est POST (c'est-à-dire si le formulaire a été soumis)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupère les données soumises par le formulaire ou utilise les valeurs actuelles du membre si elles ne sont pas fournies
        $cover = $_POST['cover'] ?? $member['cover'] ?? '';
        $username = $_POST['username'] ?? $member['username'] ?? '';
        $email = $_POST['email'] ?? $member['email'] ?? '';
        $content = $_POST['content'] ?? $member['content'] ?? '';
        $role_id = $_POST['role_id'] ?? $member['role_id'] ?? '';
        $departement_id = $_POST['departement_id'] ?? $member['departement_id'] ?? '';
        $jobs_selected = isset($_POST['jobs']) ? $_POST['jobs'] : [];
        $games_selected = isset($_POST['games']) ? $_POST['games'] : [];

        // Vérification du rôle pour la redirection
        if ($role_id == 'officiel' || $role_id == 'invite') {
            // Redirection vers actualite.php pour les officiels et invités
            header('Location: /TFG/actualite.php');
            exit();
        } 

        // Mise à jour des détails du membre
        updateMember($bdd, $member_id, $cover, $username, $email, $content, $role_id, $departement_id);

        // Mise à jour des compétences (jobs) du membre
        updateMemberJobs($bdd, $member_id, $jobs_selected);

        // Mise à jour des jeux sélectionnés pour le membre
        updateMemberGames($bdd, $member_id, $games_selected);

        // Redirection après mise à jour réussie
        header('Location: /TFG/admin/dashboard.php');
        exit();
    } catch (PDOException $e) {
        // Gestion des erreurs (affichage du message d'erreur)
        echo "Erreur lors de la mise à jour du membre : " . $e->getMessage();
    }
}
?>
