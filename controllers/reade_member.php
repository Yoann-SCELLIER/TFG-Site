<?php
// Inclure les fichiers nécessaires
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member_job.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php'; // Assurez-vous de fournir le chemin correct pour le fichier contenant la définition de la fonction getMemberJobs()

// Récupérer les détails du membre
$member = readMember($bdd, $_GET['id']); // Assurez-vous que $_GET['id'] contient un ID valide

// Vérifier si le membre existe
if ($member) {
    // Récupérer les jobs du membre une fois que vous avez confirmé que le membre existe
    $member_jobs = getMemberJobs($member['member_id'], $bdd); // Assurez-vous que getMemberJobs() est correctement défini
var_dump($member_jobs);
} else {
    // Si le membre n'existe pas, afficher un message d'erreur
    echo "Le membre demandé n'existe pas.";
}
?>
