<?php

function navMemberOfficial() {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'utilisateur';
    ?>
    <nav class="navbar navbar-expand-lg bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand m-0 p-0 b-0 g-0" href="index.html.php">
                <img src="assets/images/logoV1.gif" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">ACCUEIL</a></li>
                    <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="index.php#storySection">STORY</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#staffSection">STAFF</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#gamingSection">GAMING</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="actualite.php">ACTUALITÉ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#" id="contactButton">CONTACT</a></li>
                    <div class="nav-item mx-3 rounded-1 align-items-center">
                        <ul  class="list-unstyled">
                            <li class="nav-item text-light">
                                <p class="mb-0" style="font-size: 8px;">WELCOME</p>
                                <p style="font-size: 13px;"><?php echo htmlspecialchars($username); ?></p>
                            </li>
                        </ul>
                        <hr class="m-0 p-0 b-0 g-0">
                        <ul  class="list-unstyled">
                            <li class="nav-item">
                                <a class="nav-link active m-0 p-0 b-0 g-0 text-light" href="/TFG/controllers/deconnexion_member.php" style="font-size: 13px;">DÉCONNEXION</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}


function navMemberGuest() {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'utilisateur';
    ?>
    <nav class="navbar navbar-expand-lg bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand m-0 p-0 b-0 g-0" href="index.php">
                <img src="assets/images/logoV1.gif" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">ACCUEIL</a></li>
                    <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="index.php#storySection">STORY</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#staffSection">STAFF</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#gamingSection">GAMING</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="actualite.php">ACTUALITÉ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#" id="contactButton">CONTACT</a></li>
                    <div class="nav-item mx-3 rounded-1 align-items-center">
                        <ul class="list-unstyled">
                            <li class="nav-item mx-3 rounded-1 text-light">
                                <p class="mb-0" style="font-size: 8px;">WELCOME</p>
                                <p style="font-size: 13px;"><?php echo htmlspecialchars($username); ?></p>
                            </li>
                        </ul>
                        <hr class="m-0 p-0 b-0 g-0">
                        <ul class="list-unstyled">
                            <li class="nav-item mx-3 rounded-1">
                                <a class="nav-link active m-0 p-0 b-0 g-0 text-light" href="/TFG/controllers/deconnexion_member.php" style="font-size: 13px;">DÉCONNEXION</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}

function navVisitor() {
    ?>
    <nav class="navbar navbar-expand-lg bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand m-0 p-0 b-0 g-0" href="index.php">
                <img src="assets/images/logoV1.gif" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">ACCUEIL</a></li>
                    <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="index.php#storySection">STORY</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#staffSection">STAFF</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#gamingSection">GAMING</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="actualite.php">ACTUALITÉ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#" id="contactButton">CONTACT</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/tfg/log.php">CONNEXION</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
}
