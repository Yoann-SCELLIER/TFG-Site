<?php

require_once dirname(__DIR__) . '/function/template_button_card_actu.php';

// Vérifier si la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et a un ID de membre
if (isset($_SESSION['member_id']) && isset($_GET['id']) && $_SESSION['member_id'] == $_GET['id']) {
    // Afficher les boutons seulement si l'utilisateur est l'auteur du post
    echo buttonCardActu($_SESSION['member_id']);
} else {
    // Cacher les boutons si l'utilisateur n'est pas l'auteur du post
    // Vous pouvez ajouter ici un message ou une redirection si nécessaire
}
?>
