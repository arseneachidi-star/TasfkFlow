<?php
/**
 * Fichier : models/Project.php
 * Rôle : Gère la logique de données des projets (CRUD) en lien avec la table projects.
 */

require_once __DIR__ . '/../config/database.php';

class Project {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Récupérer tous les projets d'un utilisateur spécifique
     */
    public function getByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Créer un nouveau projet
     */
    public function create($title, $description, $startDate, $endDate, $userId) {
        $stmt = $this->db->prepare("INSERT INTO projects (title, description, start_date, end_date, user_id) VALUES (:title, :description, :start_date, :end_date, :user_id)");
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'user_id' => $userId
        ]);
    }

    /**
     * Récupérer un projet par son ID
     */
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Supprimer un projet
     */
    public function delete($id, $userId) {
        // On s'assure que l'utilisateur supprime bien son propre projet
        $stmt = $this->db->prepare("DELETE FROM projects WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([
            'id' => $id,
            'user_id' => $userId
        ]);
    }
}