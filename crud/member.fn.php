<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

function ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id, $cover) {
    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Préparer la requête SQL
    $sql = "INSERT INTO member (username, first_name, last_name, email, password, departement_id, cover) 
            VALUES (:username, :first_name, :last_name, :email, :password, :departement_id, :cover)";

    // Préparer la requête
    $stmt = $bdd->prepare($sql);

    // Lier les valeurs
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':first_name', $first_name);
    $stmt->bindValue(':last_name', $last_name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $hashed_password);
    $stmt->bindValue(':departement_id', $departement_id, PDO::PARAM_INT);
    $stmt->bindValue(':cover', $cover);

    // Exécuter la requête
    return $stmt->execute();
}


function isUsernameTaken($bdd, $username)
{
    $sql = "SELECT COUNT(*) AS count FROM member WHERE username = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

function isEmailTaken($bdd, $email)
{
    $sql = "SELECT COUNT(*) AS count FROM member WHERE email = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

function connexion($bdd, $email, $hashed_password)
{

    $sql = "SELECT * FROM member WHERE email = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['email' => $email]);
    $member = $stmt->fetch();
    if ($member && password_verify($hashed_password, $member['password'])) {
        return $member;
    } else {
        return false;
    }
}

function viewMembers($bdd) {
    // Requête pour récupérer tous les membres
    $sqlQuery = 'SELECT * FROM member';
    $stmt = $bdd->query($sqlQuery);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $members;
}

