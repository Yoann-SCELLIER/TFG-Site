<?php

function selectmember($bdd) 
{
    $sql = "SELECT * FROM member";
    $stmt = $bdd->query($sql);
    return $stmt->fetchAll();
}

function connexion($bdd, $email, $pass)
{
    $sql = "SELECT * FROM member WHERE email = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['email' => $email]);
    $utilisateur = $stmt->fetch();
    if ($utilisateur && password_verify($pass, $utilisateur['pass'])) {
        return $utilisateur;
    } else {
        return false;
    }
}