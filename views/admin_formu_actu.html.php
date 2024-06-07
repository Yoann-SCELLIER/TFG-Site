<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 bg-grey border border-4 border-danger">
            <h1 id="formTitle" class="text-white"><?= isset($game_id) ? 'Modifier le jeu' : 'Ajouter un jeu' ?></h1>
            <form id="gameForm" action="<?= htmlspecialchars($action) ?>" method="post">

                <div class="mb-3">
                    <label for="title" class="form-label text-white">Titre :</label><br>
                    <input type="text" name="title" class="form-control" id="title" aria-describedby="titre" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-white">Contenu :</label><br>
                    <textarea name="content" class="form-control" id="content" rows="6" required><?= isset($content) ? htmlspecialchars($content) : '' ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white" for="cover">URL de l'image :</label><br>
                    <input type="text" class="form-control" id="cover" name="cover" value="<?= isset($cover) ? htmlspecialchars($cover) : '' ?>"><br>
                </div>

                <input type="submit" value="<?= isset($game_id) ? "Modifier le jeu" : "Ajouter le jeu" ?>" class="p-3">
            </form>
        </div>
    </div>
</div>
