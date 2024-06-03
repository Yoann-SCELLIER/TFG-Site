<?php
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php'; // Modifier le chemin si nécessaire

// Vérifiez si l'ID du membre est passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    
    // Appeler la fonction pour récupérer les détails du membre
    $member = getMemberById($bdd, $member_id);
    
    if ($member) {
        // Inclure la vue pour afficher les détails du membre
        include dirname(__DIR__) . '\views\member_detail_view.php';
    } else {
        echo "Membre non trouvé.";
    }
} else {
    echo "ID du membre invalide.";
}
?>
