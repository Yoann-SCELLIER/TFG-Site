<?php

require_once dirname(__DIR__) . '/function/template_button_actu.php';

// Vérifier si la session est démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si la clé 'role_member' est définie dans la session
if (isset($_SESSION['role_member'])) {
    if ($_SESSION['role_member'] == 'memberGuest' || $_SESSION['role_member'] == 'memberOfficial') {
        echo buttonMemberActu();
    }
}
