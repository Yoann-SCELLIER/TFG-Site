<?php

require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\post.fn.php'; // Modifier le chemin si nécessaire

// Vérifie si un ID est passé via les paramètres GET
if (isset($_GET['id'])) {
    // Appelle la fonction pour supprimer le post avec l'ID spécifié
    deletePost($bdd);
}

// Redirige vers la page d'actualités après la suppression du post
header('Location: /tfg/actualite.php');
exit;
