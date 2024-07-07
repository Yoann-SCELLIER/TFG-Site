<?php
// Inclusion du fichier contenant les fonctions CRUD pour les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérification si le formulaire est soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire avec filtrage
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Le mot de passe n'est pas filtré car il sera vérifié avec password_verify()

    // Appel de la fonction connexion pour vérifier les informations d'identification
    $member = connexion($bdd, $email, $password);

    if ($member) {
        // Démarrage de la session et enregistrement des informations de membre
        session_start();
        $_SESSION['member_id'] = $member['member_id'];
        $_SESSION['role_member'] = $member['role_member'];
        $_SESSION['username'] = $member['username'];

        // Redirection en fonction du rôle du membre
        if ($_SESSION['role_member'] === 'memberAdmin') {
            header("Location: /TFG/admin/dashboard.php");
            exit();
        } elseif ($_SESSION['role_member'] === 'memberOfficial' || $_SESSION['role_member'] === 'memberGuest') {
            header("Location: /TFG/index.php");
            exit();
        } else {
            // Déconnexion et redirection si le rôle n'est pas reconnu
            session_unset();
            session_destroy();
            header("Location: /TFG/log.php"); 
            exit();
        }
    } else {
        // Message d'erreur
        echo "<script>alert('Email ou mot de passe incorrecte...'); window.history.back();</script>";
        exit();
    }
} else {
    // Redirection si la méthode HTTP n'est pas POST
    header("Location: /TFG/log.php");
    exit();
}
?>
