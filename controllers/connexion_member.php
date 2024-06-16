<?php

require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de l'e-mail et du mot de passe soumis via le formulaire de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation de l'e-mail avec regex
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (!preg_match($email_regex, $email)) {
        // Email invalide, rediriger avec un message d'erreur
        header("Location: /TFG/log.php");
        exit();
    }

    // Appel de la fonction de connexion pour vérifier les informations d'identification
    $member = connexion($bdd, $email, $password);

    // Si les informations d'identification sont valides, connecter le membre et le rediriger
    if ($member) {
        // Enregistrement des données du membre dans la session
        session_start();
        $_SESSION['member_id'] = $member['member_id'];
        $_SESSION['role_member'] = $member['role_member'];
        $_SESSION['username'] = $member['username'];

        // Redirection en fonction du rôle de l'utilisateur
        if ($_SESSION['role_member'] === 'memberOfficial' || $_SESSION['role_member'] === 'memberGuest') {
            header("Location: /TFG/index.php");
            exit();
        } elseif ($_SESSION['role_member'] === 'memberAdmin') {
            header("Location: /tfg/admin/dashboard.php");
            exit();
        }
    } else {
        // Affichage d'un message d'erreur si les informations d'identification sont incorrectes
        header("Location: /TFG/log.php");
        exit();
    }
}
