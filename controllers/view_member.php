<?php
require_once dirname(__DIR__) . '\crud\member.fn.php';
require_once dirname(__DIR__) . '\crud\game_console.fn.php';

// Vérifier et récupérer l'ID du membre depuis l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    
    // Récupérer les détails du membre
    $member = getMemberById($bdd, $member_id);

    if (!$member) {
        echo "Membre introuvable.";
        exit;
    }

    // Définir les noms de rôle
    $role_names = [
        'memberAdmin' => 'Admin',
        'memberOfficial' => 'TF Officiel',
        'memberGuest' => 'Invité'
    ];

    // Mapper le rôle du membre à un nom plus lisible
    if (isset($member['role_member']) && isset($role_names[$member['role_member']])) {
        $member['role_member'] = $role_names[$member['role_member']];
    } else {
        $member['role_member'] = 'Aucun rôle'; // Valeur par défaut si le rôle n'est pas défini
    }

    // Récupérer les consoles du membre
    $consoles = getMemberConsoles($bdd, $member_id);
    $hasConsoles = !empty($consoles);

} else {
    echo "ID du membre invalide.";
    exit;
}
?>
