<?php
// Inclure la fonction pour récupérer les consoles sélectionnées pour un membre
require_once dirname(__DIR__) . '\crud\game_console.fn.php';

// Récupérer l'ID du membre
$member_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Vérifier si l'ID du membre est spécifié
if ($member_id) {
    // Appeler la fonction pour récupérer les consoles sélectionnées pour le membre
    $consoles = getMemberConsoles($bdd, $member_id);
    // Vérifier si le membre a des consoles
    $hasConsoles = !empty($consoles);
} else {
    $consoles = [];
    $hasConsoles = false;
}

// Inclure la vue pour afficher les détails du membre avec les consoles
require_once dirname(__DIR__) . '\views\member_detail.html.php';
?>
