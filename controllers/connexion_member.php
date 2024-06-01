<?php
require_once dirname(__DIR__) . '\controller\db.fn.php';
require_once dirname(__DIR__) . '\crud\member.fn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $hashed_password = $_POST['password'];
    
    $member = connexion($bdd, $email, $hashed_password);
    
    if ($member) {
        $_SESSION['member_id'] = $member['member_id'];
        // $_SESSION['role'] = $member['role'];
        $_SESSION['username'] = $member['username']; 
        var_dump($member['username']);

        // if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'member') {
            // header("Location: ../index.html.php");
        // } 
        exit();
    } else {
        $erreur = "Email ou mot de passe incorrect."; 
    }
}

if (isset($_SESSION['inscrit'])) {
    $message = $_SESSION['inscrit'];
    unset($_SESSION['inscrit']);
}


