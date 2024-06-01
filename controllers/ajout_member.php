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

    // Appel de la fonction d'inscription
    $result = ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id);

    if ($result) {
        // Redirection vers la page d'accueil après inscription réussie
        header('Location: ../index.html.php');
        exit();
    } else {
        // Gérer les erreurs si l'inscription a échoué
        echo "L'inscription a échoué. Veuillez réessayer.";
    }
}
?>
