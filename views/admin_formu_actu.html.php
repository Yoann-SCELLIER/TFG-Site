<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 bg-grey border border-4 border-danger">
            <h1 id="formTitle" class="text-white"><?= htmlspecialchars($formTitle) ?></h1>
            <form id="postForm" action="<?= $action ?>" method="post">

                <div class="mb-3">
                    <label for="titre" class="form-label text-white">Titre :</label><br>
                    <input type="text" name="titre" class="form-control" id="titre" aria-describedby="titre" value="<?= isset($titre) ? htmlspecialchars($titre) : '' ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label text-white">Contenu :</label><br>
                    <textarea name="contenu" class="form-control" id="contenu" rows="6" required><?= isset($contenu) ? htmlspecialchars($contenu) : '' ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white" for="image_url">URL de l'image :</label><br>
                    <input type="text" class="form-control" id="image_url" name="image_url" value="<?= isset($image_url) ? htmlspecialchars($image_url) : '' ?>"><br>
                </div>

                <input type="submit" value="<?= $id ? "Modifier l'actualité" : "Ajouter l'actualité" ?>" class="p-3"><br>
                <button style="box-shadow: none;"><a href="\TFG\admin\dashboard.php" class="btn btn-success">Annuler</a></button>

            </form>
        </div>
    </div>
</div>