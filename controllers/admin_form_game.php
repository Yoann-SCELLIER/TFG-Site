<?php
// Inclusion du fichier contenant les fonctions CRUD pour les jeux et consoles, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si $member_id est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
} else {
    // Gérer le cas où $member_id n'est pas défini
    // Vous pouvez rediriger l'utilisateur vers une page de connexion ou afficher un message d'erreur
    header('Location: /TFG/404.php');
    exit;
}

// Vérifier si un ID de jeu est présent dans l'URL
$game_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

// Si la requête est de type POST, cela signifie que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider et nettoyer les données du formulaire.
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $content = isset($_POST['content']) ? nl2br(htmlspecialchars($_POST['content'])) : '';
    $image_url = isset($_POST['image_url']) ? trim($_POST['image_url']) : '';

    // Définir l'URL de l'image par défaut
    $default_cover_path = '/TFG/assets/images/Default_video_game_cover_logo_0.webp';

    // Utiliser l'image par défaut si aucun lien n'est fourni
    $cover = !empty($image_url) ? $image_url : $default_cover_path;

    if ($game_id) {
        // Si un ID de jeu est présent, modifier le jeu existant de manière sécurisée
        if (updateGame($bdd, $game_id, $title, $content, $cover)) {
            // Rediriger l'utilisateur vers la liste des jeux après la modification
            echo "<script>alert('Modification réussie.');</script>";
            header('Location: /TFG/admin/admin_view_list_game.php');
            exit;
        } else {
            echo "<script>alert('Erreur lors de la modification du jeu.');</script>";
        }
    } else {
        // Sinon, ajouter un nouveau jeu de manière sécurisée
        if (addGame($bdd, $title, $content, $cover)) {
            // Rediriger l'utilisateur vers la liste des jeux après l'ajout
            echo "<script>alert('Ajout réussi.');</script>";
            header('Location: /TFG/admin/admin_view_list_game.php');
            exit;
        } else {
            echo "<script>alert('Erreur lors de l\'ajout du jeu.');</script>";
        }
    }
} else {
    if ($game_id) {
        // Si un ID de jeu est présent, charger les données du jeu pour modification
        $game = getGameById($bdd, $game_id);
        if ($game) {
            $title = htmlspecialchars_decode($game['title']); // Décoder les entités HTML spéciales
            $content = isset($game['content']) ? htmlspecialchars_decode(nl2br($game['content'])) : '';
            $image_url = isset($game['cover']) ? htmlspecialchars($game['cover']) : '';
        } else {
            // Gestion d'erreur si le jeu n'existe pas
            echo "<script>alert('Aucun jeu trouvé...');</script>";
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
