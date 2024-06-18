<?php

require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation de l'e-mail avec une regex simple
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (!preg_match($email_regex, $email)) {
        header("Location: /TFG/log.php");
        exit();
    }

    // Connexion avec les informations soumises
    $member = connexion($bdd, $email, $password);

    // Si la connexion réussit
    if ($member) {
        session_start();
        $_SESSION['member_id'] = $member['member_id'];
        $_SESSION['role_member'] = $member['role_member'];
        $_SESSION['username'] = $member['username'];

        // Redirection en fonction du rôle
        if ($_SESSION['role_member'] === 'memberAdmin') {
            check_role('memberAdmin'); // Vérifie si l'utilisateur a le rôle d'administrateur
            header("Location: /TFG/admin/dashboard.php");
            exit();
        } elseif ($_SESSION['role_member'] === 'memberOfficial' || $_SESSION['role_member'] === 'memberGuest') {
            check_multiple_roles(['memberOfficial', 'memberGuest']); // Vérifie si l'utilisateur a l'un des rôles autorisés
            header("Location: /TFG/index.php");
            exit();
        } else {
            // Déconnexion et redirection en cas de rôle non reconnu
            session_unset();
            session_destroy();
            header("Location: /TFG/log.php");
            exit();
        }
    } else {
        // Redirection si la connexion échoue
        header("Location: /TFG/log.php");
        exit();
    }
}
?>
