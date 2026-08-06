<?php
/**
 * Fichier : models/User.php
 * Rôle : Gère les interactions avec la table users (inscription, authentification).
 */

require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        // Récupération de l'instance unique de connexion PDO
        $this->db = Database::getConnection();
    }

    /**
     * Inscrire un nouvel utilisateur avec hachage du mot de passe
     */
    public function register($username, $email, $password) {
        // Nœud de sécurité : hachage fort du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Requête préparée pour éviter les injections SQL
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        
        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }
       // Methode de vérification de rôle administrateur 

    public function getAllUsers() {
    $stmt = $this->db->query("SELECT id, username, email, role FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vérifier les identifiants de connexion
     */
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Vérification de l'existence de l'utilisateur et correspondance du mot de passe haché
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
}