<?php
function displayHeader()
{
    echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bénévolat</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
        <img src="./assets/logo-grenoble.png" class="img-link">
            <h1 class="site-title">Bénévolat</h1>
            <nav class="site-nav">
                <div class="burger-menu">
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                </div>
                <ul class="nav-links">
                    <li><a href="./index.php">Accueil</a></li>
                    <li><a href="./benevole_Accueil.php">Bénévole</a></li>
                    <li><a href="./admin_Login.php">Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
    ';
}
?>