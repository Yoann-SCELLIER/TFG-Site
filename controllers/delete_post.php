<?php
// Inclusion du fichier des fonctions de gestion des posts
require_once dirname(__DIR__) . '/crud/post.fn.php'; // Assurez-vous que le chemin est correct

// Démarrer la session si ce n'est pas déjà fait
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['member_id'])) {
    header('Location: /TFG/log.php'); 
    exit();
}

// Vérifier si la méthode HTTP est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si post_id est défini dans $_POST
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        $member_id = $_SESSION['member_id'];
        $role_member = $_SESSION['role_member'];

        // Appel à la fonction pour supprimer le post
        if (deletePost($bdd, $post_id, $member_id, $role_member)) {
            // Vérifier le rôle pour la redirection
            if ($role_member === 'memberOfficial' || $role_member === 'memberGuest') {
                header('Location: /TFG/actualite.php');
            } else {
                header('Location: /TFG/admin/admin_view_list_actu.php');
            }
            exit();
        } else {
            // Échec de la suppression du post
            exit("Échec de la suppression du post.");
        }
    } else {
        // ID d'article manquant pour la suppression
        exit("ID d'article manquant pour la suppression.");
    }
} else {
    // Redirection si la méthode HTTP n'est pas POST
    header('Location: /TFG/actualite.php');
    exit();
}
?>
