<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour ajouter un membre à la base de données
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

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour vérifier si un nom d'utilisateur est déjà pris
function isUsernameTaken($bdd, $username)
{
    $sql = "SELECT COUNT(*) AS count FROM member WHERE username = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour vérifier si une adresse e-mail est déjà prise
function isEmailTaken($bdd, $email)
{
    $sql = "SELECT COUNT(*) AS count FROM member WHERE email = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour connecter un utilisateur en vérifiant ses informations d'identification
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

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour afficher tous les membres
function viewMembers($bdd) {
    // Requête pour récupérer tous les membres
    $sqlQuery = 'SELECT * FROM member';
    $stmt = $bdd->query($sqlQuery);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $members;
}

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour lire les détails d'un membre spécifique
function readMember($bdd, $member_id) {
    // Préparer la requête SQL
    $sql = "SELECT * FROM member WHERE member_id = ?";
    
    // Préparer et exécuter la requête
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$member_id]);
    
    // Récupérer le membre
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Retourner le membre
    return $member;
}

//---------------------------------------------------------------------------------------------------------------------------------------------
// Modification d'un membre
function get_member_by_id($bdd, $member_id) {
    // Prépare et exécute la requête SQL pour récupérer les informations du membre par son ID
    $sql = "SELECT * FROM member WHERE member_id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$member_id]);
    // Renvoie le résultat de la requête sous forme de tableau associatif
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update_member($bdd, $member_id, $cover = null, $username = null, $email = null, $job = null, $content = null) {
    // Construction de la requête SQL de mise à jour en fonction des champs soumis
    $sql = "UPDATE member SET ";
    $params = [];

    if ($cover !== null) {
        $sql .= "cover = ?, ";
        $params[] = $cover;
    }
    if ($username !== null) {
        $sql .= "username = ?, ";
        $params[] = $username;
    }
    if ($email !== null) {
        $sql .= "email = ?, ";
        $params[] = $email;
    }
    if ($job !== null) {
        // Assurez-vous que $job est un tableau
        if (!is_array($job)) {
            $job = [$job];
        }
        $sql .= "job = ?, ";
        $params[] = implode(',', $job);
    }
    if ($content !== null) {
        $sql .= "content = ?, ";
        $params[] = $content;
    }

    // Supprime la virgule et l'espace en trop à la fin de la requête
    $sql = rtrim($sql, ", ");

    // Ajoute la clause WHERE pour la mise à jour du membre spécifique
    $sql .= " WHERE member_id = ?";

    // Ajoute l'ID du membre à la liste des paramètres
    $params[] = $member_id;

    // Prépare la requête SQL
    $stmt = $bdd->prepare($sql);

    // Exécute la requête en liant les valeurs
    $stmt->execute($params);
}



//---------------------------------------------------------------------------------------------------------------------------------------------