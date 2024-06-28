<?php

// Inclusion du header
require_once dirname(__DIR__) . '\tfg\components\header.html.php';
 
// Inclusion du contrôleur de navigation
require_once dirname(__DIR__) . '\tfg\controllers\controller_nav.php';

// Inclusion de la bannière pour les actualités
require_once dirname(__DIR__) . '\tfg\components\banniere_actu.html.php';

// Inclusion du contrôleur pour afficher la liste des posts (actualités)
require_once dirname(__DIR__) . '\tfg\controllers\view_list_post.php';

// Inclusion de la vue pour afficher le contenu des actualités
require_once dirname(__DIR__) . '\tfg\views\actu_contenu.html.php';

// Inclusion de la vue du formulaire
require_once dirname(__DIR__) . '\tfg\views\formulaire.html.php';

// Inclusion de la vue des conditions
require_once dirname(__DIR__) . '\tfg\views\condition.html.php';

// Inclusion du footer
require_once dirname(__DIR__) . '\tfg\components\footer.html.php';

?>