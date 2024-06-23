<?php
// Inclusion du fichier contenant les fonctions CRUD pour les posts, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID de post est présent dans l'URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $title = filter_input(INPUT_POST, 'title');
    $content = filter_input(INPUT_POST, 'content');
    $image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

    // Vérifier si aucun URL d'image n'est spécifié, utiliser l'image par défaut
    if (empty($image_url)) {
        $image_url = 'assets/images/TFACTU.webp'; // Chemin de l'image par défaut
    }

    $member_id = filter_input(INPUT_POST, 'member_id', FILTER_SANITIZE_NUMBER_INT);

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