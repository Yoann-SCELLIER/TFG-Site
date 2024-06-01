<?php
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $departement_id = $_POST['departement_id'];

    // Vérifier si un fichier a été uploadé
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $cover_path = 'uploads/' . basename($_FILES['cover']['name']);
        move_uploaded_file($_FILES['cover']['tmp_name'], $cover_path);
    } else {
        // Utiliser une image par défaut si aucun fichier n'est uploadé
        $cover_path = '/tfg/assets/images/Default_esports_player_silhouette_face_not_visible_light_in_th_2.jpg';
    }

    // Appel de la fonction d'inscription
    $result = ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id, $cover_path);

    if ($result) {
        // Redirection vers la page d'accueil après inscription réussie
        header('Location: ../index.php');
        exit();
    } else {
        // Gérer les erreurs si l'inscription a échoué
        echo "L'inscription a échoué. Veuillez réessayer.";
    }
}
?>