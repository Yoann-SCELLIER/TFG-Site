<?php
// Inclusion du fichier contenant les fonctions CRUD pour les publications et les membres
require_once dirname(__DIR__) . '/crud/post.fn.php';
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Appel de la fonction pour récupérer la liste des publications depuis la base de données
$posts = viewsPost($bdd);