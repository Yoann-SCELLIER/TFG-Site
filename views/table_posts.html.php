<section class="container-fluid px-5">
    <h1 class="text-center p-5">Liste des actualités</h1>
    <div class="table-responsive text-center">
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Image</th>
                    <th>Créé le</th>
                    <th>M.A.J le</th>
                    <th>Username</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($post['post_id']); ?></td>
                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                    <td>
                        <?php if (!empty($post['image_url'])) : ?>
                            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="Image du post" width="100" height="auto">
                        <?php else : ?>
                            Aucune image
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></td>
                    <td><?php echo $post['modif_at'] !== null ? date('d/m/Y', strtotime($post['modif_at'])) : 'Aucune mise à jour à ce jour'; ?></td>
                    <td><?php echo htmlspecialchars($post['username']); ?></td>
                    <td class="text-center">
                        <a href="/TFG/admin/admin_view_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
