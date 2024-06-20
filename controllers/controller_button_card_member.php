<?php

// Inclusion du fichier contenant la fonction pour générer le bouton de carte de membre, situé dans le répertoire "function" du répertoire parent.
require_once dirname(__DIR__) . '/function/template_button_card_member.php';

// Vérifier si la session n'est pas déjà démarrée, puis la démarrer si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si 'member_id' est défini dans la session et si 'id' est passé en paramètre dans l'URL
if (isset($_SESSION['member_id']) && isset($_GET['id']) && $_SESSION['member_id'] == $_GET['id']) {
    // Afficher le bouton de carte de membre en appelant la fonction avec 'member_id' de la session
    echo buttonMemberCard($_SESSION['member_id']);
} else {
    // Optionnel : afficher un message ou rediriger l'utilisateur si ce n'est pas sa propre page de profil
    // echo "Vous ne pouvez pas modifier ce profil.";
}

?>
