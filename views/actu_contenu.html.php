<div class="text-center">
    <!-- Titre et introduction de la section Actualités -->
    <h1 class="m-0">ACTUALITÉS</h1>
    <p class="p-4 m-0">Bienvenue dans la section Actualités de True Fighters Gaming ! <br>
        Ici, vous trouverez les dernières informations et mises à jour sur tout ce qui se passe dans notre communauté dynamique. <br>
        Que ce soit les résultats de nos récents tournois, les annonces de nouveaux jeux et extensions, ou les présentations de nos nouveaux membres, cette rubrique est votre source principale pour rester informé. <br>
        Ne manquez pas nos reportages exclusifs sur les événements à venir, les analyses de gameplay, et les interviews avec les joueurs et développeurs. <br>
        True Fighters Gaming est plus qu'une association, c'est une famille passionnée par l'esport et les jeux vidéo. <br>
        Restez connectés pour ne rien rater de l'actualité brûlante de la TF - True Fighters Gaming !</p>
    <hr class="border-2 m-0">

    <!-- Inclusion du contrôleur pour les boutons d'action -->
    <?php
    require_once dirname(__DIR__) . '/controllers/controller_button_actu.php';
    ?>
</div>

<!-- Affichage des actualités -->
<article class="text-center">
    <!-- Boucle pour afficher chaque post -->
    <div class="row row-cols-1 row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 m-5 g-4 d-flex justify-content-evenly">
        <?php
        // Récupération des posts depuis la base de données
        $posts = viewsPost($bdd);
        if ($posts) {
            foreach ($posts as $post) {
        ?>
                <div class="col m-1 d-flex justify-content-center">
                    <div class="card border-2 fixed-size-card" style="height: 450px;">
                        <!-- Affichage de l'image associée au post -->
                        <div style="height: 50rem;" class="d-flex align-items-center border-bottom border-2">
                            <img src="<?php echo $post['image_url'] ?>" class="card-img-top p-1" alt="Image <?= $post['title'] ?>">
                        </div>
                        <h5 class="card-title m-0 p-0 b-0 g-0"><?= htmlspecialchars($post['title']) ?></h5>
                        <div class="card-body">
                            <!-- Contenu de la carte avec système de défilement -->
                            <p class="card-text" style="max-height: 200px; width: 280px; overflow-y: auto;">
                                <?= nl2br(htmlspecialchars($post['content'])) ?>
                            </p>
                        </div>


                        <div class="card-footer m-0 p-0 b-0 g-0">
                            <!-- Affichage des dates de création et de modification du post -->
                            <small class="text-body-secondary m-0 p-0 b-0 g-0"><?= $post['created_at_fr'] ?></small><br>
                            <small class="text-body-secondary m-0 p-0 b-0 g-0"><?= $post['modif_at_fr'] ?></small>
                        </div>
                        <!-- Bouton de détail du post redirigeant vers actu_read.php avec l'ID du post -->
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="actu_read.php?id=<?= $post['post_id'] ?>" class="btn btn-warning">Détail</a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            // Message affiché en cas d'absence de posts
            header('Location: /TFG/404.php');
        }
        ?>
    </div>
</article>