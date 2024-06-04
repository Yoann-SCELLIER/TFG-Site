<?php
require_once dirname(__DIR__) . '/controller/db.fn.php';
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
    updateMember($bdd, $member_id, $cover, $username, $email, $jobs, $content);

    // Redirige vers la page de détails du membre après la mise à jour
    header('Location: /TFG/index.php');
    exit;
}

// Inclure le fichier de vue du formulaire de modification
require_once dirname(__DIR__) . '/components/header.html.php';
require_once dirname(__DIR__) . '/views/member_form.html.php';
require_once dirname(__DIR__) . '/components/footer.html.php';
?>
