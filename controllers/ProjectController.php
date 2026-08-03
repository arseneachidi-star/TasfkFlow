<?php
/**
 * Fichier : controllers/ProjectController.php
 * Rôle : Gère la logique des projets (liste/dashboard, création, suppression).
 */

require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../models/Task.php'; // Nécessaire pour vérifier les tâches liées au projet

class ProjectController {

    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /taskflow/public/auth/login');
            exit();
        }
    }

    public function index() {
        $this->checkAuth();

        $projectModel = new Project();
        $projects = $projectModel->getByUser($_SESSION['user_id']);

        require_once __DIR__ . '/../views/projects/index.php';
    }

    public function create() {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $startDate = $_POST['start_date'] ?? null;
            $endDate = $_POST['end_date'] ?? null;
            $userId = $_SESSION['user_id'];

            if (!empty($title)) {
                $projectModel = new Project();
                $projectModel->create($title, $description, $startDate, $endDate, $userId);

                header('Location: /taskflow/public/project/index');
                exit();
            }
        }

        require_once __DIR__ . '/../views/projects/create.php';
    }

    /**
     * Supprime un projet s'il ne contient aucune tâche.
     */
    public function delete($id = null) {
        $this->checkAuth();

        // Si l'ID n'est pas passé en paramètre, on essaie de le récupérer via $_GET (ex: ?id=X)
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        // Si toujours aucun ID trouvé, on redirige vers la liste avec une erreur
        if (!$id) {
            $_SESSION['error'] = "Identifiant du projet introuvable.";
            header('Location: /taskflow/public/project/index');
            exit();
        }

        // 1. Vérifier les tâches associées au projet
        $taskModel = new Task();
        $tasks = $taskModel->getByProject($id);

        if (!empty($tasks)) {
            $_SESSION['error'] = "Impossible de supprimer ce projet car il contient déjà des tâches.";
            header('Location: /taskflow/public/project/index');
            exit();
        }

        // 2. Supprimer le projet si aucune tâche n'est rattachée
        $projectModel = new Project();
        $projectModel->delete($id, $_SESSION['user_id']); 

        $_SESSION['success'] = "Projet supprimé avec succès.";
        header('Location: /taskflow/public/project/index');
        exit();
    }
    
}