<?php
// Inclusion du fichier contenant les fonctions CRUD pour les posts
require_once dirname(__DIR__) . '/crud/post.fn.php';

// Démarrage de la session si ce n'est pas déjà fait
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['member_id'])) {
    header('Location: /TFG/log.php'); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérification si la méthode HTTP est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification si post_id est défini dans $_POST
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $member_id = $_SESSION['member_id'];
        $role_member = $_SESSION['role_member'];

        // Appel à la fonction pour supprimer le post
        if (deletePost($bdd, $post_id, $member_id, $role_member)) {
            // Vérification du rôle pour la redirection appropriée
            if ($role_member === 'memberOfficial' || $role_member === 'memberGuest') {
                header('Location: /TFG/actualite.php'); // Redirection vers la page d'actualités pour les membres officiels et invités
            } else {
                header('Location: /TFG/admin/admin_view_list_actu.php'); // Redirection vers la liste des posts pour les administrateurs
            }
            exit();
        } else {
            exit("Échec de la suppression du post."); // Message d'erreur si la suppression du post échoue
        }
    } else {
        exit("ID d'article manquant pour la suppression."); // Message d'erreur si l'ID du post n'est pas spécifié
    }
} else {
    // Redirection si la méthode HTTP n'est pas POST
    header('Location: /TFG/actualite.php');
    exit();
}
?>
