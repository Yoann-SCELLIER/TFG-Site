<?php
// Inclusion des fichiers contenant les fonctions CRUD pour les membres et les consoles de jeux
require_once dirname(__DIR__) . '/crud/member.fn.php';
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérification et récupération de l'ID du membre depuis l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    
    // Récupération des détails du membre à partir de l'ID
    $member = getMemberById($bdd, $member_id);

    // Vérification si le membre existe
    if (!$member) {
        echo "Membre introuvable.";
        exit;
    }

    // Définition des noms de rôle et des classes CSS associées
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

    // Récupération des consoles de jeux du membre
    $consoles = getMemberConsoles($bdd, $member_id);
    $hasConsoles = !empty($consoles);

    // Récupération des jeux du membre
    $games = getMemberGames($bdd, $member_id);
    $hasGames = !empty($games);

    // Récupération des jobs du membre depuis la table member_job
    $jobs = getMemberJobs($bdd, $member_id);
    $hasJobs = !empty($jobs);

} else {
    echo "ID du membre invalide.";
    exit; 
}
?>