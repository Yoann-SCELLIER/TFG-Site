<?php
require_once dirname(__DIR__) . '\TFG\controller\db.fn.php';
require_once dirname(__DIR__) . '\TFG\components\header.html.php';
require_once dirname(__DIR__) . '\TFG\controllers\views_actu.php';
require_once dirname(__DIR__) . '\TFG\controllers\post_form_handler.php';
?>

<div class="container text-center">
    <div class="row align-items-center p-5">
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 bg-grey border border-4 border-danger">
            <h1 id="formTitle" class="text-white"><?= htmlspecialchars($formTitle) ?></h1>
            <form id="postForm" action="<?= htmlspecialchars($action) ?>" method="post">

                <div class="mb-3">
                    <label for="titre" class="form-label text-white">Titre :</label><br>
                    <input type="text" name="titre" class="form-control" id="titre" aria-describedby="titre" value="<?= htmlspecialchars($titre) ?>" required><br>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label text-white">Contenu :</label><br>
                    <textarea name="contenu" class="form-control" id="contenu" rows="6" required><?= htmlspecialchars($contenu) ?></textarea><br>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white" for="image_url">URL de l'image :</label><br>
                    <input type="text" class="form-control" id="image_url" name="image_url" value="<?= htmlspecialchars($image_url) ?>"><br>
                </div>


                <input type="submit" value="<?= $id ? "Modifier l'actualité" : "Ajouter l'actualité" ?>" class="p-3">

                <?php if ($id) : ?>
                    <input type="submit" href="controllers/delete_post.php?id=<?= htmlspecialchars($id) ?>" class="p-3 bg-danger" value="Supprimer">
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<?php
require_once dirname(__DIR__) . '\TFG\components\footer.html.php';
?>