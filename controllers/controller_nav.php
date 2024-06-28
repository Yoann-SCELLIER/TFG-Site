<?php

// Inclusion du fichier contenant la fonction pour générer la barre de navigation, situé dans le répertoire "function" du répertoire parent.
require_once dirname(__DIR__) . '/template/template_navbar.php';

// Inclusion du fichier contenant les fonctions liées aux membres, situé dans le répertoire "crud" du répertoire parent.
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérifier si 'member_id' est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];

    // Appeler la fonction pour récupérer les détails du membre à partir de son 'member_id'
    $member = getMemberById($bdd, $member_id);

    // Vérifier si le membre existe
    if ($member) {
        $role = $member['role_member'];

        // Affichage de la barre de navigation en fonction du rôle du membre
        switch ($role) {
            case 'memberGuest':
                echo navMemberGuest(); // Barre de navigation pour les membres invités
                break;
            case 'memberOfficial':
                echo navMemberOfficial(); // Barre de navigation pour les membres officiels
                break;
            case 'memberAdmin':
                echo navMemberAdmin(); // Barre de navigation pour les administrateurs de membres
                break;
            default:
                echo navVisitor(); // Barre de navigation par défaut pour les visiteurs non connectés
                break;
        }
    } else {
        echo navVisitor(); // Afficher la barre de navigation par défaut si la récupération du membre échoue
    }
} else {
    echo navVisitor(); // Afficher la barre de navigation par défaut si l'utilisateur n'est pas connecté
}
