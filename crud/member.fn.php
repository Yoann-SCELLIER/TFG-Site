<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

// Fonction pour ajouter un membre à la base de données
function ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id, $cover) 
{
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $role_id = 2;

    $sql = "INSERT INTO member (username, first_name, last_name, email, password, departement_id, cover, role_id) 
            VALUES (:username, :first_name, :last_name, :email, :password, :departement_id, :cover, :role_id)";
    $stmt = $bdd->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':first_name', $first_name);
    $stmt->bindValue(':last_name', $last_name);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $hashed_password);
    $stmt->bindValue(':departement_id', $departement_id, PDO::PARAM_INT);
    $stmt->bindValue(':cover', $cover);
    $stmt->bindValue(':role_id', $role_id, PDO::PARAM_INT);

    return $stmt->execute();
}

// Fonction pour vérifier si un nom d'utilisateur est déjà pris
function isUsernameTaken($bdd, $username)
{
    $sql = "SELECT COUNT(*) AS count FROM member WHERE username = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

// Fonction pour vérifier si une adresse e-mail est déjà prise
function isEmailTaken($bdd, $email)
{
    $sql = "SELECT COUNT(*) AS count FROM member WHERE email = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

// Fonction pour connecter un utilisateur en vérifiant ses informations d'identification
function connexion($bdd, $email, $password)
{
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
}

// Fonction pour afficher tous les membres
function viewMembers($bdd) 
{
    $sqlQuery = 'SELECT * FROM member';
    $stmt = $bdd->query($sqlQuery);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $members;
}

function getMemberById($bdd, $member_id) {
    try {
        $sql = "SELECT member.*, 
                       GROUP_CONCAT(job.title SEPARATOR ', ') AS jobs,
                       role.role_member
                FROM member
                LEFT JOIN member_job ON member.member_id = member_job.member_id
                LEFT JOIN job ON member_job.job_id = job.job_id
                LEFT JOIN role ON member.role_id = role.id
                WHERE member.member_id = ?
                GROUP BY member.member_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des détails du membre : " . $e->getMessage());
    }
}

function addMemberJob($bdd, $member_id, $job_id) 
{
    try {
        $sql = "INSERT INTO member_job (member_id, job_id) VALUES (?, ?)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id, $job_id]);
        return true;
    } catch (PDOException $e) {
        exit("Erreur lors de l'ajout de l'emploi au membre: " . $e->getMessage());
    }
}

// Fonction pour mettre à jour les informations d'un membre
function updateMember($bdd, $member_id, $cover, $username, $email, $jobs, $content, $role_id)
{
    try {
        // Préparer la requête SQL pour mettre à jour le membre
        $sql = "UPDATE member 
                SET cover = :cover, username = :username, email = :email, content = :content, role_id = :role_id, modif_at = CURRENT_TIMESTAMP 
                WHERE member_id = :member_id";
        $stmt = $bdd->prepare($sql);

        // Liaison des valeurs aux paramètres de la requête
        $stmt->bindValue(':cover', $cover);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);

        // Exécution de la requête pour mettre à jour le membre
        $stmt->execute();

        // Suppression des anciens emplois associés au membre
        $sql_delete_jobs = "DELETE FROM member_job WHERE member_id = :member_id";
        $stmt_delete_jobs = $bdd->prepare($sql_delete_jobs);
        $stmt_delete_jobs->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        $stmt_delete_jobs->execute();

        // Ajout des nouveaux emplois associés au membre
        $sql_add_jobs = "INSERT INTO member_job (member_id, job_id) VALUES (:member_id, :job_id)";
        $stmt_add_jobs = $bdd->prepare($sql_add_jobs);
        foreach ($jobs as $job_id) {
            $stmt_add_jobs->bindValue(':member_id', $member_id, PDO::PARAM_INT);
            $stmt_add_jobs->bindValue(':job_id', $job_id, PDO::PARAM_INT);
            $stmt_add_jobs->execute();
        }

        // Retourner true si la mise à jour s'est effectuée avec succès
        return true;
    } catch (PDOException $e) {
        // Capturer les exceptions PDO (problèmes de base de données)
        throw new Exception("Erreur PDO lors de la mise à jour du membre : " . $e->getMessage());
    } catch (Exception $e) {
        // Capturer les autres exceptions
        throw new Exception("Erreur lors de la mise à jour du membre : " . $e->getMessage());
    }
}

function listJobs($bdd) 
{
    $sqlQuery = 'SELECT * FROM job';
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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

function getDepartements($bdd) 
{
    $departements = [];
    $sql = "SELECT departement_id, departement_name FROM departement";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $departements[] = $row;
    }
    return $departements;
}

function getRolesFromDatabase($bdd) 
{
    $sql = "SELECT * FROM role";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
