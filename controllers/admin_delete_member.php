<?php

// Inclusion du fichier contenant les fonctions CRUD pour les membres, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérifie si l'ID du membre est spécifié dans les données postées (POST)
if (isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];
// Sinon, vérifie si l'ID du membre est spécifié dans les paramètres de requête (GET)
} elseif (isset($_GET['id'])) {
    $member_id = $_GET['id'];
// Si l'ID du membre n'est pas spécifié, termine le script avec un message d'erreur
} else {
    exit("ID du membre non spécifié.");
}

// Appel de la fonction deleteMember pour supprimer le membre de la base de données
// La fonction deleteMember prend deux arguments : la connexion à la base de données ($bdd) et l'ID du membre ($member_id)
deleteMember($bdd, $member_id);

// Redirige l'utilisateur vers le tableau de bord de l'administration après la suppression du membre
header('Location: /TFG/admin/dashboard.php');
exit;
?>
