<?php

require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Récupération de l'ID pour la modification du jeu ciblé
$id = $_GET['id'];

// Récupération de la vue du jeu avec l'ID spécifié
$game = getGameById($bdd, $id);

// Vérifier si le jeu existe
if ($game) {
?>

    <div class="col p-5">
        <div class="card border-2 m-5">
            <img src="<?= htmlspecialchars($game['image_url']) ?>" class="card-img-top p-5 align-self-center" 
            alt="Couverture <?= htmlspecialchars($game['title']) ?>" style="width:50rem; height:auto">
            <div class="card-body text-center">
                <h5 class="card-title"><?= htmlspecialchars($game['title']) ?></h5>
            </div>
            <div class="card-body">
                <p class="card-text"><?= htmlspecialchars($game['content']) ?></p>
            </div>

            <div class="d-flex text-center align-self-center">
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_form_game.php?id=<?= $game['game_id'] ?>" class="btn btn-warning">Modifier le jeu</a>
                </div>
    
                <?php if ($id) : ?>
                    <div aria-label="Actions" class="text-center m-3">
                        <form action="/TFG/controllers/delete_game.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                            <button type="submit" class="btn btn-danger">Supprimer le jeu</button>
                        </form>
                    </div>
                <?php endif; ?>
    
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_view_list_game.php" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>

        </div>
    </div>

<?php
} else {
    // Afficher un message si le jeu n'existe pas
    echo "Le jeu demandé n'existe pas.";
}
?>