<?php
require_once dirname(__DIR__) . '\crud\member.fn.php';

$member = getMemberById($bdd, $_GET['id']);

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
    
 
} else {
    echo "ID du membre invalide.";
}
?>
