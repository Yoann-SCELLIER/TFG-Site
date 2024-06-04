<?php
require_once dirname(__DIR__) . '/TFG/controller/db.fn.php';
require_once dirname(__DIR__) . '/TFG/crud/member.fn.php';

// Récupérer les détails du membre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    
    // Récupérer les détails du membre
    $member = getMemberById($bdd, $member_id);
    
    // Récupérer la liste de tous les jobs disponibles
    $sql_jobs = "SELECT * FROM job";
    $stmt_jobs = $bdd->prepare($sql_jobs);
    $stmt_jobs->execute();
    $all_jobs = $stmt_jobs->fetchAll(PDO::FETCH_ASSOC);
    
    // Inclure le fichier de vue pour afficher les détails du membre avec la liste des jobs
    require_once dirname(__DIR__) . '/TFG/components/header.html.php';
    require_once dirname(__DIR__) . '/TFG/views/member_form.html.php';
    require_once dirname(__DIR__) . '/TFG/components/footer.html.php';
} else {
    echo "ID du membre invalide.";
}
?>
