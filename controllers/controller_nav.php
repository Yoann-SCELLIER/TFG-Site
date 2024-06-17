<?php

require_once dirname(__DIR__) . '/function/template_navbar.php';

if (empty($_SESSION['role_member'])) {
    echo navVisitor();
} elseif ($_SESSION['role_member'] == 'memberGuest') {
    echo navMemberGuest();
} elseif ($_SESSION['role_member'] == 'memberOfficial') {
    echo navMemberOfficial();
} elseif ($_SESSION['role_member'] == 'memberAdmin') {
    echo navMemberAdmin();
}