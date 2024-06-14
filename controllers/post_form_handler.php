<?php
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un post_id est présent dans $_GET
$id = isset($_GET['post_id']) ? $_GET['post_id'] : null;

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = isset($_POST['title']) ? $_POST['title'] : '';
    $contenu = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Vérifier si aucun URL d'image n'est spécifié, utiliser l'image par défaut
    if (empty($image_url)) {
        $image_url = 'assets/images/TFACTU.png'; // Chemin de l'image par défaut
    }

    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : '';

    // Si un post_id est présent, c'est une modification
    if ($id) {
        // Appeler la fonction pour mettre à jour le post dans la base de données
        updatePost($bdd, $id, $titre, $contenu, $image_url, $member_id);
    } else {
        // Sinon, c'est un ajout
        addPost($bdd, $titre, $contenu, $image_url, $member_id);
    }

    // Rediriger vers la page d'actualités après le traitement
    header('Location: /TFG/actualite.php');
    exit();
}

// Si un post_id est présent, récupérer les informations du post à modifier
if ($id) {
    // Récupérer les informations du post à modifier
    $post = getPostById($bdd, $id);
}
?>
