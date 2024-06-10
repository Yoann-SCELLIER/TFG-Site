<?php
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si un ID est présent dans l'URL
$game_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];

    // Définir l'URL de l'image par défaut
    $default_cover_path = '/TFG/assets/images/Default_video_game_cover_logo_0.jpg';

    // Utiliser l'image par défaut si aucun lien n'est ajouté
    $cover = !empty($image_url) ? $image_url : $default_cover_path;

    if ($game_id) {
        // Modifier le jeu existant
        updateGame($bdd, $game_id, $title, $content, $cover);
        header('Location: /TFG/admin/admin_view_list_game.php');
        exit;
    } else {
        // Ajouter un nouveau jeu
        addGame($bdd, $title, $content, $cover);
        header('Location: /TFG/admin/admin_view_list_game.php');
        exit;
    }
} else {
    if ($game_id) {
        // Charger les données du jeu existant pour modification
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
        $formTitle = "Modifier le jeu";
        $action = "/TFG/admin/admin_form_game.php?id=$game_id";
    } else {
        // Initialiser le formulaire pour ajouter un nouveau jeu
        $title = '';
        $content = '';
        $image_url = '';
        $formTitle = "Ajouter un jeu";
        $action = "/TFG/admin/admin_form_game.php";
    }
}

// Inclure la vue pour le formulaire
require_once dirname(__DIR__) . '/views/admin_formu_game.html.php';
?>
