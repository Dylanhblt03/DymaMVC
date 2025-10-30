<?php

// Le contrôleur a besoin du modèle pour interagir avec la base de données.
// On inclut donc le fichier correspondant au modèle 'Article'.
require_once '../app/models/Article.php';

/**
 * Classe ArticleController
 * Rôle : Gérer la logique métier concernant les articles.
 * Il fait le lien entre les actions de l'utilisateur, la récupération des données (via le Modèle)
 * et l'affichage des résultats (via la Vue).
 */
class ArticleController {
    // Propriété privée pour stocker l'instance du modèle Article.
    private $articleModel;

    /**
     * Constructeur de la classe.
     * Est appelé automatiquement lors de la création d'un objet ArticleController (dans index.php).
     * @param PDO $database - L'objet de connexion à la base de données.
     */
    public function __construct($database) {
        // On crée une nouvelle instance du modèle 'Article'.
        $this->articleModel = new Article();
        // On passe la connexion à la base de données au modèle.
        // C'est une forme d'injection de dépendances : le contrôleur fournit au modèle ce dont il a besoin.
        $this->articleModel-> setDb($database);
    }

    /**
     * Méthode pour afficher la page d'accueil (liste des articles).
     */
    public function AfficherIndex() {
        // 1. Demander les données au modèle.
        $articles = $this->articleModel->getAllArticles();
        // 2. Inclure la vue. La vue aura accès à la variable `$articles`
        // pour afficher les données.
        $meta_title = "Accueil";
        require '../app/views/articleListe.php';
    }

    /**
     * Méthode pour ajouter un nouvel article.
     */
    public function addArticle($articleTitre, $articleContenu, $articlePhotoIntro) {
        // On demande au modèle d'insérer le nouvel article en base de données.
        // On verifie si le fichier uplodé est bien une image
        // En testant si sont type Mime commence par image
        if (substr($articlePhotoIntro['type'], 0, 6) == "image/") {
            // Cas ou l'on a bien uplodé une image
            //On copie le fichier depuis la memoire du serveur
            //vers un emplacement physique
            move_uploaded_file($articlePhotoIntro['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/images/" . $articlePhotoIntro['name']);
            //Puis on recupere son nom pour construire le chemin vers ce fichier
            $cheminDefinitif =  "/images/" . $articlePhotoIntro['name'];
        } else {
            // Cas ou l'on a uplodé autre autre chose qu'une image, ou alors rien du tout 
            $cheminDefinitif = NULL;
        }
        $this->articleModel->requeteInsertArticle($articleTitre, $articleContenu, $cheminDefinitif);
        // Une fois l'action terminée, on redirige l'utilisateur vers la page d'accueil.
        // C'est une bonne pratique pour éviter de pouvoir renvoyer le même formulaire plusieurs fois en rafraîchissant la page.
        header('Location: /');
    }

    /**
     * Méthode pour supprimer un article.
     */
    public function deleteArticle($articleId) {
        // On demande au modèle de supprimer l'article correspondant à l'ID fourni.
        $this->articleModel->requeteSupprimerArticle($articleId);
        // On redirige l'utilisateur vers la page d'accueil.
        header('Location: /');
    }

    public function aficherFormulaire() {
        $meta_title = "Nouvelle Publication";
        require '../app/views/articleForm.php';
    }
}