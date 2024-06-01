<?php

require_once dirname(__DIR__) . '/controller/db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php'; // Modifier le chemin si nécessaire


// Vérifier si l'ID du membre est défini dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID du membre depuis l'URL
    $member_id = $_GET['id'];
    
    // Récupérer les détails du membre en utilisant l'ID
    $member = readMember($bdd, $member_id);
}