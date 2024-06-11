<?php

require_once dirname(__DIR__) . '\components\header.html.php';

var_dump($_SESSION['username']);

require_once dirname(__DIR__) . '\controllers\controller_nav.php';

require_once dirname(__DIR__) . '\controllers\views_actu.php';

require_once dirname(__DIR__) . '\views\admin_read_post.html.php'; 

require_once dirname(__DIR__) . '/components/footeradmin.html.php';