<?php

require_once dirname(__DIR__) . '\components\header.html.php';

var_dump($_SESSION['username']);

require_once dirname(__DIR__) . '\controllers\controller_nav.php';

require_once dirname(__DIR__) . '\controllers\admin_form_game.php';

require_once dirname(__DIR__) . '\views\admin_formu_game.html.php';

require_once dirname(__DIR__) . '/components/footeradmin.html.php';