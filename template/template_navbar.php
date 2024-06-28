<?php

function navMemberOfficial()
{
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'utilisateur';
?>
    <nav class="navbar navbar-expand-lg bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="index.html.php">
                <img src="assets/images/logoV1.webp" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">ACCUEIL</a></li>
                    <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="index.php#storySection">STORY</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#staffSection">STAFF</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#gamingSection">GAMING</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="actualite.php">ACTUALITÉ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="mailto:true.fighters.gaming.contact@gmail.com">CONTACT</a></li>
                    <li class="nav-item row text-center text-light">
                        <p class="m-0" style="font-size: 8px;">WELCOME</p>
                        <p class="m-0" style="font-size: 13px;"><?php echo htmlspecialchars($username); ?></p>
                        <div>
                            <hr class="m-0">
                        </div>
                        <a class="nav-link active m-0 text-light" href="/TFG/controllers/deconnexion_member.php" style="font-size: 13px;">DÉCONNEXION</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function navMemberGuest()
{
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'utilisateur';
?>
    <nav class="navbar navbar-expand-lg bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="index.php">
                <img src="assets/images/logoV1.webp" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center m-1">
                    <li class="nav-item m-1"><a class="nav-link text-white" href="index.php">ACCUEIL</a></li>
                    <li class="nav-item m-1"><a class="nav-link active text-white" aria-current="page" href="index.php#storySection">STORY</a></li>
                    <li class="nav-item m-1"><a class="nav-link text-white" href="index.php#staffSection">STAFF</a></li>
                    <li class="nav-item m-1"><a class="nav-link text-white" href="index.php#gamingSection">GAMING</a></li>
                    <li class="nav-item m-1"><a class="nav-link text-white" href="actualite.php">ACTUALITÉ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="mailto:true.fighters.gaming.contact@gmail.com">CONTACT</a></li>
                    <li class="nav-item row text-center text-light">
                        <p class="m-0" style="font-size: 8px;">WELCOME</p>
                        <p class="m-0" style="font-size: 13px;"><?php echo htmlspecialchars($username); ?></p>
                        <div>
                            <hr class="m-0">
                        </div>
                        <a class="nav-link active m-0 text-light" href="/TFG/controllers/deconnexion_member.php" style="font-size: 13px;">DÉCONNEXION</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function navVisitor() 
{
?>
    <nav class="navbar navbar-expand-lg bg-grey">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="index.php">
                <img src="assets/images/logoV1.webp" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">ACCUEIL</a></li>
                    <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="index.php#storySection">STORY</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#staffSection">STAFF</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="index.php#gamingSection">GAMING</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="actualite.php">ACTUALITÉ</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="mailto:true.fighters.gaming.contact@gmail.com">CONTACT</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/tfg/log.php">CONNEXION</a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function navMemberAdmin()
{
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'utilisateur';
?>
    <header>
        <nav class="navbar navbar-expand-lg bg-success">
            <div class="container-fluid">
                <a class="navbar-brand m-0 p-1" href="/TFG/admin/dashboard.php">
                    <img src="/TFG/assets/images/logoV1.webp" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                    <h1 class="m-0">DASHBOARD ADMINISTRATEUR</h1>
                    <ul class="navbar-nav align-items-center m-1">
                        <li class="nav-item m-1"><a class="nav-link" href="/TFG/admin/dashboard.php">MEMBRE ET STAFF</a></li>
                        <li class="nav-item m-1"><a class="nav-link" href="/TFG/admin/admin_view_list_game.php">GAME</a></li>
                        <li class="nav-item m-1"><a class="nav-link" href="/TFG/admin/admin_view_list_actu.php">ACTUALITÉ</a></li>
                        <li class="nav-item row text-center">
                            <p class="m-0" style="font-size: 8px;">WELCOME</p>
                            <p class="m-0" style="font-size: 13px;"><?php echo htmlspecialchars($username); ?></p>
                            <div>
                                <hr class="m-0">
                            </div>
                            <a class="nav-link active m-0" href="/TFG/controllers/deconnexion_member.php" style="font-size: 13px;">DÉCONNEXION</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenu principal -->
    <main>
        <!-- Ajoutez ici le contenu principal spécifique à la page d'administration -->
<?php
}
