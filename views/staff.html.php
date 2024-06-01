<!-- Contenu MEMBRE et STAFF -->
<!------------------------------------------------------------------------------------------------------------------------------------>
<div class="downStaff bg-grey text-white" id="staffSection">
    <div class="row row-cols-1 row-cols-md-2 row-clos-lg-2 text-center g-0 bg-grey p-1" id="staffSection">
        <div class="col align-self-center text-end m-0 text-white order-2 order-sm-2 order-md-1">
            <h1 class="fs-4">Staff & Membres</h1>
            <p class="fs-6">Présentation du personnel "STAFF & MEMBRES", leurs rôles, leurs importances, ainsi que
                la spécialité de chacun.</p>
        </div>
        <div class="col order-1 order-sm-1 order-md-2">
            <img class="p-0 m-0 b-0 g-0" width="40%" height="auto" src="assets/images/img-member.png" alt="image pour la section membres et staff">
        </div>
    </div>
    <div class="text-center p-2">
        <i class="bi bi-chevron-double-down" id="showMoreStaff">VOIR PLUS...</i>
    </div>
</div>

<div id="hiddenStaff" class="text-center bg-grey text-white" style="display: none;">
    <div class="text-center">
        <img class="p-0 m-0 b-0 g-0" width="23%" height="auto" src="assets/images/img-member.png" alt="image pour la section membre et staff">
    </div>
    <h1>Explorez la Galerie des Membres du Staff de la TF - True Fighters Gaming</h1>
    <p>Dans cette section dédiée, plongez au cœur de la communauté True Fighters Gaming (TF) et découvrez les
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
        <div class="row d-flex justify-content-evenly">

            <?php
            $members = viewMembers($bdd);
            if ($members) {
                foreach ($members as $member) {
            ?>

                    <div class="col-md-4" width="50px" height="auto">
                        <!-- Afficher l'image du membre -->
                        <div width="50%" height="auto">
                            <img src="<?= $member['cover'] ?>" class="card-img-top" alt="Photo de <?= $member['username'] ?>">
                        </div>
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <!-- Afficher le nom du membre -->
                                <h5 class="card-title"><?= $member['username'] ?></h5>
                                <!-- Bouton pour afficher les détails du membre -->
                                <a href="member.html.php?id=<?= $member['member_id'] ?>" class="btn btn-primary">Détails du Membre</a>
                            </div>
                        </div>
                    </div>


            <?php }
            }; ?>

        </div>
    </div>
    <!-- Fin de la section pour afficher les membres -->

    <div class="text-center p-2">
        <i class="bi bi-chevron-double-up" id="showLessStaff">VOIR MOINS...</i>
    </div>
</div>