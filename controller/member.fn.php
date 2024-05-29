<?php

function selectmember($bdd) 
{
    $sql = "SELECT * FROM member";
    $stmt = $bdd->query($sql);
    return $stmt->fetchAll();
}

function inscription($bdd, $pseudo, $email, $pass, $profil)
{
    $sql = "SELECT * FROM member WHERE email = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        return ['success' => false, 'message' => "Un utilisateur avec cet email existe déjà."];
    }

    $mdp_hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO member (pseudo, email, pass, profil) VALUES (:pseudo, :email, :pass, :profil)";
    $stmt = $bdd->prepare($sql);
    $success = $stmt->execute(['pseudo' => $pseudo, 'email' => $email, 'pass' => $mdp_hash, 'profil' => $profil]);

    if ($success) {
        return ['success' => true, 'message' => "L'utilisateur a été inscrit avec succès."];
    } else {
        return ['success' => false, 'message' => "Erreur lors de l'inscription de l'utilisateur."];
    }
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