<?php
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si un ID de jeu est présent dans l'URL
$game_id = isset($_POST['id']) ? (int)$_POST['id'] : null;

// Vérifier si l'ID du jeu est valide
if ($game_id) {
    // Supprimer le jeu
    deleteGame($bdd, $game_id);
    // Rediriger vers la page d'affichage des jeux après la suppression
    header('Location: /TFG/admin/admin_view_list_game.php');
    exit;
} else {
    // Si l'ID du jeu n'est pas valide, afficher un message d'erreur
    echo "ID de jeu invalide.";
}
?>
