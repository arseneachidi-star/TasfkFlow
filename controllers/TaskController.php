<?php
/**
 * Fichier : controllers/TaskController.php
 * Rôle : Gère la logique métier des tâches (création, mise à jour de statut, suppression).
 */

require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Project.php';

class TaskController {

    private function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /taskflow/public/auth/login');
            exit();
        }
    }

    public function index() {
        $this->checkAuth();

        $projectId = $_GET['project_id'] ?? null;
        if (!$projectId) {
            header('Location: /taskflow/public/project/index');
            exit();
        }

        $projectModel = new Project();
        $project = $projectModel->getById($projectId);

        // Sécurité : conversion explicite en entier pour éviter les conflits de types (string vs int)
        if (!$project || (int)$project['user_id'] !== (int)$_SESSION['user_id']) {
            header('Location: /taskflow/public/project/index');
            exit();
        }

        $taskModel = new Task();
        $tasks = $taskModel->getByProject($projectId);

        require_once __DIR__ . '/../views/tasks/index.php';
    }

    public function create() {
        $this->checkAuth();

        $projectId = $_GET['project_id'] ?? null;
        if (!$projectId) {
            header('Location: /taskflow/public/project/index');
            exit();
        }

        // Correction : Charger et sécuriser le projet pour la vue create.php
        $projectModel = new Project();
        $project = $projectModel->getById($projectId);

        if (!$project || (int)$project['user_id'] !== (int)$_SESSION['user_id']) {
            header('Location: /taskflow/public/project/index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $status = $_POST['status'] ?? 'À faire';
            $priority = $_POST['priority'] ?? 'Moyenne';

            if (!empty($title)) {
                $taskModel = new Task();
                $taskModel->create($title, $description, $status, $priority, $projectId, $_SESSION['user_id']);
                
                header('Location: /taskflow/public/task/index?project_id=' . $projectId);
                exit();
            }
        }

        require_once __DIR__ . '/../views/tasks/create.php';
    }

    public function updateStatus() {
        $this->checkAuth();

        $taskId = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;
        $projectId = $_GET['project_id'] ?? null;

        if ($taskId && $status) {
            $taskModel = new Task();
            $taskModel->updateStatus($taskId, $status);
        }

        if ($projectId) {
            header('Location: /taskflow/public/task/index?project_id=' . $projectId);
            exit();
        } else {
            header('Location: /taskflow/public/project/index');
            exit();
        }
    }

    public function delete() {
        $this->checkAuth();

        $taskId = $_GET['id'] ?? null;
        $projectId = $_GET['project_id'] ?? null;

        if ($taskId) {
            $taskModel = new Task();
            $taskModel->delete($taskId);
        }

        if ($projectId) {
            header('Location: /taskflow/public/task/index?project_id=' . $projectId);
            exit();
        } else {
            header('Location: /taskflow/public/project/index');
            exit();
        }
    }
}