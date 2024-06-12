<?php

require_once dirname(__DIR__) . '/function/template_button_card_actu.php'; 

// Vérifier si la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['member_id'])) {
    $current_member_id = $_SESSION['member_id'];

    // Vérifier si l'ID du post est passé en paramètre
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];

        // Récupérer le post depuis la base de données
        $post = getPostById($bdd, $post_id);

        // Vérifier si le post existe et si l'utilisateur connecté est l'auteur du post
        if ($post && $post['member_id'] == $current_member_id) {
            buttonCardActu($post_id);
        }
    }
}
?>
