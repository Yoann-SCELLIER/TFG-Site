<?php

// Inclusion du fichier contenant la fonction pour générer le bouton de carte d'actualité, situé dans le répertoire "function" du répertoire parent.
require_once dirname(__DIR__) . '/function/template_button_card_actu.php';

// Vérifier si la session n'est pas déjà démarrée, puis la démarrer si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté en vérifiant si 'member_id' est défini dans la session
if (isset($_SESSION['member_id'])) {
    // Récupérer l'ID du membre actuellement connecté depuis la session
    $current_member_id = $_SESSION['member_id'];

    // Vérifier si 'post_id' est passé en paramètre dans l'URL
    if (isset($_GET['post_id'])) {
        // Récupérer et sécuriser l'ID du post à partir des paramètres d'URL
        $post_id = $_GET['post_id'];

        // Appeler la fonction pour récupérer les détails du post depuis la base de données
        $post = getPostById($bdd, $post_id);

        // Vérifier si le post existe et si l'utilisateur connecté est l'auteur du post
        if ($post && $post['member_id'] == $current_member_id) {
            // Appeler la fonction pour générer le bouton de carte d'actualité spécifique au post
            buttonCardActu($post_id);
        }
    }
}

?>
