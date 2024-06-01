<?php
require_once dirname(__DIR__) . '\TFG\controller\db.fn.php';

require_once dirname(__DIR__) . '\TFG\components\header.html.php';

require_once dirname(__DIR__) . '\TFG\controllers\view_actu.php';

// Vérifier si un ID est présent dans l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
$post = null;

// Si un ID est présent, récupérer les informations du post pour modification
if ($id) {
    $post = getPostById($bdd, $id);
}

$formTitle = $id ? "Modifier le Post" : "Ajouter un Post";
$action = $id ? "update_post.php?id=" . $id : "add_post.php";
$titre = $post ? $post['title'] : '';
$contenu = $post ? $post['content'] : '';
$image_url = $post ? $post['image_url'] : '';
?>

<h1 id="formTitle"><?= $formTitle ?></h1>
<form id="postForm" action="<?= $action ?>" method="post">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($titre) ?>" required><br>

    <label for="contenu">Contenu :</label>
    <textarea id="contenu" name="contenu" required><?= htmlspecialchars($contenu) ?></textarea><br>

    <label for="image_url">URL de l'image :</label>
    <input type="text" id="image_url" name="image_url" value="<?= htmlspecialchars($image_url) ?>"><br>

    <input type="submit" value="<?= $id ? "Modifier le Post" : "Ajouter le Post" ?>">
</form>

<?php if ($id): ?>
    <a href="controllers/delete_post.php?id=<?= $id ?>" class="btn btn-danger">Supprimer</a>
<?php endif;

require_once dirname(__DIR__) . '\TFG\components\footer.html.php';

?> 