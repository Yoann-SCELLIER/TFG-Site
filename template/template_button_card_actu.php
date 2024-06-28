<?php

/**
 * Fonction pour afficher les boutons d'action sur une carte d'article.
 *
 * Affiche deux boutons : un pour modifier l'article et un autre pour le supprimer,
 * si l'identifiant de l'article est fourni.
 *
 * @param int $id Identifiant de l'article
 */
function buttonCardActu($id) 
{
?>
    <div class="d-flex text-center justify-content-evenly">
        <!-- Bouton pour modifier l'article -->
        <div aria-label="Actions" class="text-center m-3">
            <a href="actu_formu.php?id=<?= $id ?>" class="btn btn-warning">Modifier l'article</a>
        </div>

        <!-- Vérification si un ID est présent pour afficher le bouton de suppression -->
        <?php if ($id) : ?>
            <div aria-label="Actions" class="text-center m-3">
                <!-- Formulaire pour supprimer l'article -->
                <form action="/TFG/controllers/delete_post.php" method="post" style="display: inline;">
                    <input type="hidden" name="post_id" value="<?= htmlspecialchars($id) ?>">
                    <button type="submit" class="btn btn-danger">Supprimer l'article</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
<?php
}
?>
