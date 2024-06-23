<?php
// Inclusion des fichiers nécessaires
require_once dirname(__DIR__) . '/crud/member.fn.php';
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['member_id'])) {
    header('Location: /TFG/log.php');
    exit();
}

// Récupération de l'ID du membre à afficher
$member_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Vérification si l'ID du membre est valide
if ($member_id === false || $member_id === null) {
    exit("ID de membre non valide.");
}

try {
    // Récupération des détails du membre depuis la base de données
    $member = getMemberById($bdd, $member_id);

    // Vérification si le membre existe
    if (!$member) {
        exit("Membre non trouvé.");
    }

    // Récupération des emplois disponibles et des emplois du membre
    $jobs = listJobs($bdd);
    $jobs_selected = getMemberJobs($bdd, $member_id);

    // Récupération des jeux disponibles et des jeux associés au membre
    $games = view_list_game($bdd);
    $selected_games = getMemberGames($bdd, $member_id);

    // Définition des rôles du membre
    $roles = [
        'memberAdmin' => ['name' => 'Admin', 'class' => 'role-admin'],
        'memberOfficial' => ['name' => 'TF Officiel', 'class' => 'role-tf-officiel'],
        'memberGuest' => ['name' => 'Invité', 'class' => 'role-invite']
    ];

    // Mapping du rôle du membre à un nom lisible et à une classe CSS
    if (isset($member['role_member']) && isset($roles[$member['role_member']])) {
        $member['role_member_name'] = $roles[$member['role_member']]['name'];
        $member['role_member_class'] = $roles[$member['role_member']]['class'];
    } else {
        $member['role_member_name'] = 'Non défini';
        $member['role_member_class'] = 'role-non-defini'; // Classe CSS par défaut si le rôle n'est pas défini
    }

    // Récupération des départements
    $departements = getDepartements($bdd);

} catch (PDOException $e) {
    // En cas d'erreur PDO, affichage du message d'erreur
    exit("Erreur lors de la récupération des données du membre : " . htmlspecialchars($e->getMessage()));
}
?>
