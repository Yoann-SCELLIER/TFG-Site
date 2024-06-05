<?php

// Inclure la fonction pour récupérer les publications
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Appel de la fonction pour récupérer la liste des publications
$posts = viewsPost($bdd);

// Inclure la vue pour afficher la liste des publications
require_once dirname(__DIR__) . '/actualite.php';
?>
