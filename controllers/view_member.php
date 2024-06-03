<?php
require_once dirname(__DIR__) . '\TFG\controller\db.fn.php';
require_once dirname(__DIR__) . '\TFG\crud\member.fn.php';

// Vérifier si l'ID du membre est présent et valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $member_id = $_GET['id'];
    $member = getMemberById($bdd, $member_id);
    // var_dump($_GET['id']);
    // var_dump($member);

    require_once dirname(__DIR__) . '\TFG\components\header.html.php';
    require_once dirname(__DIR__) . '\TFG\views\member_detail.html.php';
    require_once dirname(__DIR__) . '\TFG\components\footer.html.php';
} else {
    echo "ID du membre invalide.";
}
