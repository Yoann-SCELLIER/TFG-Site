<!-- Contenu MEMBRE et STAFF -->
<!------------------------------------------------------------------------------------------------------------------------------------>
<div class="downStaff bg-grey text-white" id="staffSection">
    <div class="row row-cols-1 row-cols-md-2 row-clos-lg-2 text-center g-0 bg-grey p-1" id="staffSection">
        <!-- Section d'introduction -->
        <div class="col align-self-center text-end m-0 text-white order-2 order-sm-2 order-md-1 p-3">
            <h1 class="fs-4">Staff & Membres</h1>
            <p class="fs-6">Présentation du personnel "STAFF & MEMBRES", leurs rôles, leurs importances, ainsi que
                la spécialité de chacun.</p>
        </div>
        <!-- Image illustrative -->
        <div class="col order-1 order-sm-1 order-md-2">
            <img class="p-0 m-0 b-0 g-0" width="40%" height="auto" src="assets/images/img-member.webp" alt="image pour la section membres et staff">
        </div>
    </div>
    <!-- Bouton pour voir plus de détails -->
    <div class="text-center p-2">
        <i class="bi bi-chevron-double-down" id="showMoreStaff">VOIR PLUS...</i>
    </div>
</div>

<!-- Section détaillée (initialement cachée) -->
<article id="hiddenStaff" class="text-center bg-grey text-white" style="display: none;">
    <!-- Illustration -->
    <div class="text-center">
        <img class="p-0 m-0 b-0 g-0" width="23%" height="auto" src="assets/images/img-member.webp" alt="image pour la section membre et staff">
    </div>
    <!-- Introduction détaillée -->
         <h1>Explorez la Galerie des Membres du Staff de la TF - True Fighters Gaming</h1>
         <p class="p-4">Dans cette section dédiée, plongez au cœur de la communauté True Fighters Gaming (TF) et découvrez les
             visages derrière cette passionnante aventure vidéoludique.<br>
             Chaque membre de la TF apporte sa propre touche à notre communauté dynamique, enrichissant notre expérience
             de jeu et renforçant nos liens d'amitié.<br>
             Parcourez nos profils pour en apprendre davantage sur nos membres, leurs passions, leurs réalisations et
             leurs contributions à l'univers TF.<br>
             <br>
             Que vous soyez un joueur chevronné, un novice passionné ou simplement curieux de découvrir de nouvelles
             personnes, vous trouverez ici une galerie<br>
             vivante et inspirante de passionnés de jeux vidéo.<br>
             Rejoignez-nous dans cette aventure collective et faites partie de notre famille TF dès aujourd'hui !
         </p>
    <div>
        <hr class="border border-1 border-black">
    </div>

    <!-- Début de la section pour afficher les membres -->
    <div class="container">
        <!-- Section pour les membres officiels (incluant admin) -->
        <h2>Membres Officiels</h2>
        <div class="row d-flex justify-content-evenly">
            <?php
            $members = viewMembers($bdd);
            if ($members) {
                foreach ($members as $member) {
                    if ($member['role_member'] === 'memberAdmin' || $member['role_member'] === 'memberOfficial') {
            ?>
                        <div class="col-md-4" style="width: 310px;">
                            <!-- Afficher l'image du membre -->
                            <div class=" border border-2 border-warning d-flex align-items-center bg-white" style="width: 100%; height: 282px;">
                                <img src="<?= htmlspecialchars($member['cover']) ?>" class="card-img-top" alt="Photo de <?= htmlspecialchars($member['username']) ?>" style="width: 100%; height: auto;">
                            </div>
                            <div class="card mb-4 shadow-sm border border-2 border-warning">
                                <div class="card-body">
                                    <!-- Afficher le nom du membre -->
                                    <h5 class="card-title"><?= htmlspecialchars($member['username']) ?></h5>
                                    <!-- Bouton pour afficher les détails du membre -->
                                    <a href="member.php?id=<?= $member['member_id'] ?>" class="btn btn-primary">Détails du Membre</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>

        <!-- Section pour les membres invités -->
        <h2>Membres Invités</h2>
        <div class="row d-flex justify-content-evenly">
            <?php
            if ($members) {
                foreach ($members as $member) {
                    if ($member['role_member'] === 'memberGuest') {
            ?>
                        <div class="col-md-4" style="width: 310px;">
                            <!-- Afficher l'image du membre -->
                            <div class=" border border-2 border-primary d-flex align-items-center bg-white" style="width: 100%; height: 282px;">
                                <img src="<?= htmlspecialchars($member['cover']) ?>" class="card-img-top" alt="Photo de <?= htmlspecialchars($member['username']) ?>" style="width: 100%; height: auto;">
                            </div>
                            <div class="card mb-4 shadow-sm border border-2 border-primary">
                                <div class="card-body">
                                    <!-- Afficher le nom du membre -->
                                    <h5 class="card-title"><?= htmlspecialchars($member['username']) ?></h5>
                                    <!-- Bouton pour afficher les détails du membre -->
                                    <a href="member.php?id=<?= $member['member_id'] ?>" class="btn btn-primary">Détails du Membre</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <!-- Fin de la section pour afficher les membres -->

    <!-- Bouton pour voir moins -->
    <div class="text-center p-2">
        <i class="bi bi-chevron-double-up" id="showLessStaff">VOIR MOINS...</i>
    </div>
</article>
