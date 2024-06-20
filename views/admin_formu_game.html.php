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
            <!-- Colonne avec marges, bordures et padding définis -->

            <!-- Titre du formulaire (utilisation de $formTitle) -->
            <h5 class="card-title"><?= htmlspecialchars($formTitle) ?></h5>

            <!-- Formulaire POST vers l'action définie dans $action -->
            <form id="gameForm" action="<?= $action ?>" method="post">

                <div class="mb-3">
                    <!-- Champ pour le titre -->
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" name="title" class="form-control border border-2 border-dark" id="title" value="<?= isset($title) ? htmlspecialchars($title) : '' ?>" required>
                    <!-- Champ de saisie avec valeur pré-remplie si $title existe -->
                </div>

                <div class="mb-3">
                    <!-- Champ pour le contenu -->
                    <label for="content" class="form-label">Contenu :</label>
                    <textarea name="content" class="form-control border border-2 border-dark" id="content" rows="6" required><?= isset($content) ? htmlspecialchars($content) : '' ?></textarea>
                    <!-- Zone de texte avec contenu pré-rempli si $content existe -->
                </div>

                <div class="mb-3">
                    <!-- Champ pour l'URL de l'image -->
                    <label class="form-label" for="image_url">URL de l'image :</label>
                    <input type="text" class="form-control border border-2 border-dark" id="image_url" name="image_url" value="<?= isset($image_url) ? htmlspecialchars($image_url) : '' ?>">
                    <!-- Champ de saisie pour l'URL de l'image avec valeur pré-remplie si $image_url existe -->
                </div>

                <!-- Bouton de soumission du formulaire -->
                <button type="submit" class="btn btn-primary border border-1 border-dark"><?= $game_id ? "Modifier le jeu" : "Ajouter le jeu" ?></button>
                <!-- Texte du bouton dynamiquement modifié en fonction de $game_id -->
            </form>
        </div>
    </div>
</div>
