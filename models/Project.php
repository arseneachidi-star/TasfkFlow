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

    public function getByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

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

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function delete($id, $userId) {
        $stmt = $this->db->prepare("DELETE FROM projects WHERE id = :id AND user_id = :user_id");
        return $stmt->execute([
            'id' => $id,
            'user_id' => $userId
        ]);
    }
   // Cette méthode récupère désormais correctement tous les projets de la table 'projects'
    public function getAllProjects() {
        // Assurez-vous que le nom de la table dans la requête est bien 'projects' (ou le vôtre)
        $stmt = $this->db->query("SELECT id, title FROM projects"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}