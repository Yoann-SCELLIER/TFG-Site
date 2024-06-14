<?php
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Si un ID est présent, récupérer les informations du post à modifier
if ($id) {
    $post = getPostById($bdd, $id);
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = isset($_POST['title']) ? $_POST['title'] : '';
    $contenu = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';
    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : '';

    // Si un ID est présent, il s'agit d'une modification
    if ($id) {
        // Appeler la fonction pour mettre à jour le post dans la base de données
        updatePost($bdd, $id, $titre, $contenu, $image_url);
    } else {
        // Sinon, il s'agit d'un ajout
        addPost($bdd, $titre, $contenu, $image_url, $member_id);
    }

    // Rediriger vers la page d'actualités après le traitement
    header('Location: /TFG/admin/admin_view_list_actu.php');
    exit();
}
?>
