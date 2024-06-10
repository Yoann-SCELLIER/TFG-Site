<?php

function navMemberOfficial()
{
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = "utilisateur";
    }
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
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.html.php#storySection">STORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php#staffSection">STAFF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php#gamingSection">GAMING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="actualite.html.php">ACTUALITÉ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" id="contactButton">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <p class="mb-0" style="font-size: 8px;">WELCOME</p>
                        <p style="font-size: 13px;"><?php echo $username ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function navMemberInvite()
{
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = "utilisateur";
    }
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
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.html.php#storySection">STORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php#staffSection">STAFF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php#gamingSection">GAMING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="actualite.html.php">ACTUALITÉ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" id="contactButton">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><?php echo $username; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}

function navAdmin()
{
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = "utilisateur";
    }
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
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.html.php#storySection">STORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php#staffSection">STAFF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.html.php#gamingSection">GAMING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="actualite.html.php">ACTUALITÉ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" id="contactButton">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><?php echo $username; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php
}
