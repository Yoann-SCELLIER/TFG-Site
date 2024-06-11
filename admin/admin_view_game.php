<!-- détail des game -->

<?php

require_once dirname(__DIR__) . '\components\header.html.php';

var_dump($_SESSION['username']);

require_once dirname(__DIR__) . '/components/navadmin.html.php';

require_once dirname(__DIR__) . '/controllers/view_game.php';

require_once dirname(__DIR__) . '\views\admin_read_game.html.php';

require_once dirname(__DIR__) . '/components/footeradmin.html.php';