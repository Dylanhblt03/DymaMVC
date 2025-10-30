<?php

/**
 * Classe Article (Modèle)
 * Rôle : Gérer toutes les interactions avec la table 'article' dans la base de données.
 * C'est la seule classe qui doit contenir des requêtes SQL concernant les articles.
 */
class Article {
    // Propriété qui stockera l'objet de connexion à la base de données (PDO).
    // `protected` signifie qu'elle est accessible par cette classe et les classes qui en héritent.
    protected $db;

    /**
     * Constructeur.
     * Pour l'instant, il est vide, mais il pourrait servir à initialiser des choses.
     */
    public function __construct() {
        
    }

    /**
     * Setter pour injecter la connexion à la base de données dans le modèle.
     * @param PDO $value - L'objet de connexion PDO.
     */
    public function setDb($value) {
        $this->db = $value;
    }

    /**
     * Récupère tous les articles de la base de données.
     * @return array - Un tableau associatif contenant tous les articles.
     */
    public function getAllArticles() {
        // On prépare une requête SQL. `prepare()` est plus sécurisé que `query()` car il protège contre les injections SQL.
        $stmt = $this->db->prepare('SELECT * FROM article ORDER BY id DESC');
        // On exécute la requête.
        $stmt->execute();
        // On récupère tous les résultats sous forme de tableau associatif (clé => valeur).
        // PDO::FETCH_ASSOC signifie que les lignes sont retournées comme des tableaux où les clés sont les noms des colonnes.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insère un nouvel article dans la base de données.
     * @param string $articleTitre - Le titre de l'article.
     * @param string $articleContenu - Le contenu de l'article.
     */
    public function requeteInsertArticle($articleTitre, $articleContenu, $articlePhotoIntro) {
        // On prépare la requête avec des "placeholders" nommés (ex: `:titre`).
        // C'est la base des requêtes préparées : la requête et les données sont envoyées séparément au serveur de BDD.
        $stmt = $this->db->prepare("INSERT INTO article (titre, contenu, photo_intro) VALUES (:titre, :contenu, :photo_intro)");
        // On lie les variables PHP aux placeholders de la requête.
        // Cela garantit que les données sont correctement "échappées" et sécurisées.
        $stmt->bindParam(':titre', $articleTitre);
        $stmt->bindParam(':contenu', $articleContenu);
        $stmt->bindParam(':photo_intro', $articlePhotoIntro);
        // On exécute la requête avec les données liées.
        $stmt->execute();
    }

    /**
     * Supprime un article de la base de données en fonction de son ID.
     * @param int $articleId - L'identifiant de l'article à supprimer.
     */
    public function requeteSupprimerArticle($articleId) {
        $stmt = $this->db->prepare("DELETE FROM article WHERE id = :id");
        $stmt->bindParam(':id', $articleId);
        $stmt->execute();
    }
}