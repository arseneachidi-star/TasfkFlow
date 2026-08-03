<?php
/*
 * Fichier : config/database.php
 * Rôle : Centraliser la connexion à la base de données en utilisant l'extension PDO.
 * Pourquoi ? Évite de répéter le code de connexion dans chaque modèle et garantit 
 * une configuration unique .
 */

class Database {
    // Propriété statique pour stocker l'instance unique de connexion (Pattern Singleton simplifié)
    private static $instance = null;

    /*
     * Méthode pour obtenir ou créer la connexion PDO
     * @return PDO Instance de la connexion à la base de données
     */
    public static function getConnection() {
        // Vérifie si la connexion n'a pas déjà été créée pour éviter d'ouvrir plusieurs connexions par requête
        if (self::$instance === null) {
            $host = 'localhost';
            $db_name = 'conceptic_taskflow'; // Nom de ma base de donnée
            $username = 'root';             
            $password = '';                  

            try {
                
                self::$instance = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password, [
                    // Nœud de sécurité 1 : Active les exceptions pour capturer proprement les erreurs SQL
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    
                    // Nœud de confort : Définit le mode de récupération par défaut sous forme de tableau associatif
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    
                    // Nœud de sécurité 2 : Désactive l'émulation des requêtes préparées pour forcer le SGBD à les traiter
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // En production, évitez d'afficher $e->getMessage() directement (risque de fuite d'infos sensibles)
                die("Erreur de connexion critique : " . $e->getMessage());
            }
        }
        
        return self::$instance;
    }
}