<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php';

// Vérifie si l'ID du membre est spécifié dans les paramètres de requête ou dans les données postées
if (isset($_POST['member_id'])) {
    $member_id = $_POST['member_id'];
} elseif (isset($_GET['id'])) {
    $member_id = $_GET['id'];
} else {
    exit("ID du membre non spécifié.");
}

// Appeler la fonction pour supprimer le membre
deleteMember($bdd, $member_id);

// Rediriger l'utilisateur vers une page appropriée après la suppression
header('Location: /TFG/index.php');
exit;
?>
