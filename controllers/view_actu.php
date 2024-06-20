<?php

require_once dirname(__DIR__) . '/crud/post.fn.php'; // Inclut le fichier des fonctions CRUD pour les posts

// Variables initiales pour l'ajout d'un post
$titre = '';
$contenu = '';
$image_url = '';
$modif_at = '';
$action = 'ajout_actu.php'; // Action du formulaire par défaut pour l'ajout
$formTitle = 'Ajouter un Post'; // Titre du formulaire par défaut
$submitValue = 'Ajouter le Post'; // Valeur du bouton de soumission par défaut

// Vérifie si un ID est passé via les paramètres GET pour la modification
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupère tous les posts depuis la base de données
    $posts = viewsPost($bdd);

    // Recherche le post correspondant à l'ID spécifié
    foreach ($posts as $post) {
        if ($post['post_id'] == $id) {
            // Met à jour les variables avec les informations du post à modifier
            $titre = $post['title'];
            $contenu = $post['content'];
            $image_url = $post['image_url'];
            $modif_at = $post['modif_at'];
            $action = "modification_actu.php?id=$id"; // Action du formulaire pour la modification avec l'ID
            $formTitle = 'Modifier un Post'; // Titre du formulaire pour la modification
            $submitValue = 'Modifier le Post'; // Valeur du bouton de soumission pour la modification
            break; // Sort de la boucle une fois que le post est trouvé
        }
    }
}

// Le reste du code pour afficher le formulaire HTML ou effectuer d'autres traitements devrait suivre ici
?>
