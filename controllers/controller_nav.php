<?php

require_once dirname(__DIR__) . '/function/template_navbar.php';
require_once dirname(__DIR__) . '/crud/member.fn.php'; // Assurez-vous de l'emplacement correct du fichier

if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
    $member = getMemberById($bdd, $member_id);

    if ($member) {
        $role = $member['role_member'];

        switch ($role) {
            case 'memberGuest':
                echo navMemberGuest();
                break;
            case 'memberOfficial':
                echo navMemberOfficial();
                break;
            case 'memberAdmin':
                echo navMemberAdmin();
                break;
            default:
                echo navVisitor();
                break;
        }
    } else {
        echo navVisitor(); // Si la récupération du membre échoue
    }
} else {
    echo navVisitor(); // Si l'utilisateur n'est pas connecté
}
