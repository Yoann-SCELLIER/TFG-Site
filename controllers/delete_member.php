<?php

// Inclusion du fichier contenant les fonctions CRUD pour les membres
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérifie si l'ID du membre est spécifié dans les données postées ou les paramètres de requête
if (isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];
} elseif (isset($_GET['id'])) {
    $member_id = $_GET['id'];
} else {
    exit("ID du membre non spécifié.");
}

// Appeler la fonction pour supprimer le membre de la base de données
deleteMember($bdd, $member_id);

// Redirection vers une page appropriée après la suppression du membre
header('Location: /TFG/index.php');
exit;
?>
