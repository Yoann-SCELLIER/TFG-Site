<?php

function buttonMemberCard($id)
{
?>
    <div class="d-flex justify-content-evenly p-3">
        <!-- Bouton pour modifier le membre -->
        <!-- <form action="/../member_form.php" method="get" style="display: inline;">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">
            <button type="submit" class="btn btn-success">Modifier</button>
        </form> -->

        <div aria-label="Actions" class="text-center m-3">
            <a href="/tfg/member_form.php?id=<?= $id ?>" class="btn btn-success">Modifier l'article</a>
        </div>

        <!-- Bouton pour supprimer le membre -->
        <form action="/TFG/controllers/delete_member.php" method="post" style="display: inline;">
            <input type="hidden" name="member_id" value="<?= htmlspecialchars($id); ?>">
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        <!-- Formulaire pour le bouton Retour à la liste -->
        <form action="index.php#staffSection" method="get" style="display: inline;">
            <button type="submit" class="btn btn-secondary">Retour à la liste</button>
        </form>
    </div>
<?php 
} 
?>
