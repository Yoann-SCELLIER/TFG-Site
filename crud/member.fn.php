<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour ajouter un membre à la base de données
function ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id, $cover) 
{
    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Définir le rôle par défaut (par exemple, 2)
    $role_id = 2;

    // Préparer la requête SQL
    $sql = "INSERT INTO member (username, first_name, last_name, email, password, departement_id, cover, role_id) 
            VALUES (:username, :first_name, :last_name, :email, :password, :departement_id, :cover, :role_id)";

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
    $stmt->bindValue(':role_id', $role_id, PDO::PARAM_INT);

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
function connexion($bdd, $email, $password)
{
    $sql = "SELECT member.*, role.* 
    FROM member JOIN role 
    ON member.role_id = role.id 
    WHERE member.email = :email;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['email' => $email]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($member && password_verify($password, $member['password'])) {
        // echo $password;
        // die;
        return $member;
    } else {
        return false;
    }
}

//---------------------------------------------------------------------------------------------------------------------------------------------
// Fonction pour afficher tous les membres
function viewMembers($bdd) 
{
    // Requête pour récupérer tous les membres
    $sqlQuery = 'SELECT * FROM member';
    $stmt = $bdd->query($sqlQuery);
    $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $members;
}

//---------------------------------------------------------------------------------------------------------------------------------------------
function getMemberById($bdd, $member_id) 
{
    try {
        $sql = "SELECT member.*, 
                GROUP_CONCAT(job.title SEPARATOR ', ') AS jobs
                FROM member
                LEFT JOIN member_job ON member.member_id = member_job.member_id
                LEFT JOIN job ON member_job.job_id = job.job_id
                WHERE member.member_id = ?
                GROUP BY member.member_id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Sélectionner la liste de tous les jobs disponibles
        $sql_jobs = "SELECT * FROM job";
        $stmt_jobs = $bdd->prepare($sql_jobs);
        $stmt_jobs->execute();
        $jobs = $stmt_jobs->fetchAll(PDO::FETCH_ASSOC);

        // Ajouter la liste de tous les jobs disponibles aux détails du membre
        $member['all_jobs'] = $jobs;
        
        return $member;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération des détails du membre : " . $e->getMessage());
    }
}

//---------------------------------------------------------------------------------------------------------------------------------------------
function addMemberJob($bdd, $member_id, $job_id) 
{
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

//---------------------------------------------------------------------------------------------------------------------------------------------
function updateMember($bdd, $member_id, $cover, $username, $email, $jobs, $content) 
{
    try {
        // Mise à jour du membre
        $sql = "UPDATE member SET cover = :cover, username = :username, email = :email, content = :content, modif_at = CURRENT_TIMESTAMP WHERE member_id = :member_id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':cover', $cover);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();

        // Suppression des anciennes compétences
        $sql = "DELETE FROM member_job WHERE member_id = :member_id";
        $stmt = $bdd->prepare($sql);
        $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
        $stmt->execute();

        // Insertion des nouvelles compétences
        $sql = "INSERT INTO member_job (member_id, job_id) VALUES (:member_id, :job_id)";
        $stmt = $bdd->prepare($sql);
        foreach ($jobs as $job_id) {
            $stmt->bindValue(':member_id', $member_id, PDO::PARAM_INT);
            $stmt->bindValue(':job_id', $job_id, PDO::PARAM_INT);
            $stmt->execute();
        }

    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour du membre : " . $e->getMessage();
    }
}

//---------------------------------------------------------------------------------------------------------------------------------------------
function listJobs($bdd) 
{

    // On récupère tout le contenu de la table job
    $sqlQuery = 'SELECT * FROM job';
    $recipesStatement1 = $bdd->prepare($sqlQuery);
    $recipesStatement1->execute();
    $listJobs = $recipesStatement1->fetchAll();
    return $listJobs;
}

//---------------------------------------------------------------------------------------------------------------------------------------------
function deleteMember($bdd, $member_id) 
{
    try {
        // Préparer la requête SQL pour supprimer le membre
        $sql = "DELETE FROM member WHERE member_id = ?";
        $stmt = $bdd->prepare($sql);
        // Exécuter la requête en liant le paramètre du membre_id
        $stmt->execute([$member_id]);
        // Retourner vrai si la suppression a réussi
        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur et retourner faux
        exit("Erreur lors de la suppression du membre : " . $e->getMessage());
        return false;
    }
}

function getDepartements($bdd) {
    $departements = array();

    $sql = "SELECT departement_id, departement_name FROM departement";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $departements[] = $row;
    }

    return $departements;
}

