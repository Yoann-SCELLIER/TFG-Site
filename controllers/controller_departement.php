<?php
// Inclure le fichier contenant la fonction pour récupérer les départements
require_once dirname(__DIR__) . '\crud\member.fn.php'; 

// Appel de la fonction pour récupérer les départements
$departements = getDepartements($bdd);

?>