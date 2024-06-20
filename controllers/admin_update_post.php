<?php
// Inclusion du fichier contenant les fonctions CRUD pour les posts, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Si aucune ID n'est fournie, rediriger vers la page d'accueil
if (!$id) {
    header('Location: /TFG/admin/dashboard.php');
    exit();
}

// Si le formulaire est soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['title'];
    $contenu = $_POST['content'];
    $image_url = $_POST['image_url'];

    // Mettre à jour le post dans la base de données
    updatePost($bdd, $id, $title, $content, $image_url, $member_id);

    // Rediriger vers la page d'actualité après la mise à jour
    header('Location: /TFG/admin/dashboard.php');
    exit();
} else {
    // Si le formulaire n'est pas soumis en méthode POST, rediriger vers la page d'accueil
    header('Location: /TFG/admin/dashboard.php');
    exit();
}
?>
