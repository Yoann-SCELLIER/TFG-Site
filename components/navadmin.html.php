<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/TFG/assets/styles/style.css"> <!-- Utilisation d'un chemin absolu pour le CSS -->
    <title>TF - True Fighters Gaming</title>
</head>
<body>
<!-- Contenu NAVBAR -->
<header>
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
            <a class="navbar-brand m-0 p-0 b-0 g-0" href="/TFG/index.php"> <!-- Chemin absolu pour index.php -->
                <img src="/TFG/assets/images/logoV1.gif" alt="Logo" width="80" height="auto" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler navbar-dark border-2" type="button" data-bs-theme="dark" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-around align-items-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <h1>DASHBOARD ADMINISTRATEUR</h1>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/TFG/index.php">ACCUEIL</a> <!-- Chemin absolu pour index.php -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/TFG/actualite.php">ACTUALITÉ</a> <!-- Chemin absolu pour actualite.php -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/TFG/log.php">CONNEXION</a> <!-- Chemin absolu pour log.php -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Contenu principal -->
<main>
    <div class="bg-success-subtle">
