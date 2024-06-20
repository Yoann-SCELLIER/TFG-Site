<?php

// Inclusion du fichier contenant la fonction pour générer le bouton d'actualité, situé dans le répertoire "function" du répertoire parent.
require_once dirname(__DIR__) . '/function/template_button_actu.php';

// Vérifier si la session n'est pas déjà démarrée, puis la démarrer si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si la clé 'role_member' est définie dans la session
if (isset($_SESSION['role_member'])) {
    // Vérifier si le rôle du membre est 'memberGuest' ou 'memberOfficial'
    if ($_SESSION['role_member'] == 'memberGuest' || $_SESSION['role_member'] == 'memberOfficial') {
        // Appel de la fonction pour générer le bouton d'actualité spécifique aux membres invités et officiels
        echo buttonMemberActu();
    }
}

?>
