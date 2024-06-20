<?php
// Inclusion du fichier contenant les fonctions CRUD pour les jeux et consoles, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si un ID de jeu est présent dans l'URL
$game_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Si la requête est de type POST, cela signifie que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title']; // Titre du jeu
    $content = $_POST['content']; // Description ou contenu du jeu
    $image_url = $_POST['image_url']; // URL de l'image du jeu

    // Définir l'URL de l'image par défaut
    $default_cover_path = '/TFG/assets/images/Default_video_game_cover_logo_0.jpg';

    // Utiliser l'image par défaut si aucun lien n'est fourni
    $cover = !empty($image_url) ? $image_url : $default_cover_path;

    if ($game_id) {
        // Si un ID de jeu est présent, modifier le jeu existant
        updateGame($bdd, $game_id, $title, $content, $cover);
        // Rediriger l'utilisateur vers la liste des jeux après la modification
        header('Location: /TFG/admin/admin_view_list_game.php');
        exit;
    } else {
        // Sinon, ajouter un nouveau jeu
        addGame($bdd, $title, $content, $cover);
        // Rediriger l'utilisateur vers la liste des jeux après l'ajout
        header('Location: /TFG/admin/admin_view_list_game.php');
        exit;
    }
} else {
    if ($game_id) {
        // Si un ID de jeu est présent, charger les données du jeu pour modification
        $game = getGameById($bdd, $game_id);
        if ($game) {
            $title = $game['title'];
            $content = isset($game['content']) ? $game['content'] : '';
            $image_url = isset($game['image_url']) ? $game['image_url'] : '';
        } else {
            // Gestion d'erreur si le jeu n'existe pas
            echo "Jeu non trouvé";
            exit;
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

// Inclure la vue pour le formulaire
require_once dirname(__DIR__) . '/views/admin_formu_game.html.php';
?>
