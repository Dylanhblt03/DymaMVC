<?php
include 'includes/header.inc.php';
?>
    <h1>Liste des Articles</h1>
    <!-- Section pour afficher la liste des articles existants -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php
        // La variable `$articles` a été définie dans le contrôleur (ArticleController::AfficherIndex)
        // avant d'inclure ce fichier de vue.
        // On parcourt ce tableau pour afficher chaque article.
        foreach($articles as $article) {
            ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if($article['photo_intro'] != NULL): ?>
                        <img src="<?= htmlspecialchars($article['photo_intro']) ?>" class="card-img-top" alt="Image pour l'article <?= htmlspecialchars($article['titre']) ?>">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?=htmlspecialchars($article['titre']); ?></h5>
                        <p class="card-text flex-grow-1"><?=htmlspecialchars($article['contenu']); ?></p>
                        <a href="/delete?id_article=<?= $article['id'] ?>" class="btn btn-sm btn-outline-primary mt-auto">Supprimer</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
<?php
include 'includes/footer.inc.php';
?>