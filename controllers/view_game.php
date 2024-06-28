<?php
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si un ID de jeu est présent dans l'URL
$game_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Si la requête est de type POST, cela signifie que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider et nettoyer les données du formulaire.
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $image_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';

    if ($game_id) {
        // Si un ID de jeu est présent, modifier le jeu existant de manière sécurisée
        updateGame($bdd, $game_id, $title, $content, $image_url);
        // Rediriger l'utilisateur vers la liste des jeux après la modification
        echo "<script>alert('Modification réussie.');</script>";
        header('Location: /TFG/admin/admin_view_list_game.php');
        exit;
    } else {
        // Sinon, ajouter un nouveau jeu de manière sécurisée
        addGame($bdd, $title, $content, $image_url);
        // Rediriger l'utilisateur vers la liste des jeux après l'ajout
        echo "<script>alert('Ajout réussi.');</script>";
        header('Location: /TFG/admin/admin_view_list_game.php');
        exit;
    }
} else {
    if ($game_id) {
        // Si un ID de jeu est présent, charger les données du jeu pour modification
        $game = getGameById($bdd, $game_id);
        if ($game) {
            $title = htmlspecialchars($game['title']); // Échapper les données pour éviter les attaques XSS
            $content = isset($game['content']) ? htmlspecialchars($game['content']) : '';
            $image_url = isset($game['cover']) ? htmlspecialchars($game['cover']) : '';
        } 
        
        $formTitle = "Modifier le jeu"; // Titre du formulaire pour la modification
        $action = "/TFG/admin/admin_form_game.php?id=$game_id"; // Action du formulaire pour la modification
    } else {
        // Si aucun ID de jeu n'est présent, initialiser le formulaire pour ajouter un nouveau jeu
        $title = '';
        $content = '';
        $image_url = '';
        $formTitle = "Ajouter un jeu"; // Titre du formulaire pour l'ajout
        $action = "/TFG/admin/admin_form_game.php"; // Action du formulaire pour l'ajout
    }
}

?>
