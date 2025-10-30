<?php
/**
 * FICHIER DE CONFIGURATION DE LA BASE DE DONNÉES
 * 
 * Ce fichier contient les constantes de connexion à la base de données.
 * L'utilisation de define() permet de créer des constantes globales
 * accessibles partout dans l'application.
 */

// Définition de l'adresse IP ou du nom d'hôte du serveur de base de données
define('DB_HOST', '192.168.56.56');

// Définition du nom de la base de données à utiliser
define('DB', 'dymamvc');

// Définition du nom d'utilisateur pour se connecter à la base de données
define('DB_USER', 'homestead');

// Définition du mot de passe associé à l'utilisateur
define('DB_PASSWORD', 'secret');