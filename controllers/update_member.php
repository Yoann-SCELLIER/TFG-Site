<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Récupération de l'ID du membre depuis l'URL
$member_id = $_GET['id'] ?? null;

// Vérification si l'ID est valide
if ($member_id === null) {
    // Gérer le cas où l'ID n'est pas spécifié dans l'URL
    // Par exemple, rediriger vers une page d'erreur ou afficher un message d'erreur
    exit("ID du membre non spécifié.");
}

// Récupération du membre à partir de l'ID
$member = getMemberById($bdd, $member_id);

// Vérification si le membre existe
if ($member === null) {
    // Gérer le cas où le membre n'est pas trouvé
    // Par exemple, rediriger vers une page d'erreur ou afficher un message d'erreur
    exit("Membre non trouvé.");
}

// Vérifie si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données soumises par le formulaire
    $cover = $_POST['cover'] ?? $member['cover'] ?? '';
    $username = $_POST['username'] ?? $member['username'] ?? '';
    $email = $_POST['email'] ?? $member['email'] ?? '';
    $job = $_POST['job'] ?? $member['job'] ?? array(); // Assurez-vous que $job est un tableau
    $content = $_POST['content'] ?? $member['content'] ?? '';

    // Appelle la fonction pour mettre à jour le membre dans la base de données
    update_member($bdd, $member_id, $cover, $username, $email, $job, $content);

    // Redirige vers la page de détails du membre après la mise à jour
    header('Location: \TFG\index.php');
    exit;
}

// Inclure le fichier de vue du formulaire de modification
