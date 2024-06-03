<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';
require_once dirname(__DIR__) . '/crud/post.fn.php'; // Modifier le chemin si nécessaire

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si un ID est passé via le formulaire POST
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        
        // Appelle la fonction pour supprimer le post avec l'ID spécifié
        deletePost($bdd, $id);

        // Redirige vers la page d'actualités après la suppression du post
        header('Location: /tfg/actualite.php');
        exit;
    } else {
        // Gérer le cas où l'ID est manquant
        exit("ID d'article manquant pour la suppression.");
    }
} else {
    // Rediriger si la requête n'est pas une requête POST
    header('Location: /tfg/actualite.php');
    exit;
}
?>
