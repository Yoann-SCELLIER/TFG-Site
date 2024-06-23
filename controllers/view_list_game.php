<?php
// Inclusion du fichier contenant les fonctions CRUD pour les jeux
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Récupérer les jeux associés au membre
$games = view_list_game($bdd); // Récupérer la liste complète des jeux

// Déterminer si le membre a des jeux associés
$hasGames = !empty($selected_games);
?>
