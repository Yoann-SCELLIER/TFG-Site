<?php
// Inclusion du fichier contenant les fonctions CRUD pour les posts, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID de post est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Vérifier si aucun URL d'image n'est spécifié, utiliser l'image par défaut
    if (empty($image_url)) {
        $image_url = 'assets/images/TFACTU.png'; // Chemin de l'image par défaut
    }

    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : '';

    // Si un ID est présent, il s'agit d'une modification
    if ($id) {
        // Appeler la fonction pour mettre à jour le post dans la base de données
        updatePost($bdd, $id, $title, $content, $image_url, $member_id);
    } else {
        // Sinon, il s'agit d'un ajout
        addPost($bdd, $title, $content, $image_url, $member_id);
    }

    // Rediriger vers la page d'actualités après le traitement
    header('Location: /TFG/admin/admin_view_list_actu.php');
    exit();
}

// Si un ID est présent, récupérer les informations du post à modifier
if ($id) {
    $post = getPostById($bdd, $id);
}
?>
