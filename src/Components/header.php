<?php
function displayHeader()
{
    echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctolib</title>
    <link rel="stylesheet" href="' . SRC_URL . 'Styles/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
            <h1 class="site-title">Doctolib</h1>
            <nav class="site-nav">
                <div class="burger-menu">
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                    <div class="burger-line"></div>
                </div>
                <ul class="nav-links">
                    <li><a href="' . URL_HOMEPAGE . '">Accueil</a></li>
                    <li><a href="' . URL_PROFILE . '">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
    ';
}
?>
