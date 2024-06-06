<div class="container">
    <h1 class="text-center m-5">Liste des actualités</h1>
    <table class="table table-bordered border border-2 border-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($post['post_id']); ?></td>
                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                    <td><?php echo htmlspecialchars($post['content']); ?></td>
                    <td>
                        <?php if (!empty($post['image_url'])) : ?>
                            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="Image du post" width="100" height="auto">
                        <?php else : ?>
                            Aucune image
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="/TFG/admin/admin_view_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                        <a href="/TFG/admin/admin_update_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-warning fw-bold">Modifier</a>
                        <a href="/TFG/controllers/admin_delete_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-danger fw-bold">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
