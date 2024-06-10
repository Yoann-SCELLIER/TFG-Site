<?php
require_once dirname(__DIR__) . '/crud/game_console.fn.php'; // Chemin vers votre fichier contenant getGameById

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$game = null;

if ($id) {
    // Récupérer les informations du jeu à modifier
    $game = getGameById($bdd, $id);
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Si un ID est présent, il s'agit d'une modification
    if ($id) {
        // Appeler la fonction pour mettre à jour le jeu dans la base de données
        updateGame($bdd, $id, $title, $content, $image_url);
    } else {
        // Sinon, il s'agit d'un ajout
        // Appeler la fonction pour ajouter un nouveau jeu dans la base de données
        addGame($bdd, $title, $content, $image_url);
    }

    // Rediriger vers la page de gestion des jeux après le traitement
    header('Location: /TFG/admin/view_list_game.php');
    exit();
}
