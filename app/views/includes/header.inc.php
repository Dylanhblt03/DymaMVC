<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Blog Dyma MVC - <?= $meta_title ?></title>
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg shadow-lg">
            <div class="container">
                <!-- Élément N°1 -->
                <a href="/">
                    <img src="/images/blog.png" class="img-fluid"/>
                </a>
                <!-- Élément N°2 -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavBar" aria-controls="myNavBar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="myNavBar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Homepage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/form">Nouvelle publication</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container main-container">