<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '/bdd/db.fn.php';
// Inclure le fichier contenant les fonctions de gestion des membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire avec filtrage
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $departement_id = filter_input(INPUT_POST, 'departement_id', FILTER_VALIDATE_INT);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $cover = $_POST['cover'];

    // Vérifier que les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "<script>alert('Les mots de passe ne correspondent pas.'); window.history.back();</script>";
        exit(); 
    }

    // Vérifier la complexité du mot de passe et la validité de l'e-mail
    if (!validateInputs($email, $password)) {
        echo "<script>alert('Le mot de passe doit contenir au moins une majuscule, un chiffre, un caractère spécial, et l\'adresse e-mail doit contenir un @ et se terminer par .fr ou .com.'); window.history.back();</script>";
        exit();
    }

    // Vérifier si le nom d'utilisateur est déjà pris
    if (isUsernameTaken($bdd, $username)) {
        echo "<script>alert('Ce nom d\'utilisateur est déjà pris.'); window.history.back();</script>";
        exit();
    }

    // Vérifier si l'adresse e-mail est déjà prise
    if (isEmailTaken($bdd, $email)) {
        echo "<script>alert('Cette adresse e-mail est déjà utilisée.'); window.history.back();</script>";
        exit();
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ID du rôle 'memberGuest'
    $role_id = 2;

    // Appel de la fonction pour ajouter un membre avec le mot de passe hashé et le rôle par défaut
    $result = addMember($bdd, $username, $first_name, $last_name, $email, $hashed_password, $departement_id, $cover, $role_id);

    if ($result) {
        // Redirection vers la page de connexion après inscription réussie
        echo "<script>alert('Inscription réussie. Pensez à aller sur votre profil pour ajouter plus d\'infos!');</script>";
        header('Location: /TFG/index.php');
        exit();
    } else {
        // Gérer les erreurs si l'inscription a échoué
        echo "<script>alert('L\'inscription a échoué. Veuillez réessayer.'); window.history.back();</script>";
        exit();
    }
} else {
    // Si la méthode HTTP n'est pas POST, rediriger vers la page de formulaire d'inscription
    header('Location: /TFG/log.php');
    exit();
}
?>