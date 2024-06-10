<?php
require_once dirname(__DIR__) . '\TFG\components\header.html.php';

var_dump($_SESSION['username']);

require_once dirname(__DIR__) . '/TFG/components/navbar.html.php';

require_once dirname(__DIR__) . '/TFG/controllers/update_member.php';

require_once dirname(__DIR__) . '/TFG/controllers/update_member_job.php';

require_once dirname(__DIR__) . '\TFG\views\member_form.html.php';

require_once dirname(__DIR__) . '\TFG\views\formulaire.html.php';

require_once dirname(__DIR__) . '\TFG\components\footer.html.php';