<?php

require_once dirname(__DIR__) . '\crud\member.fn.php';

$game_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $cover = $_POST['cover'];
    
    if ($game_id) {
        // Modifier le jeu existant
        updateGame($bdd, $game_id, $title, $content, $cover);
        header('Location: /TFG/games.php');
        exit;
    } else {
        // Ajouter un nouveau jeu
        addGame($bdd, $title, $content, $cover);
        header('Location: /TFG/games.php');
        exit;
    }
} else {
    if ($game_id) {
        // Charger les données du jeu existant pour modification
        $game = getGameById($bdd, $game_id);
        $title = $game['title'];
        $content = $game['content'];
        $cover = $game['cover'];
        $formTitle = "Modifier le jeu";
        $action = "/TFG/admin/admin_form_game.php?id=$game_id";
    } else {
        // Initialiser le formulaire pour ajouter un nouveau jeu
        $title = '';
        $content = '';
        $cover = '';
        $formTitle = "Ajouter un jeu";
        $action = "/TFG/admin/admin_form_game.php";
    }
}

// Inclure la vue pour le formulaire
require_once dirname(__DIR__) . '/views/admin_formu_game.html.php';
?>
