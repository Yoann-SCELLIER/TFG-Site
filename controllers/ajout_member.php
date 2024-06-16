<?php
// Inclure les fonctions de gestion des membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = htmlspecialchars($_POST['username']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $departement_id = $_POST['departement_id'];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        exit();
    }

    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si un fichier a été uploadé
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0 && $_FILES['cover']['size'] > 0) {
        // Récupérer les données du fichier
        $cover = $_FILES['cover'];

        // Définir le chemin du fichier de couverture
        $cover_path = 'uploads/' . basename($cover['name']);

        // Déplacer le fichier uploadé vers le répertoire spécifié
        if (!move_uploaded_file($cover['tmp_name'], $cover_path)) {
            echo "Erreur lors de l'upload du fichier. Veuillez réessayer.";
            exit();
        }
    } else {
        // Utiliser une image par défaut si aucun fichier n'est uploadé
        $cover_path = '/tfg/assets/images/Default_esports_player_silhouette_face_not_visible_light_in_th_2.jpg';
    }

    // Appel de la fonction d'inscription
    $result = ajouterMembre($bdd, $username, $first_name, $last_name, $email, $hashed_password, $departement_id, $cover_path);

    if ($result) {
        // Redirection vers la page de connexion après inscription réussie
        header('Location: \TFG\log.php?success=registration');
        exit();
    } else {
        // Gérer les erreurs si l'inscription a échoué
        echo "L'inscription a échoué. Veuillez réessayer.";
    }
}
?>
