<?php
require_once dirname(__DIR__) . '/crud/member.fn.php';

// Vérifie si l'utilisateur a le rôle 'memberAdmin' avant de continuer
check_role('memberAdmin');
