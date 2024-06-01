<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$post = null;

// Si un ID est présent, récupérer les informations du post pour modification
if ($id) {
    $post = getPostById($bdd, $id);
}

$formTitle = $id ? "Modifier l'actualitée'" : "Ajouter une actualitée";
$action = $id ? "\TFG\controllers\update_post.php?id=" . $id : "\TFG\controllers\ajout_actu.php";
$titre = $post ? $post['title'] : '';
$contenu = $post ? $post['content'] : '';
$image_url = $post ? $post['image_url'] : '';