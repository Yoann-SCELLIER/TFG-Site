<?php

function buttonMemberCard($id)
{
?>

    <div class="d-flex justify-content-evenly align-self-center p-3">
        <!-- Bouton pour modifier le membre -->
        <div aria-label="Actions" class="text-center m-3">
            <a href="/tfg/member_form.php?id=<?= $id ?>" class="btn btn-success">Modifier l'article</a>
        </div>

        <!-- Bouton pour supprimer le membre -->
        <div aria-label="Actions" class="text-center m-3">
            <a href="/TFG/controllers/delete_member.php?id=<?= $id ?>" class="btn btn-danger">Supprimer</a>
        </div>

        <!-- Formulaire pour le bouton Retour à la liste -->
        <div aria-label="Actions" class="text-center m-3">
            <a href="index.php#staffSection" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>

<?php 
} 
?>
