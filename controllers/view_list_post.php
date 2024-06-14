<?php
// Inclure la fonction pour récupérer les publications
require_once dirname(__DIR__) . '/crud/post.fn.php';
require_once dirname(__DIR__) . '/crud/member.fn.php'; // Inclure le fichier des fonctions des membres

// Appel de la fonction pour récupérer la liste des publications
$posts = viewsPost($bdd);

// Récupérer les noms d'utilisateur des auteurs des publications
foreach ($posts as &$post) {
    $member_id = $post['member_id'];
    $member = getMemberById($bdd, $member_id);
    $post['username'] = $member['username'];
}

?>
