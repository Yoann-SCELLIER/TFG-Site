<?php
// Inclusion du fichier contenant les fonctions CRUD pour les posts
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si l'ID du post est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les détails de l'article avec l'ID spécifié
    $post = getPostById($bdd, $id);

    // Vérifier si l'article existe
    if ($post) {
        // Inclure la vue de détail du post avec les détails récupérés
        include dirname(__DIR__) . '/views/admin_read_post.html.php';
    } else {
        // Rediriger vers une page d'erreur ou afficher un message d'erreur
        echo "L'article demandé n'existe pas.";
        // Vous pouvez également rediriger vers une autre page :
        // header('Location: /TFG/error_page.php');
    }
} else {
    // Rediriger vers une page d'erreur ou afficher un message d'erreur si l'ID n'est pas passé
    echo "Aucun ID d'article spécifié.";
    // Vous pouvez également rediriger vers une autre page :
    // header('Location: /TFG/error_page.php');
}
?>
