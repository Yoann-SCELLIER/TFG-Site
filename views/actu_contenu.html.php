<!-- PAGE ACTUALITÉ -->
<!------------------------------------------------------------------------------------------------------------------------------------>

<div class="text-center">
    <div>
        <h1>ACTUALITÉS</h1>
    </div>
    <div>
        <p>Bienvenue dans la section Actualités de True Fighters Gaming ! <br>
            Ici, vous trouverez les dernières informations et mises à jour sur tout ce qui se passe dans notre communauté dynamique. <br>
            Que ce soit les résultats de nos récents tournois, les annonces de nouveaux jeux et extensions, ou les présentations de nos nouveaux membres, cette rubrique est votre source principale pour rester informé. <br>
            Ne manquez pas nos reportages exclusifs sur les événements à venir, les analyses de gameplay, et les interviews avec les joueurs et développeurs. <br>
            True Fighters Gaming est plus qu'une association, c'est une famille passionnée par l'esport et les jeux vidéo. <br>
            Restez connectés pour ne rien rater de l'actualité brûlante de la TF - True Fighters Gaming !</p>
    </div>
    <hr class="border-2">
    <!-- Bouton pour ajouter une actualité -->
    <a href="/tfg/actu_formu.html.php" class="btn btn-primary">Ajouter une actualité</a>
</div>

<!-- Affichage des actualités -->
<div class="text-center">
    <div>
        <h1>ACTUALITÉS</h1>
    </div>
</div>

<article class="text-center">

    <!-- Affichage des posts -->
    <div class="row row-cols-1 row-cols-sm-3 row-cols-md-5 m-5 g-4 d-flex justify-content-evenly">

        <?php
        $posts = viewPost($bdd);
        if ($posts) {
            foreach ($posts as $post) {
        ?>

                <div class="col">
                    <div class="card border-2">
                        <img src="<?php echo $post['image_url'] ?>" class="card-img-top p-5" alt="Image <?= $post['title'] ?>">
                        <div class="card-body">
                            <hr>
                            <h5 class="card-title"><?= $post['title'] ?></h5>
                            <p class="card-text"><?= $post['content'] ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary"><?= $post['created_at'] ?></small>
                            <small class="text-body-secondary"><?= $post['modif_at'] ?></small>
                        </div>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="actu_formu.html.php?id=<?= $post['post_id'] ?>" class="btn btn-warning">Détail</a>
%                        </div>
                    </div>
                </div>

        <?php
            }
        };
        ?>

    </div>

</article>
