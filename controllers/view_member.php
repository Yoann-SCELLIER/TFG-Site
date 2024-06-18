<?php
require_once dirname(__DIR__) . '/crud/member.fn.php';
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier et récupérer l'ID du membre depuis l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    
    // Récupérer les détails du membre
    $member = getMemberById($bdd, $member_id);

    if (!$member) {
        echo "Membre introuvable.";
        exit;
    }

    // Définir les noms de rôle et les classes CSS associées
    $roles = [
        'memberAdmin' => ['name' => 'Admin', 'class' => 'role-admin'],
        'memberOfficial' => ['name' => 'TF Officiel', 'class' => 'role-tf-officiel'],
        'memberGuest' => ['name' => 'Invité', 'class' => 'role-invite']
    ];

    // Mapper le rôle du membre à un nom plus lisible et à une classe CSS
    if (isset($member['role_member']) && isset($roles[$member['role_member']])) {
        $member['role_member_name'] = $roles[$member['role_member']]['name'];
        $member['role_member_class'] = $roles[$member['role_member']]['class'];
    } else {
        $member['role_member_name'] = 'Non défini';
        $member['role_member_class'] = 'role-non-defini'; // Classe CSS par défaut si le rôle n'est pas défini
    }

    // Récupérer les consoles du membre
    $consoles = getMemberConsoles($bdd, $member_id);
    $hasConsoles = !empty($consoles);

    // Récupérer les jeux du membre
    $games = getMemberGames($bdd, $member_id);
    $hasGames = !empty($games);

    // Récupérer les jobs du membre depuis la table member_job
    $jobs = getMemberJobs($bdd, $member_id);
    $hasJobs = !empty($jobs);

} else {
    echo "ID du membre invalide.";
    exit; 
}
