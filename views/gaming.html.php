<!-- Contenu GAMING -->
<div class="downGamingContent" id="gamingSection">
    <div class="row row-cols-1 row-cols-md-2 text-center g-0 p-1">
        <div class="col">
            <img class="p-0 m-0 b-0 g-0" width="40%" height="auto" src="assets/images/img-gaming.webp" alt="image pour la section gaming">
        </div>
        <div class="col row align-self-center text-start m-0">
            <h3 class="fs-4">Gaming et Tournois</h3>
            <p class="fs-6">Découvrez les différents types de jeux vidéo que vous pouvez rencontrer en tant que membre de la True Fighters (TF), ainsi que les tournois proposés par notre communauté.</p>
        </div>
    </div>
    <div class="text-center p-2">
        <i class="bi bi-chevron-double-down" id="showMoreGaming">VOIR PLUS...</i> <!-- BOUTTON POUR FAIRE AFFICHER LE CONTENU -->
    </div>
</div>

<!-- CONTENU CACHÉ -->
<div id="hiddenGamingContent" class="text-center" style="display: none;">

    <div class="text-center">
        <div class="row row-cols-1 row-cols-md-2 text-center g-0 p-1" background-size="10%">
            <div class="col align-self-center text-end order-2 order-sm-2 order-md-2 order-lg-2">
                <div class="col row align-self-center text-start m-0">
                    <h3 class="fs-4">Gaming</h3>
                    <p class="fs-6">Liste des jeux où vous pouvez nous rejoindre.</p>
                </div>
            </div>
            <div class="col order-1 order-sm-1 order-md-1 order-lg-1">
                <img class="" width="40%" height="auto" src="assets/images/img-gaming.webp" alt="image pour la section gaming">
            </div>
        </div>
        <hr class="border-1 text-dark m-0">
        <div class="container p-3">
            <div class="row d-flex justify-content-evenly">
                <?php foreach ($games as $game) : ?>
                    <div class="col-md-4 d-flex flex-column align-items-center" style="width: 280px;">
                        <!-- Afficher l'image du jeu -->
                        <div style="width: 60%; height: auto;">
                            <img src="<?= !empty($game['cover']) ? htmlspecialchars($game['cover']) : 
                            htmlspecialchars($game['image_url']) ?>" class="card-img-top h-auto" 
                            alt="<?= htmlspecialchars($game['title']) ?>">
                        </div>
                        <div class="card mb-4 border border-0">
                            <div class="card-body">
                                <h4 class="card-title fs-6 m-0"><?= htmlspecialchars($game['title']) ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="text-center bg-grey text-white">
        <h5>Esport</h5>
        <p>Les tournois proposés par la True Fighters (TF).</p>
        <hr class="border-1 text-light m-0">
        <div class="container">
            <div class="row d-flex justify-content-evenly">
                <div class="col-md-4 d-flex flex-column align-items-center" style="width: 400px;">
                    <img src="assets\images\logo-tournament.webp" class="card-img-top h-auto" alt="Logo tournois Guilty Gear -STRIVE-">
                    <div class="card mb-4 border border-0 bg-transparent">
                        <div class="card-body bg-transparent p-0 m-0 b-0 g-0">
                            <h6 class="card-title fs-6 text-white">Tournament Guilty Gear -STRIVE- True Fighters</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-2">
            <i class="bi bi-chevron-double-up" id="showLessGaming">VOIR MOINS...</i> <!-- BOUTON QUI CACHE LE CONTENU ET AFFICHE LA PREMIÈRE PARTIE -->
        </div>
    </div>
</div>
