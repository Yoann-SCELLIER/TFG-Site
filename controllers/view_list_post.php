<?php
require_once dirname(__DIR__) . '/crud/post.fn.php';
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Appel de la fonction pour récupérer la liste des publications
$posts = viewsPost($bdd);
