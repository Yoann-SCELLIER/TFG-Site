<?php
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$post = null;

if ($id) {
    // Récupérer les informations du post à modifier
    $post = getPostById($bdd, $id);
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Si un ID est présent, il s'agit d'une modification
    if ($post_id) {
        // Appeler la fonction pour mettre à jour le post dans la base de données
        updatePost($bdd, $post_id, $title, $content, $image_url, $member_id);
    } else {
        // Sinon, il s'agit d'un ajout
        // Appeler la fonction pour ajouter un nouveau post dans la base de données
        addPost($bdd, $title, $content, $image_url, $member_id);
    }

    // Rediriger vers la page d'actualités après le traitement
    header('Location: /TFG/admin/admin_view_list_actu.php');
    exit();
}
?>
