<?php
// --- INITIALISATION DE L'APPLICATION ---

// 1. CHARGEMENT DE LA CONFIGURATION
// On inclut le fichier de configuration de la base de données.
// `require_once` s'assure que le fichier est inclus une seule fois, évitant les erreurs.
// Ce fichier contient les constantes (DB_HOST, DB, etc.) nécessaires pour la connexion.
require_once '../config/database.php';

// 2. CONNEXION À LA BASE DE DONNÉES
// On crée une nouvelle instance de la classe PDO (PHP Data Objects).
// PDO est une interface d'abstraction qui permet de communiquer avec différents types de bases de données (MySQL, PostgreSQL, etc.)
// de manière unifiée et sécurisée (notamment grâce aux requêtes préparées).
// On passe à PDO les informations de connexion (DSN, utilisateur, mot de passe) récupérées depuis les constantes.
$database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB, DB_USER, DB_PASSWORD);

// --- ROUTAGE ---
// Le routeur est le mécanisme qui analyse l'URL demandée par l'utilisateur
// pour décider quel contrôleur et quelle méthode appeler.

// 3. ANALYSE DE L'URL
// `$_SERVER['REQUEST_URI']` contient l'URL demandée après le nom de domaine (ex: "/add?id=123").
// On utilise `explode("?", ...)` pour séparer la partie "chemin" de l'URL (avant le "?")
// de la partie "paramètres" (après le "?"). On ne s'intéresse qu'au chemin ici, qui est dans `$request_uri[0]`.
$request_uri = explode("?", $_SERVER['REQUEST_URI']);

// 4. CHARGEMENT DU CONTRÔLEUR
// On inclut le fichier du contrôleur qui va gérer la logique pour les articles.
require_once '../app/controllers/ArticleController.php';

// 5. INSTANCIATION DU CONTRÔLEUR
// On crée un objet `ArticleController`. On lui passe l'objet de connexion à la base de données (`$database`).
// C'est un principe important appelé "Injection de Dépendances" : le contrôleur a besoin de la base de données pour fonctionner,
// donc on la lui "injecte" lors de sa création.
$controller = new ArticleController($database);

// 6. DISPATCH (AIGUILLAGE)
// Le `switch` agit comme notre routeur. Il examine le chemin de l'URL (`$request_uri[0]`)
// et exécute le code correspondant.
switch($request_uri[0]) {
    case "/delete":
        // Si l'URL est "/delete", on appelle la méthode `deleteArticle` du contrôleur.
        // On lui passe l'ID de l'article à supprimer, récupéré depuis les paramètres de l'URL (`$_GET['id_article']`).
        $controller->deleteArticle($_GET['id_article']);
        break;

    case "/add";
        // Si l'URL est "/add", on appelle la méthode `addArticle`.
        // On lui passe le titre et le contenu du nouvel article, récupérés depuis les données du formulaire envoyé en POST (`$_POST`).
        $controller->addArticle($_POST['articleTitre'], $_POST['articleContenu'], $_FILES['photo_intro']);
        break;

    case "/form":
        // Si l'URL est "/form", on affiche simplement la vue contenant le formulaire d'ajout.
        $controller->aficherFormulaire();
        break;
    default:
        // Pour toutes les autres URL (y compris la racine "/"), on exécute le comportement par défaut.
        // On appelle la méthode `AfficherIndex` pour afficher la page d'accueil avec la liste des articles.
        $controller->AfficherIndex();
        break;
}
