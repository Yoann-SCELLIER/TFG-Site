<?php

require_once dirname(__DIR__) . '/function/template_button_card_member.php';

// Vérifier si la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et a un ID de membre
if (isset($_SESSION['member_id']) && isset($_GET['id']) && $_SESSION['member_id'] == $_GET['id']) {
    echo buttonMemberCard($_SESSION['member_id']);
} else {
    // Optionnel : afficher un message ou rediriger l'utilisateur si ce n'est pas sa propre page de profil
    // echo "Vous ne pouvez pas modifier ce profil.";
}
?> 
