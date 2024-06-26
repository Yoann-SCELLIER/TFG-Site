<!-- table_posts.html.php -->

<section class="container-fluid px-5">
    <!-- Titre principal -->
    <h1 class="text-center p-5">Liste des actualités</h1>
    <div class="table-responsive text-center">
        <!-- Tableau Bootstrap avec bordures -->
        <table class="table table-bordered border border-2 border-dark align-self-center">
            <thead>
                <!-- En-têtes de colonnes -->
                <tr>
                    <th class="m-0 b-0 p-0 g-0">ID</th>
                    <th class="m-0 b-0 p-0 g-0">Titre</th>
                    <th class="m-0 b-0 p-0 g-0">Image</th>
                    <th class="m-0 b-0 p-0 g-0">Créé le</th>
                    <th class="m-0 b-0 p-0 g-0">M.A.J le</th>
                    <th class="m-0 b-0 p-0 g-0">Username</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <!-- ID du post -->
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo htmlspecialchars($post['post_id']); ?></td>
                        <!-- Titre du post -->
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <!-- Image du post -->
                        <td>
                            <?php if (!empty($post['image_url'])) : ?>
                                <?php if (strpos($post['image_url'], 'http') === 0) : ?>
                                    <!-- Si l'URL commence par "http", c'est une URL externe -->
                                    <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="Image du post" width="100" height="auto">
                                <?php else : ?>
                                    <!-- Sinon, c'est une URL interne, ajout du chemin relatif -->
                                    <img src="/TFG/<?php echo htmlspecialchars($post['image_url']); ?>" alt="Image du post" width="100" height="auto">
                                <?php endif; ?>
                            <?php else : ?>
                                <!-- Image par défaut si aucune URL définie -->
                                <img src="/TFG/default-image.jpg" alt="Image par défaut" width="100" height="auto">
                            <?php endif; ?>
                        </td>
                        <!-- Date de création du post -->
                        <td class="m-0 b-0 p-0 g-0 fs-7"><?php echo date('d/m/Y', strtotime($post['created_at_fr'])); ?></td>
                        <!-- Date de dernière modification du post -->
                        <td class="m-0 b-0 p-0 g-0 fs-7">
                            <?php echo $post['modif_at_fr'] !== null ? date('d/m/Y', strtotime($post['modif_at_fr'])) : 'Aucune mise à jour à ce jour'; ?>
                        </td>
                        <!-- Nom d'utilisateur associé au post -->
                        <td><?php echo htmlspecialchars($post['username'] ?? 'Utilisateur inconnu'); ?></td>
                        <!-- Actions (lien pour voir les détails du post) -->
                        <td class="text-center">
                            <a href="/TFG/admin/admin_view_post.php?id=<?php echo $post['post_id']; ?>" class="btn btn-primary fw-bold">Détail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>