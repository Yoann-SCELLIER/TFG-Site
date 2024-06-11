<?php

require_once dirname(__DIR__) . '\components\header.html.php';

var_dump($_SESSION['username']);

require_once dirname(__DIR__) . '\controllers\controller_nav.php';

require_once dirname(__DIR__) . '\views\admin_button_form.html.php';

require_once dirname(__DIR__) . '\controllers\view_list_post.php';

require_once dirname(__DIR__) . '\views\table_posts.html.php';

require_once dirname(__DIR__) . '/components/footeradmin.html.php';