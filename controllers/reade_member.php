<?php
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\controllers\reade_member.php';
require_once dirname(__DIR__) . '\controllers\reade_job.php';
require_once dirname(__DIR__) . '\crud\member_job.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php';

// Récupérer les détails du membre
$member = readMember($bdd, $_GET['id']);

// Récupérer les titres des jobs du membre
$member_job_titles = getMemberJobsTitles($bdd, $member['member_id']);

// Vérifier si le membre existe
if ($member) {
    // Afficher la vue
    include dirname(__DIR__) . '\views\member_detail.html.php';
} else {
    // Si le membre n'existe pas, afficher un message d'erreur
    echo "Le membre demandé n'existe pas.";
}
?>
