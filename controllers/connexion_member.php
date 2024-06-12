<?php

require_once dirname(__DIR__) . '\crud\member.fn.php';

// Démarrage de la session
session_start();

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de l'e-mail et du mot de passe soumis via le formulaire de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Appel de la fonction de connexion pour vérifier les informations d'identification
    $member = connexion($bdd, $email, $password);

    // Si les informations d'identification sont valides, connecter le membre et le rediriger
    if ($member) {
        // Enregistrement de l'ID du membre dans la session
        $_SESSION['member_id'] = $member['member_id'];
        $_SESSION['role_member'] = $member['role_member'];
        $_SESSION['username'] = $member['username'];

        // Debugging: Afficher la valeur de $_SESSION['role_member']
        var_dump($_SESSION['role_member']);
        
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
        $erreur = "Email ou mot de passe incorrect.";
        header("Location: /TFG/log.php");
        echo 'Erreur';
    }
}

// Vérification si un message d'inscription est présent dans la session
if (isset($_SESSION['inscrit'])) {
    // Récupération et affichage du message d'inscription
    $message = $_SESSION['inscrit'];
    unset($_SESSION['inscrit']); // Suppression du message de la session après affichage
}
?>
