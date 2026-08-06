<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Project.php';

class AdminController {

    // Méthode de vérification des droits admin
    private function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier si l'utilisateur est connecté et s'il est admin
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['error'] = "Accès non autorisé. Réservé aux administrateurs.";
            header('Location: /dashboard'); // Rediriger vers le dashboard normal
            exit();
        }
    }

    // Tableau de bord administrateur (Vue d'ensemble)
    public function dashboard() {
        $this->checkAdmin();

        // Récupérer les données globales pour le suivi
        $userModel = new User();
        $taskModel = new Task();
        $projectModel = new Project();

        $users = $userModel->getAllUsers(); // Liste des collaborateurs
        $tasks = $taskModel->getAllTasks(); // Toutes les tâches de la plateforme
        $projects = $projectModel->getAllProjects(); // Tous les projets

        // Charger la vue admin (à créer)
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    // Supprimer une tâche (action admin globale)
    public function deleteTask($id) {
        $this->checkAdmin();

        $taskModel = new Task();
        $taskModel->delete($id);

        $_SESSION['success'] = "Tâche supprimée avec succès par l'administrateur.";
        header('Location: /admin/dashboard');
        exit();
    }
}