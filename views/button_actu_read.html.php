<div class=" d-flex text-center justify-content-evenly">
    <div aria-label="Actions" class="text-center m-3">
        <a href="actu_formu.php?id=<?= $post['post_id'] ?>" class="btn btn-warning">Modifier l'article</a>
    </div>
    <?php if ($id) : ?>
        <div aria-label="Actions" class="text-center m-3">
            <form action="/TFG/controllers/delete_post.php" method="post" style="display: inline;">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <button type="submit" class="btn btn-danger">Supprimer l'article</button>
            </form>
        </div>
    <?php endif; ?>
</div>