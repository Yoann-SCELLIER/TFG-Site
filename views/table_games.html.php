<section class="container-fluid px-5">
    <h1 class="text-center p-5">Liste des jeux</h1>
    <div class="table-responsive text-center">
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
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
                    <td><?php echo htmlspecialchars($game['game_id']); ?></td>
                    <td><?php echo htmlspecialchars($game['title']); ?></td>
                    <td>
                        <?php if (!empty($game['image_url'])) : ?>
                            <img src="<?php echo htmlspecialchars($game['image_url']); ?>" alt="Image URL du jeu" width="100" height="auto">
                        <?php else : ?>
                            Aucune image URL
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="/TFG/admin/admin_view_game.php?id=<?php echo $game['game_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
