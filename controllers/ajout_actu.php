<?php

require_once dirname(__DIR__) . '/controller/db.fn.php';
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifie si la méthode de requête est POST (lors de la soumission du formulaire)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données soumises par le formulaire
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $image_url = $_POST['image_url'];

    // Appelle la fonction pour ajouter un post dans la base de données
    addPost($bdd, $titre, $contenu, $image_url);

    // Redirige vers la page d'actualités après l'ajout du post
    header('Location: \TFG\actualite.php');
    exit;
}