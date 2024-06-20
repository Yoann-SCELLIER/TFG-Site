<?php

/**
 * Fonction pour afficher les boutons d'action sur la carte d'un membre.
 *
 * Affiche trois boutons : un pour modifier le membre, un pour le supprimer,
 * et un pour retourner à la liste des membres.
 *
 * @param int $post_id Identifiant du membre
 */
function buttonMemberCard($post_id)
{
?>
    <div class="d-flex justify-content-evenly p-3">
        <!-- Formulaire pour modifier le membre -->
        <form action="member_form.php" method="get" style="display: inline;">
            <input type="hidden" name="id" value="<?= htmlspecialchars($post_id); ?>">
            <button type="submit" class="btn btn-success">Modifier</button>
        </form>
        
        <!-- Formulaire pour supprimer le membre -->
        <form action="/TFG/controllers/delete_member.php" method="post" style="display: inline;">
            <input type="hidden" name="member_id" value="<?= htmlspecialchars($post_id); ?>">
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        
        <!-- Formulaire pour retourner à la liste des membres -->
        <form action="index.php#staffSection" method="get" style="display: inline;">
            <button type="submit" class="btn btn-secondary">Retour à la liste</button>
        </form>
    </div>
<?php
}
?>
