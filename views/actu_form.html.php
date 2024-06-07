<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 bg-grey border border-4 border-danger">
            <h1 id="formTitle" class="text-white"><?= isset($post) ? 'Modifier l\'actualité' : 'Ajouter une actualité' ?></h1>
            <form id="postForm" action="/TFG/controllers/post_form_handler.php<?= isset($post['post_id']) ? "?id={$post['post_id']}" : '' ?>" method="post">

                <div class="mb-3">
                    <label for="title" class="form-label text-white">Titre :</label><br>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="titre" value="<?= isset($post['title']) ? htmlspecialchars($post['title']) : '' ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-white">Contenu :</label><br>
                    <textarea name="content" class="form-control" id="content" rows="6" required><?= isset($post['content']) ? htmlspecialchars($post['content']) : '' ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white" for="image_url">URL de l'image :</label><br>
                    <input type="text" class="form-control" id="image_url" name="image_url" value="<?= isset($post['image_url']) ? htmlspecialchars($post['image_url']) : '' ?>"><br>
                </div>

                <input type="submit" value="<?= isset($post['post_id']) ? "Modifier l'actualité" : "Ajouter l'actualité" ?>" class="p-3">
            </form>
        </div>
    </div>
</div>