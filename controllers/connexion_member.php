<?php
// Inclusion des fichiers de configuration de la base de données et des fonctions de gestion des membres
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérification si les données du formulaire sont soumises via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de l'e-mail et du mot de passe soumis via le formulaire de connexion
    $email = $_POST['email'];
    $hashed_password = $_POST['password'];
    
    // Appel de la fonction de connexion pour vérifier les informations d'identification
    $member = connexion($bdd, $email, $hashed_password);
    
    // Si les informations d'identification sont valides, connecter le membre et le rediriger
    if ($member) {
        // Enregistrement de l'ID du membre dans la session
        $_SESSION['member_id'] = $member['member_id'];
        // Enregistrement du nom d'utilisateur dans la session
        $_SESSION['username'] = $member['username']; 
        
        // Redirection vers la page d'accueil après connexion réussie
        // header("Location: ../index.html.php");
        
        // Sortie du script après redirection
        exit();
    } else {
        // Affichage d'un message d'erreur si les informations d'identification sont incorrectes
        $erreur = "Email ou mot de passe incorrect."; 
    }
}

// Vérification si un message d'inscription est présent dans la session
if (isset($_SESSION['inscrit'])) {
    // Récupération et affichage du message d'inscription
    $message = $_SESSION['inscrit'];
    unset($_SESSION['inscrit']); // Suppression du message de la session après affichage
}
?>
