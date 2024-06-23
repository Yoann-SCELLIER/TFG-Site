<?php

// Démarrer la session PHP
session_start();

// Vérifier si l'utilisateur est connecté et a les droits nécessaires
if (!isset($_SESSION['member_id']) || $_SESSION['role_member'] !== 'memberAdmin') {
    // Redirection vers la page de connexion si l'utilisateur n'est pas administrateur
    header('Location: /TFG/log.php');
    exit;
}

// Inclusion du fichier contenant les fonctions CRUD pour les jeux
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Vérifier si un ID de jeu est présent dans les données postées
$game_id = isset($_POST['id']) ? (int)$_POST['id'] : null;

// Vérifier si l'ID du jeu est valide
if ($game_id) {
    // Appeler la fonction pour supprimer le jeu
    deleteGame($bdd, $game_id);
    
    // Redirection vers la page d'affichage des jeux après la suppression
    header('Location: /TFG/admin/admin_view_list_game.php');
    exit; // Terminer l'exécution du script après la redirection
} else {
    // Si l'ID du jeu n'est pas valide, afficher un message d'erreur
    echo "ID de jeu invalide.";
}

?>
