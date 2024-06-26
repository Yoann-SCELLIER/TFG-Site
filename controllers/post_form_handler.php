<?php
// Inclure le fichier des fonctions CRUD pour les posts
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un post_id est présent dans $_GET
$id = isset($_GET['post_id']) ? $_GET['post_id'] : null;

// Démarrer la session si ce n'est pas déjà fait
if (!isset($_SESSION)) {
    session_start();
}

// Vérifier si $member_id est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
} else {
    // Gérer le cas où $member_id n'est pas défini 
    exit("Erreur : utilisateur non authentifié");
}

// Si le formulaire est soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire et les valider
    $title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : '';
    $content = isset($_POST['content']) ? htmlspecialchars(trim($_POST['content'])) : '';
    $image_url = isset($_POST['image_url']) ? filter_var($_POST['image_url'], FILTER_VALIDATE_URL) : '';

    // Utiliser l'image par défaut si aucune URL n'est spécifiée
    if (empty($image_url)) {
        $image_url = 'assets/images/TFACTU.webp';
    }

    // Si un post_id est présent, c'est une modification
    if ($id) {
        updatePost($bdd, $id, $title, $content, $image_url, $member_id);
    } else {
        // Sinon, c'est un ajout
        addPost($bdd, $title, $content, $image_url, $member_id);
    }

    // Rediriger vers la page d'actualités après le traitement
    header('Location: /TFG/actualite.php');
    exit();
}

// Si un post_id est présent, récupérer les informations du post à modifier
if ($id) {
    $post = getPostById($bdd, $id);
    // Vous pouvez utiliser $post pour pré-remplir le formulaire de modification
}