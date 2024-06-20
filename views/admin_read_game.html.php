<?php
// Inclure le fichier de fonctions pour gérer les opérations CRUD des jeux
require_once dirname(__DIR__) . '/crud/game_console.fn.php';

// Récupérer l'ID du jeu à afficher depuis la requête GET
$id = $_GET['id'];

// Récupérer les détails du jeu depuis la base de données en utilisant l'ID
$game = getGameById($bdd, $id);

// Vérifier si le jeu existe
if ($game) {
?>
    <div class="col p-5">
        <div class="card border-2 m-5">
            <!-- Image du jeu -->
            <img src="<?= htmlspecialchars($game['image_url']) ?>" class="card-img-top p-5 align-self-center" 
                alt="Couverture <?= htmlspecialchars($game['title']) ?>" style="width:50rem; height:auto">
            <div class="card-body text-center">
                <!-- Titre du jeu -->
                <h5 class="card-title"><?= htmlspecialchars($game['title']) ?></h5>
            </div>
            <div class="card-body">
                <!-- Description du jeu -->
                <p class="card-text"><?= htmlspecialchars($game['content']) ?></p>
            </div>

            <!-- Actions sur le jeu -->
            <div class="d-flex text-center align-self-center">
                <!-- Bouton pour modifier le jeu -->
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_form_game.php?id=<?= $game['game_id'] ?>" class="btn btn-warning">Modifier le jeu</a>
                </div>

                <!-- Formulaire pour supprimer le jeu -->
                <?php if ($id) : ?>
                    <div aria-label="Actions" class="text-center m-3">
                        <form action="/TFG/controllers/delete_game.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                            <button type="submit" class="btn btn-danger">Supprimer le jeu</button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Bouton pour retourner à la liste des jeux -->
                <div aria-label="Actions" class="text-center m-3">
                    <a href="/TFG/admin/admin_view_list_game.php" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>

        </div>
    </div>

<?php
} else {
    // Afficher un message si le jeu n'existe pas
    header('Location: /TFG/404.php');
}
?>
