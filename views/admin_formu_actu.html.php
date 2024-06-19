<div class="container text-center">
    <div class="row align-items-center p-5"> 
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 border border-4 border-danger">
            <h1 id="formTitle"><?= isset($post) ? 'Modifier l\'actualité' : 'Ajouter une actualité' ?></h1>
            <form id="postForm" action="/TFG/controllers/admin_form_post.php<?= isset($post['post_id']) ? "?id={$post['post_id']}" : '' ?>" method="post">

                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label><br>
                    <input type="text" name="title" class="form-control border border-2 border-dark" id="title" aria-describedby="titre" value="<?= isset($post['title']) ? htmlspecialchars($post['title']) : '' ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu :</label><br>
                    <textarea name="content" class="form-control border border-2 border-dark" id="content" rows="6" required><?= isset($post['content']) ? htmlspecialchars($post['content']) : '' ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image_url">URL de l'image :</label><br>
                    <input type="text" class="form-control border border-2 border-dark" id="image_url" name="image_url" value="<?= isset($post['image_url']) ? htmlspecialchars($post['image_url']) : '' ?>"><br>
                </div>

                <!-- Champ caché pour conserver post_id -->
                <input type="hidden" name="post_id" value="<?= isset($post['post_id']) ? $post['post_id'] : '' ?>">
                <!-- Champ caché pour conserver member_id -->
                <input type="hidden" name="member_id" value="<?= isset($_SESSION['member_id']) ? $_SESSION['member_id'] : '' ?>">

                <input type="submit" value="<?= isset($post['post_id']) ? "Modifier l'actualité" : "Ajouter une actualité" ?>" class="btn btn-primary p-3 border border-1 border-dark">
            </form> 
        </div>
    </div>
</div>