<section class="container-fluid px-5">
    <!-- Titre principal -->
    <h1 class="text-center p-2 m-0">Liste des jeux</h1>
    <div class="table-responsive text-center">
        <!-- Tableau Bootstrap avec bordures -->
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
                <!-- En-têtes de colonnes -->
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Image URL</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($games as $game) : ?>
                <tr>
                    <!-- ID du jeu -->
                    <td><?php echo htmlspecialchars($game['game_id']); ?></td>
                    <!-- Nom du jeu -->
                    <td><?php echo htmlspecialchars($game['title']); ?></td>
                    <td>
                        <!-- Image URL du jeu (si disponible) -->
                        <?php if (!empty($game['cover'])) : ?>
                            <img src="<?php echo htmlspecialchars($game['cover']); ?>" alt="Image URL du jeu" width="100" height="auto">
                        <?php else : ?>
                            <!-- Message si aucune image URL n'est disponible -->
                            Aucune image URL
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <!-- Bouton pour voir les détails du jeu -->
                        <a href="/TFG/admin/admin_view_game.php?id=<?php echo $game['game_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
