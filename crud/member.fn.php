<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '/controller/db.fn.php';

// Fonction pour ajouter un membre à la base de données
function ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id, $cover) 
{
    try {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $role_id = 2; // Exemple de rôle par défaut

        $sql = "INSERT INTO member (username, first_name, last_name, email, password, departement_id, cover, role_id) 
                VALUES (:username, :first_name, :last_name, :email, :password, :departement_id, :cover, :role_id)";
        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':departement_id', $departement_id, PDO::PARAM_INT);
        $stmt->bindParam(':cover', $cover);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (PDOException $e) {
        exit("Erreur lors de l'ajout du membre : " . $e->getMessage());
    }
}


// Fonction pour vérifier si un nom d'utilisateur est déjà pris
function isUsernameTaken($bdd, $username)
{
    try {
        $sql = "SELECT COUNT(*) AS count FROM member WHERE username = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    } catch (PDOException $e) {
        exit("Erreur lors de la vérification du nom d'utilisateur : " . $e->getMessage());
    }
}

// Fonction pour vérifier si une adresse e-mail est déjà prise
function isEmailTaken($bdd, $email)
{
    try {
        $sql = "SELECT COUNT(*) AS count FROM member WHERE email = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    } catch (PDOException $e) {
        exit("Erreur lors de la vérification de l'e-mail : " . $e->getMessage());
    }
}

// Fonction pour connecter un utilisateur en vérifiant ses informations d'identification
function connexion($bdd, $email, $password)
{
    try {
        $sql = "SELECT member.*, role.* 
                FROM member 
                JOIN role ON member.role_id = role.id 
                WHERE member.email = :email";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['email' => $email]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($member && password_verify($password, $member['password'])) {
            return $member;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        exit("Erreur lors de la connexion : " . $e->getMessage());
    }
}

function check_role($required_role) 
{
    if (!isset($_SESSION['member_id']) || !isset($_SESSION['role_member'])) {
        header('Location: /TFG/log.php');
        exit();
    }

    if ($_SESSION['role_member'] !== $required_role) {
        header('Location: /TFG/index.php');
        exit();
    }
}

function check_multiple_roles($roles) 
{
    if (!isset($_SESSION['member_id']) || !isset($_SESSION['role_member'])) {
        header('Location: /TFG/log.php');
        exit();
    }

    if (!in_array($_SESSION['role_member'], $roles)) {
        header('Location: /TFG/index.php');
        exit();
    }
}

// Fonction pour afficher tous les membres
function viewMembers($bdd) 
{
    try {
        $sqlQuery = '
            SELECT member.*, role.role_member
            FROM member 
            LEFT JOIN role ON member.role_id = role.id';
        $stmt = $bdd->query($sqlQuery);
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $members;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des membres : " . $e->getMessage());
    }
}

// Fonction pour récupérer un membre par ID
function getMemberById($bdd, $member_id)
{
    try {
        $sql = "
            SELECT 
                m.*, 
                r.role_member,
                j.title AS job_title
            FROM member m
            LEFT JOIN role r ON m.role_id = r.id
            LEFT JOIN member_job mj ON m.member_id = mj.member_id
            LEFT JOIN job j ON mj.job_id = j.job_id
            WHERE m.member_id = :member_id
        ";

        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();

        $member = $stmt->fetch(PDO::FETCH_ASSOC);

        // Récupérer les titres des emplois
        $sqlJobs = "
            SELECT j.title 
            FROM job j
            JOIN member_job mj ON j.job_id = mj.job_id
            WHERE mj.member_id = :member_id
        ";
        $stmtJobs = $bdd->prepare($sqlJobs);
        $stmtJobs->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $stmtJobs->execute();
        $jobs = $stmtJobs->fetchAll(PDO::FETCH_COLUMN);

        $member['jobs'] = $jobs;

        return $member;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération du membre : " . $e->getMessage());
    }
}

// Fonction pour ajouter un emploi à un membre
function getMemberJobs(PDO $bdd, int $member_id): array 
{
    $query = "SELECT job_id FROM member_job WHERE member_id = :member_id";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['member_id' => $member_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Fonction pour mettre à jour les informations d'un membre
function updateMember($bdd, $member_id, $cover, $username, $email, $content, $role_id, $departement_id)
{
    try {
        $sql = "UPDATE member SET cover = :cover, username = :username, email = :email, content = :content, role_id = :role_id WHERE member_id = :member_id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':cover', $cover);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->bindParam(':member_id', $member_id);
        $stmt->execute();

        // Optionnel : Si vous avez besoin de récupérer des données après la mise à jour
        // return getMemberById($bdd, $member_id); // Par exemple, pour retourner le membre mis à jour
        return true; // Ou simplement true si la mise à jour réussit
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la mise à jour du membre : " . $e->getMessage());
    }
}

// Fonction pour lister tous les emplois
function listJobs($bdd) 
{
    try {
        $sql = 'SELECT * FROM job';
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des emplois : " . $e->getMessage());
    }
}

// Fonction pour supprimer un membre
function deleteMember($bdd, $member_id) 
{
    try {
        $sql = "DELETE FROM member WHERE member_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        return true;
    } catch (PDOException $e) {
        exit("Erreur lors de la suppression du membre : " . $e->getMessage());
    }
}

// Fonction pour récupérer tous les départements
function getDepartements($bdd) 
{
    try {
        $departements = [];
        $sql = "SELECT departement_id, departement_name FROM departement";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $departements[] = $row;
        }
        return $departements;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des départements : " . $e->getMessage());
    }
}

// Fonction pour récupérer tous les rôles
function getRolesFromDatabase($bdd) 
{
    try {
        $sql = "SELECT * FROM role";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des rôles : " . $e->getMessage());
    }
}

function updateMemberJobs($bdd, $member_id, $jobs_selected) 
{
    try {
        // Supprimer les anciennes associations de jobs pour ce membre
        $stmtDelete = $bdd->prepare("DELETE FROM member_job WHERE member_id = ?");
        $stmtDelete->execute([$member_id]);

        // Insérer les nouvelles associations de jobs sélectionnés
        $stmtInsert = $bdd->prepare("INSERT INTO member_job (member_id, job_id) VALUES (?, ?)");
        foreach ($jobs_selected as $job_id) {
            // Insérer seulement si l'association n'existe pas déjà
            $stmtInsert->execute([$member_id, $job_id]);
        }
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la mise à jour des jobs du membre : " . $e->getMessage());
    }
}