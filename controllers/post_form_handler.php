<?php
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$post = null;

// Si un ID est présent, récupérer les informations du post pour modification
if ($id) {
    $post = getPostById($bdd, $id);
}

// Déterminer le titre du formulaire en fonction de l'action (ajout ou modification)
$formTitle = $id ? "Modifier l'actualité" : "Ajouter une actualité";

// Déterminer l'action du formulaire en fonction de l'action (ajout ou modification)
$action = $id ? "\TFG\controllers\update_post.php?id=" . $id : "\TFG\controllers\ajout_actu.php";

// Récupérer les valeurs des champs du formulaire
$titre = $post ? $post['title'] : '';
$contenu = $post ? $post['content'] : '';
$image_url = $post ? $post['image_url'] : ''; 
?>