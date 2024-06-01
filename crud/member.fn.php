<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

function ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id)
{
    // Vérifier si le nom d'utilisateur ou l'adresse e-mail est déjà utilisé
    if (isUsernameTaken($bdd, $username) || isEmailTaken($bdd, $email)) {
        return false; // Nom d'utilisateur ou adresse e-mail déjà utilisé
    }

    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête SQL
    $sql = "INSERT INTO member (username, first_name, last_name, email, password, departement_id) VALUES (?, ?, ?, ?, ?, ?)";

    try {
        // Préparer la requête SQL
        $stmt = $bdd->prepare($sql);

        // Exécuter la requête avec les données
        $stmt->execute([$username, $first_name, $last_name, $email, $hashed_password, $departement_id]);

        // Retourner true si l'insertion a réussi
        return true;
    } catch (PDOException $e) {
        // Retourner false en cas d'erreur et afficher l'erreur
        echo "Erreur lors de l'ajout du membre : " . $e->getMessage();
        return false;
    }
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