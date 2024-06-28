<footer class="bg-grey mt-3">
    <!-- Bouton "Revenir en haut" -->
    <button id="backToTopBtn" class="btn btn-primary" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">↑</button>

    <div class="row row-cols-1 row-cols-md-1 g-0 m-0 b-0 pt-3 justify-content-center">
        <div>
            <hr class="border border-1 border-black">
        </div>
        <div class="col d-flex text-center justify-content-center align-self-center p-2">
            <!-- Liens vers les partenaires -->
            <div>
                <a href="https://fr.jobs.game/entreprise-tf-true-fighters-gaming-20848/" target="_blank">
                    <img src="assets/images/JobGame.webp" alt="logo JobGame" width="30%" height="auto">
                </a>
            </div>
            <div>
                <a href="https://www.helloasso.com/associations/true-fighters-gaming" target="_blank">
                    <img src="assets/images/helloasso.webp" alt="logo HelloAsso" width="30%" height="auto">
                </a>
            </div>
            <div>
                <a href="https://www.facebook.com/True.Fighters.Gaming/" target="_blank">
                    <img src="assets/images/logo-fb.webp" alt="logo Facebook" width="30%" height="auto">
                </a>
            </div>
            <div>
                <a href="https://www.youtube.com/user/TFMultiGaming" target="_blank">
                    <img src="assets/images/YouTube.webp" alt="logo Youtube" width="30%" height="auto">
                </a>
            </div>
            <div>
                <a href="https://twitter.com/TFG_Officiel" target="_blank">
                    <img src="assets/images/Twitter.webp" alt="logo Twitter" width="30%" height="auto">
                </a>
            </div>
            <div>
                <a href="https://www.twitch.tv/akito_soma" target="_blank">
                    <img src="assets/images/twitch.webp" alt="logo Twitch" width="30%" height="auto">
                </a>
            </div>
        </div>
        <br>
        <div>
            <hr class="border border-1 border-black">
        </div>
        <br>
    </div>

    <div class="row cols-12 row-cols-1 row-cols-md-1 row-cols-lg-3 g-0 m-0 b-0 p-0 text-center align-self-center text-light">
        <!-- Section "Like & Follow" -->
        <div class="row col">
            <h5 class="fs-5">Like & Follow</h5>
            <ul>
                <!-- Liens vers les réseaux sociaux -->
                <li><a href="/tfg/404.php" class="text-reset">Facebook</a></li>
                <li><a href="/tfg/404.php" class="text-reset">YouTube</a></li>
                <li><a href="/tfg/404.php" class="text-reset">Twitter</a></li>
            </ul>
        </div>
        <!-- Section "Conditions" -->
        <div class="row col container">
            <h6 class="fs-5">Conditions</h6>
            <ul class="list-unstyled">
                <!-- Liens vers les conditions générales et autres -->
                <li><a class="text-reset" href="#" id="CGUButton" data-bs-toggle="modal" data-bs-target="#CGUModal">CGU</a></li>
                <li><a class="text-reset" href="#" id="AssocButton" data-bs-toggle="modal" data-bs-target="#popup-association">L'association</a></li>
                <li><a class="text-reset" href="#" id="TournamentButton" data-bs-toggle="modal" data-bs-target="#popup-tournois">Tournois</a></li>
            </ul>
        </div>
        <!-- Section "Logo et liens" -->
        <div class="row col">
            <a href="index.php">
                <img src="assets/images/tfg.webp" width="600rem" widht="auto" class="p-3 img-fluid" alt="image true fighters gaming">
            </a>
            <hr>
            <!-- Affichage conditionnel basé sur la session de l'utilisateur -->
            <?php if (isset($_SESSION['member_id'])) : ?>
                <!-- Lien vers la page de membre avec l'ID de l'utilisateur connecté -->
                <ul class="d-flex justify-content-center text-white" style="list-style-type:none;">
                    <li class="p-0 m-2"><a href="/tfg/member.php?id=<?= htmlspecialchars($_SESSION['member_id']) ?>" class="text-reset"><?= htmlspecialchars($_SESSION['username']) ?></a></li>
                    <li class="p-0 m-2"><a href="/tfg/controllers/deconnexion_member.php" class="text-reset">Déconnexion</a></li>
                </ul>
            <?php else : ?>
                <!-- Liens vers la connexion et l'inscription -->
                <ul class="d-flex justify-content-center text-white" style="list-style-type:none;">
                    <li class="p-0 m-2"><a href="/tfg/log.html.php" class="text-reset">Connexion</a></li>
                    <li class="p-0 m-2"><a href="/tfg/log.html.php" class="text-reset">Inscription</a></li>
                </ul>
            <?php endif; ?>
        </div>
        <!-- Mention de copyright -->
        <div class="text-center mt-4">
            <p> &#169; Copyright 2024 réservé à True Fighters Gaming</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="/tfg/assets/js/javascript.js"></script>
</body>

</html>