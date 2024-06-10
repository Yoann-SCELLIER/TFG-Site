<?php
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Récupération de l'ID du membre depuis l'URL 
$member_id = $_GET['id'] ?? null;

// Vérification si l'ID est valide
if ($member_id === null) {
    exit("ID du membre non spécifié.");
}

// Récupération du membre à partir de l'ID
$member = getMemberById($bdd, $member_id);

// Vérification si le membre existe
if ($member === null) {
    exit("Membre non trouvé.");
}

// Vérifie si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données soumises par le formulaire
    $cover = $_POST['cover'] ?? $member['cover'] ?? '';
    $username = $_POST['username'] ?? $member['username'] ?? '';
    $email = $_POST['email'] ?? $member['email'] ?? '';
    $jobs = $_POST['jobs'] ?? array(); // Assurez-vous que $jobs est un tableau
    $content = $_POST['content'] ?? $member['content'] ?? '';

    // Appelle la fonction pour mettre à jour le membre dans la base de données
    try {
        updateMember($bdd, $member_id, $cover, $username, $email, $jobs, $content);
        // Redirection après mise à jour réussie
        header('Location: /TFG/admin/dashboard.php');
        exit();
    } catch (Exception $e) {
        // Gestion des erreurs (affichage du message d'erreur)
        echo "Erreur lors de la mise à jour du membre : " . $e->getMessage();
    }
}