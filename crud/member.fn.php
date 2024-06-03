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
function getMemberById($bdd, $member_id) {
    try {
        $sql = "SELECT member.*,
                GROUP_CONCAT(job.title SEPARATOR ', ') AS jobs
                FROM job 
                INNER JOIN member_job ON job.job_id = member_job.job_id 
                RIGHT JOIN member ON member_job.member_id = member.member_id 
                WHERE member_job.member_id = ?
                GROUP BY member.member_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($member); // Pour déboguer, vous pouvez le supprimer en production
        return $member;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des spécialité du membre: " . $e->getMessage());
    }
}

function addMemberJob($bdd, $member_id, $job_id) {
    try {
        // Requête SQL pour ajouter un emploi à un membre dans la table de liaison
        $sql = "INSERT INTO member_job (member_id, job_id) VALUES (?, ?)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id, $job_id]);
        return true;
    } catch (PDOException $e) {
        // Gérer les erreurs de requête SQL
        exit("Erreur lors de l'ajout de l'emploi au membre: " . $e->getMessage());
    }
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