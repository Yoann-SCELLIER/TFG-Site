<?php
// Dans votre fichier de vue où vous affichez les articles

// Récupération des posts depuis la base de données
$posts = viewsPost($bdd);

// Vérifier si des articles sont disponibles
if ($posts) {
    foreach ($posts as $post) {
        // Convertir la date au format timestamp
        $timestamp = strtotime($post['created_at']);
        
        // Formater la date en jour-mois-année
        $dateFormatted = date('d-m-Y', $timestamp);
?>

    <div class="col p-1">
        <div class="card border-2 m-5">
            <img src="<?= $post['image_url'] ?>" class="card-img-top p-5" alt="Image <?= $post['title'] ?>">
            <div class="card-body text-center">
                <h5 class="card-title"><?= $post['title'] ?></h5>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $post['content'] ?></p>
                <div class="d-flex justify-content-end">
                    <p><small class="text-body-secondary"><?= $post['username'] ?></small></p>
                </div>
            </div>
            <div class="card-footer text-center">
                <p>Créé le : <small class="text-body-secondary"><?= $dateFormatted ?></small></p>
                <?php if (!empty($post['modif_at'])) : ?>
                    <?php
                    // Convertir la date de modification au format timestamp
                    $modTimestamp = strtotime($post['modif_at']);
                    // Formater la date de modification en jour-mois-année
                    $modDateFormatted = date('d-m-Y', $modTimestamp);
                    ?>
                    <p>Modifié le : <small class="text-body-secondary"><?= $modDateFormatted ?></small></p>
                <?php endif; ?>
                <div class="d-flex align-items-center justify-content-center text-center">
                    <!-- Boutons d'action -->
                    <?php
                    $_GET['post_id'] = $post['post_id'];
                    include dirname(__DIR__) . '/controllers/controller_button_card_actu.php';
                    ?>
                    <!-- Bouton de retour à la liste des articles -->
                    <div class="d-flex text-end justify-content-end m-3">
                        <a href="/TFG/actualite.php" class="btn btn-secondary">Retour à la liste des articles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    }
} else {
    // Afficher un message si aucun article n'est trouvé
    echo "Aucun article trouvé.";
}
?>
