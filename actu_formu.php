<?php

require_once dirname(__DIR__) . '\TFG\components\header.html.php';

var_dump($_SESSION['username']);

require_once dirname(__DIR__) . '/TFG/components/navbar.html.php';

require_once dirname(__DIR__) . '\TFG\controllers\views_actu.php';

require_once dirname(__DIR__) . '\TFG\controllers\post_form_handler.php';

require_once dirname(__DIR__) . '\TFG\views\actu_form.html.php';

require_once dirname(__DIR__) . '\TFG\components\footer.html.php';