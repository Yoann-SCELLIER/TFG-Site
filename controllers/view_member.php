<?php
require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérifier et récupérer l'ID du membre depuis l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    
    // Récupérer les détails du membre
    $member = getMemberById($bdd, $member_id);
    
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
    $consoles = []; // Initialiser la variable $consoles
    if (!empty($member['consoles'])) {
        // Si le membre a des consoles, les récupérer
        $consoles = $member['consoles'];
    }
} else {
    echo "ID du membre invalide.";
    exit;
}

// Inclure la vue pour afficher les détails du membre
include dirname(__DIR__) . '\views\member_detail.html.php';
?>
