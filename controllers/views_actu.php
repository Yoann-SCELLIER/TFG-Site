<?php

require_once dirname(__DIR__) . '\crud\post.fn.php'; // Modifier le chemin si nécessaire

// Initialiser les variables avec des valeurs par défaut pour l'ajout d'un post
$titre = '';
$contenu = '';
$image_url = '';
$modif_at = '';
$action = 'ajout_actu.php'; 
$formTitle = 'Ajouter un Post';
$submitValue = 'Ajouter le Post'; 

// Vérifie si un ID est passé via les paramètres GET pour la modification
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Récupère tous les posts
    $posts = viewsPost($bdd);

    // Recherche le post correspondant à l'ID spécifié
    foreach ($posts as $post) {
        if ($post['post_id'] == $id) {
            // Met à jour les variables avec les informations du post à modifier
            $titre = $post['title'];
            $contenu = $post['content'];
            $image_url = $post['image_url'];
            $modif_at = $post['modif_at'];
            $action = "modification_actu.php?id=$id";
            $formTitle = 'Modifier un Post';
            $submitValue = 'Modifier le Post';
            break;
        }
    }
}
