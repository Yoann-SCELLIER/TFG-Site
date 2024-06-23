<?php
// Inclusion du fichier contenant les fonctions CRUD pour les jeux
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si $member_id est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id']; 
} else {
    // Rediriger vers une page d'erreur si $member_id n'est pas défini
    header('Location: /TFG/404.php');
    exit();
}

// Récupérer les informations du membre
$member = getMemberById($bdd, $member_id); // Fonction à définir pour récupérer les détails du membre

// Récupérer les jeux associés au membre
$games = view_list_game($bdd); // Récupérer la liste complète des jeux
$selected_games = getMemberGames($bdd, $member_id); // Récupérer les jeux sélectionnés pour le membre

// Déterminer si le membre a des jeux associés
$hasGames = !empty($selected_games);
?>
