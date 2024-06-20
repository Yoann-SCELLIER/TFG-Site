<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '/controller/db.fn.php';

/**
 * Fonction pour ajouter un membre avec mot de passe hashé
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param string $username Nom d'utilisateur du membre à ajouter
 * @param string $first_name Prénom du membre à ajouter
 * @param string $last_name Nom de famille du membre à ajouter
 * @param string $email Adresse email du membre à ajouter
 * @param string $password Mot de passe hashé du membre à ajouter
 * @param int $departement_id ID du département du membre à ajouter
 * @param string $cover Chemin vers l'image de profil du membre à ajouter
 * @return bool Retourne true si l'insertion s'est bien déroulée, sinon false
 */
function ajouterMembre($bdd, $username, $first_name, $last_name, $email, $password, $departement_id, $cover) 
{
    try {
        // Chemin de l'image par défaut
        $default_cover = '/tfg/assets/images/Default_esports_player_silhouette_face_not_visible_light_in_th_2.jpg';
        
        // Requête SQL pour insérer le nouveau membre avec le mot de passe hashé
        $sql = "INSERT INTO member (username, first_name, last_name, email, password, departement_id, cover) 
                VALUES (:username, :first_name, :last_name, :email, :password, :departement_id, :cover)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password, // Utilisation du mot de passe hashé provenant du contrôleur
            'departement_id' => $departement_id,
            'cover' => $cover ? $cover : $default_cover // Utilisation de l'image de profil spécifiée ou par défaut
        ]);
        
        return true; // Retourne true si l'insertion s'est bien déroulée
    } catch (PDOException $e) {
        // En cas d'erreur PDO, enregistrez l'erreur dans les logs
        error_log("Erreur lors de l'inscription : " . $e->getMessage());
        return false; // Retourne false en cas d'erreur
    }
}

/**
 * Fonction pour vérifier si un nom d'utilisateur est déjà pris
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param string $username Nom d'utilisateur à vérifier
 * @return bool Retourne true si le nom d'utilisateur est déjà pris, sinon false
 */
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

/**
 * Fonction pour vérifier si une adresse e-mail est déjà prise
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param string $email Adresse email à vérifier
 * @return bool Retourne true si l'adresse email est déjà prise, sinon false
 */
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

/**
 * Fonction pour vérifier les informations d'identification et retourner le membre si elles correspondent
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param string $email Adresse email du membre à vérifier
 * @param string $password Mot de passe à vérifier (non hashé)
 * @return mixed Retourne les informations du membre si les identifiants sont valides, sinon false
 */
function connexion($bdd, $email, $password) 
{
    try {
        // Sélectionner l'utilisateur depuis la base de données
        $sql = "SELECT member.*, role.* 
                FROM member 
                JOIN role ON member.role_id = role.id 
                WHERE member.email = :email";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['email' => $email]);
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($member) {
            // Récupération du mot de passe hashé depuis la base de données
            $hashed_password = $member['password'];
            
            // Vérification du mot de passe avec password_verify
            if (password_verify($password, $hashed_password)) {
                // Mot de passe correct : retourne les informations du membre
                return $member;
            } else {
                // Mot de passe incorrect
                return false;
            }
        } else {
            // Aucun membre correspondant trouvé avec cet email
            return false;
        }
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        error_log("Erreur lors de la connexion : " . $e->getMessage());
        return false;
    }
}

/**
 * Fonction pour vérifier le rôle de l'utilisateur actuel
 *
 * @param string $required_role Role requis pour accéder à la fonction
 * @return void Redirige l'utilisateur s'il n'a pas le rôle requis
 */
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

/**
 * Fonction pour vérifier si l'utilisateur actuel a au moins un des rôles spécifiés
 *
 * @param array $roles Liste des rôles autorisés
 * @return void Redirige l'utilisateur s'il n'a pas au moins un des rôles spécifiés
 */
function check_multiple_roles($roles) 
{
    if (!in_array($_SESSION['role_member'], $roles)) {
        session_unset();
        session_destroy();
        header("Location: /TFG/log.php");
        exit();
    }
}

/**
 * Fonction pour récupérer tous les membres avec leur rôle
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @return array Tableau contenant tous les membres et leur rôle
 */
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

/**
 * Fonction pour récupérer un membre spécifique par son ID, incluant ses emplois associés
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param int $member_id ID du membre à récupérer
 * @return mixed Retourne les informations du membre si trouvé, sinon exit avec un message d'erreur
 */
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

        if ($member) {
            // Récupérer les titres des emplois associés au membre
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

            $member['jobs'] = $jobs; // Ajouter les emplois au tableau du membre
        }

        return $member;
    } catch (PDOException $e) {
        exit("Erreur lors de la récupération du membre : " . $e->getMessage());
    }
}

/**
 * Fonction pour récupérer les ID des emplois d'un membre spécifique
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param int $member_id ID du membre pour lequel récupérer les emplois
 * @return array Tableau contenant les ID des emplois du membre
 */
function getMemberJobs(PDO $bdd, int $member_id): array 
{
    $query = "SELECT job_id FROM member_job WHERE member_id = :member_id";
    $stmt = $bdd->prepare($query);
    $stmt->execute(['member_id' => $member_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/**
 * Fonction pour mettre à jour les informations d'un membre
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param int $member_id ID du membre à mettre à jour
 * @param string $cover Chemin vers la nouvelle image de profil du membre
 * @param string $username Nouveau nom d'utilisateur du membre
 * @param string $email Nouvelle adresse email du membre
 * @param string $content Nouveau contenu (optionnel) associé au membre
 * @param int $role_id Nouvel ID de rôle du membre
 * @param int $departement_id Nouvel ID de département du membre
 * @return bool Retourne true si la mise à jour s'est bien déroulée, sinon lance une exception avec un message d'erreur
 */
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

/**
 * Fonction pour lister tous les emplois disponibles
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @return array Tableau contenant tous les emplois disponibles
 */
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

/**
 * Fonction pour supprimer un membre de la base de données
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param int $member_id ID du membre à supprimer
 * @return bool Retourne true si la suppression s'est bien déroulée, sinon lance une exception avec un message d'erreur
 */
function deleteMember($bdd, $member_id) 
{
    try {
        $sql = "DELETE FROM member WHERE member_id = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$member_id]);
        return true; // Retourne true si la suppression s'est bien déroulée
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la suppression du membre : " . $e->getMessage());
    }
}

/**
 * Fonction pour récupérer tous les départements disponibles
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @return array Tableau contenant tous les départements disponibles
 */
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

/**
 * Fonction pour récupérer tous les rôles disponibles depuis la base de données
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @return array Tableau contenant tous les rôles disponibles
 */
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

/**
 * Fonction pour mettre à jour les emplois d'un membre dans la base de données
 *
 * @param PDO $bdd Instance de connexion PDO à la base de données
 * @param int $member_id ID du membre dont les emplois sont mis à jour
 * @param array $jobs_selected Tableau contenant les ID des nouveaux emplois sélectionnés
 * @return void Lance une exception en cas d'erreur lors de la mise à jour des jobs du membre
 */
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
