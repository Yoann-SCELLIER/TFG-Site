<?php
require_once dirname(__DIR__) . '\TFG\controller\db.fn.php';
require_once dirname(__DIR__) . '\TFG\crud\member.fn.php';

$member = getMemberById($bdd, $_GET['id']);
// var_dump($_GET['id']);
// var_dump($member);

require_once dirname(__DIR__) . '\TFG\components\header.html.php';
require_once dirname(__DIR__) . '\TFG\views\member_detail.html.php';
require_once dirname(__DIR__) . '\TFG\components\footer.html.php';
?> 