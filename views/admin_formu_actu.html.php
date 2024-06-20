<?php
// Vérifier si $member_id est défini dans la session
if (isset($_SESSION['member_id'])) {
    $member_id = $_SESSION['member_id'];
} else {
    // Gérer le cas où $member_id n'est pas défini
    // Vous pouvez rediriger l'utilisateur vers une page de connexion ou afficher un message d'erreur
    header('Location: /TFG/404.php');
}
?>

<div class="container text-center">
    <!-- Conteneur principal centré verticalement -->
    <div class="row align-items-center p-5"> 
        <!-- Ligne avec alignement vertical des éléments et marge interne de 5 -->
        <div class="col m-2 b-0 p-0 g-0 border border-1 p-5 border border-4 border-danger">
            <!-- Colonne avec marges et bordures définies -->
            <h1 id="formTitle"><?= isset($post) ? 'Modifier l\'actualité' : 'Ajouter une actualité' ?></h1>
            <!-- Titre du formulaire, dynamiquement affiché en fonction de l'existence de $post -->
            <form id="postForm" action="/TFG/controllers/admin_form_post.php<?= isset($post['post_id']) ? "?id={$post['post_id']}" : '' ?>" method="post">
                <!-- Formulaire POST vers le contrôleur, avec l'ID du post si existant -->

                <div class="mb-3">
                    <!-- Champ pour le titre -->
                    <label for="title" class="form-label">Titre :</label><br>
                    <input type="text" name="title" class="form-control border border-2 border-dark" 
                    id="title" aria-describedby="titre" value="<?= isset($post['title']) ? htmlspecialchars($post['title']) : '' ?>" required><br>
                    <!-- Champ de saisie avec valeur pré-remplie si $post existe -->
                </div>
                <div class="mb-3">
                    <!-- Champ pour le contenu -->
                    <label for="content" class="form-label">Contenu :</label><br>
                    <textarea name="content" class="form-control border border-2 border-dark" 
                    id="content" rows="6" required><?= isset($post['content']) ? htmlspecialchars($post['content']) : '' ?></textarea><br>
                    <!-- Zone de texte avec contenu pré-rempli si $post existe -->
                </div>
                <div class="mb-3">
                    <!-- Champ pour l'URL de l'image -->
                    <label class="form-label" for="image_url">URL de l'image :</label><br>
                    <input type="text" class="form-control border border-2 border-dark" 
                    id="image_url" name="image_url" value="<?= isset($post['image_url']) ? htmlspecialchars($post['image_url']) : '' ?>"><br>
                    <!-- Champ de saisie pour l'URL de l'image avec valeur pré-remplie si $post existe -->
                </div>

                <!-- Champ caché pour conserver post_id -->
                <input type="hidden" name="post_id" value="<?= isset($post['post_id']) ? $post['post_id'] : '' ?>">
                <!-- Champ caché pour conserver member_id (session) -->
                <input type="hidden" name="member_id" value="<?= isset($_SESSION['member_id']) ? $_SESSION['member_id'] : '' ?>">

                <!-- Bouton de soumission du formulaire -->
                <input type="submit" value="<?= isset($post['post_id']) ? "Modifier l'actualité" : "Ajouter une actualité" ?>" class="btn btn-primary p-3 border border-1 border-dark">
                <!-- Texte du bouton dynamiquement modifié en fonction de l'existence de $post -->
            </form> 
        </div>
    </div>
</div>
