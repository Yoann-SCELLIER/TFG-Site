<?php
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $departement_id = $_POST['departement_id'];
    $cover = $_POST['cover'];

    // Vérifier que les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

    // Vérifier si le nom d'utilisateur est déjà pris
    if (isUsernameTaken($bdd, $username)) {
        echo "Ce nom d'utilisateur est déjà pris.";
        exit();
    }

    // Vérifier si l'adresse e-mail est déjà prise
    if (isEmailTaken($bdd, $email)) {
        echo "Cette adresse e-mail est déjà utilisée.";
        exit();
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Appel de la fonction d'inscription avec le mot de passe hashé
    $result = ajouterMembre($bdd, $username, $first_name, $last_name, $email, $hashed_password, $departement_id, $cover);

    if ($result) {
        // Redirection vers la page de connexion après inscription réussie
        header('Location: /TFG/log.php');
        exit();
    } else {
        // Gérer les erreurs si l'inscription a échoué
        echo "L'inscription a échoué. Veuillez réessayer.";
    }
} else {
    // Si la méthode HTTP n'est pas POST, rediriger vers la page de formulaire
    header('Location: /TFG/inscription.php');
    exit();
}
?>
