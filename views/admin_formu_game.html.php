<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title"><?= htmlspecialchars($formTitle) ?></h5>
                </div>
                <div class="card-body">
                    <form id="gameForm" action="<?= $action ?>" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre :</label>
                            <input type="text" name="title" class="form-control" id="title" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu :</label>
                            <textarea name="content" class="form-control" id="content" rows="6" required><?= isset($content) ? htmlspecialchars($content) : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="cover">URL de l'image :</label>
                            <input type="text" class="form-control" id="cover" name="cover" value="<?= isset($cover) ? htmlspecialchars($cover) : '' ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><?= $game_id ? "Modifier le jeu" : "Ajouter le jeu" ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
