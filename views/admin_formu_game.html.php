<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 border border-4 border-danger">
            <h5 class="card-title"><?= htmlspecialchars($formTitle) ?></h5>
            <form id="gameForm" action="<?= $action ?>" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" name="title" class="form-control border border-2 border-dark" id="title" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu :</label>
                    <textarea name="content" class="form-control border border-2 border-dark" id="content" rows="6" required><?= isset($content) ? htmlspecialchars($content) : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="image_url">URL de l'image :</label>
                    <input type="text" class="form-control border border-2 border-dark" id="image_url" name="image_url" value="<?= isset($image_url) ? htmlspecialchars($image_url) : '' ?>">
                </div>
                <button type="submit"  class="btn btn-primary border border-1 border-dark"><?= $game_id ? "Modifier le jeu" : "Ajouter le jeu" ?></button>
            </form>
        </div>
    </div>
</div>