<?php
// Inclure le fichier de configuration de la base de données
require_once dirname(__DIR__) . '\controller\db.fn.php';

require_once dirname(__DIR__) . '\controllers\reade_member.php';
?>

    <h1>Détails du Membre</h1>
    <?php if(isset($member) && !empty($member)): ?>
        <img src="<?php echo $member['cover']; ?>" alt="Image de <?php echo $member['username']; ?>">
        <p><strong>Username :</strong> <?php echo $member['username']; ?></p>
        <!-- <p><strong>Role :</strong> <?php //  echo $member['role']; ?></p> -->
        <!-- <p><strong>Spécialité :</strong> <?php // echo $member['job']; ?></p> -->
        <p><strong>Description :</strong> <?php echo $member['content']; ?></p>
        <p><strong>Créé le :</strong> <?php echo $member['created_at']; ?></p>
        <p><strong>Mis à jour le :</strong> <?php echo $member['modif_at']; ?></p>
        
        <!-- Bouton pour modifier le membre -->
        <a href="modifier_membre.php?id=<?php echo $member['member_id']; ?>">Modifier</a>
        
        <!-- Bouton pour supprimer le membre -->
        <form action="supprimer_membre.php" method="post">
            <input type="hidden" name="member_id" value="<?php echo $member['member_id']; ?>">
            <button type="submit">Supprimer</button>
        </form>
        
        <a href="index.php">Retour à la liste</a>
    <?php else: ?>
        <p>Le membre n'existe pas ou l'ID du membre n'a pas été spécifié.</p>
        <a href="index.php">Retour à la liste</a>
    <?php endif; ?>
