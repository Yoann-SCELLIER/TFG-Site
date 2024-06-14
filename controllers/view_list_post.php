<?php
// Inclure la fonction pour récupérer les publications
require_once dirname(__DIR__) . '/crud/post.fn.php';
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Appel de la fonction pour récupérer la liste des publications
$posts = viewsPost($bdd);

// Récupérer les noms d'utilisateur des auteurs des publications et gérer l'image par défaut
foreach ($posts as &$post) {
    $member_id = $post['member_id'];
    $member = getMemberById($bdd, $member_id);
    $post['username'] = $member['username'];

    // Vérifier si image_url est vide ou nulle
    if (empty($post['image_url'])) {
        // Définir l'image par défaut
        $post['image_url'] = '/TFG/assets/images/TFACTU.png';
    } else {
        // Assurez-vous que le chemin de l'image est correctement formaté
        $post['image_url'] = '/TFG/' . ltrim($post['image_url'], '/');
    }
}

// Pour déboguer, vous pouvez var_dump($posts); ici pour vérifier que chaque élément $post contient bien 'image_url'

// Inclure la vue pour afficher le tableau des publications
?>
