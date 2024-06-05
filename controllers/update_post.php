<?php
require_once dirname(__DIR__) . '\crud\post.fn.php';

// Vérifie si un ID est présent dans l'URL et si les données sont soumises via la méthode POST
if (isset($_GET['id']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère l'ID du post à mettre à jour
    $id = $_GET['id'];
    // Récupère les données soumises par le formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $image_url = $_POST['image_url'];

    // Appelle la fonction pour mettre à jour le post dans la base de données
    updatePost($bdd, $id, $titre, $contenu, $image_url);

    // Redirige vers la page d'actualités après la mise à jour du post
    header('Location: /TFG/actualite.php');
    exit;
}
?>
