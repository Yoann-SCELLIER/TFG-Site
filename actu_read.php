<?php
require_once dirname(__DIR__) . '\TFG\components\header.html.php';
var_dump($_SESSION['username']);


require_once dirname(__DIR__) . '/TFG/components/navbar.html.php';

require_once dirname(__DIR__) . '\TFG\controllers\views_actu.php';

require_once dirname(__DIR__) . '\TFG\views\actu_reade.html.php';

require_once dirname(__DIR__) . '\TFG\views\button_actu_read.html.php';

require_once dirname(__DIR__) . '\TFG\views\formulaire.html.php';

require_once dirname(__DIR__) . '\TFG\components\footer.html.php';
?>