<?php
/**
 * Fichier : models/Task.php
 * Rôle : Gère la logique de données des tâches (CRUD et statuts) en lien avec la table tasks.
 */

require_once __DIR__ . '/../config/database.php';

class Task {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Récupérer toutes les tâches d'un projet spécifique
     */
    public function getByProject($projectId) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE project_id = :project_id ORDER BY created_at DESC");
        $stmt->execute(['project_id' => $projectId]);
        return $stmt->fetchAll();
    }

    /**
     * Créer une nouvelle tâche
     */
    public function create($title, $description, $status, $priority, $projectId, $userId) {
        $stmt = $this->db->prepare("INSERT INTO tasks (title, description, status, priority, project_id, user_id) VALUES (:title, :description, :status, :priority, :project_id, :user_id)");
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'priority' => $priority,
            'project_id' => $projectId,
            'user_id' => $userId
        ]);
    }

    /**
     * Mettre à jour le statut d'une tâche
     */
    public function updateStatus($taskId, $status) {
        $stmt = $this->db->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        return $stmt->execute([
            'status' => $status,
            'id' => $taskId
        ]);
    }

    /**
     * Supprimer une tâche
     */
    public function delete($taskId) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute(['id' => $taskId]);
    }
}