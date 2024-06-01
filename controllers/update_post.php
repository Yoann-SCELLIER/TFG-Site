<?php

require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\post.fn.php';

// Vérifie si la méthode de requête est POST et si un ID est passé via les paramètres GET
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Récupère les données soumises par le formulaire
    $id = $_GET['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $image_url = $_POST['image_url'];

    // Appelle la fonction pour mettre à jour le post dans la base de données
    updatePost($bdd, $id, $titre, $contenu, $image_url);

    // Redirige vers la page d'actualités après la mise à jour du post
    header('Location: /tfg/actualite.html.php');
    exit;
}
