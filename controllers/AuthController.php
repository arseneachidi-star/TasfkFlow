<?php
/**
 * Fichier : controllers/AuthController.php
 * Rôle : Gère la logique métier liée aux utilisateurs (inscription, connexion, déconnexion).
 */

require_once __DIR__ . '/../models/User.php';

class AuthController {
    
    /**
     * Affiche la vue de connexion et gère la soumission du formulaire
     */
    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!empty($email) && !empty($password)) {
                $userModel = new User();
                $user = $userModel->login($email, $password);

                if ($user) {
                    // Enregistrement des informations dans la session sécurisée
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'] ?? 'user';

                    // Redirection vers le tableau de bord
                    
                    header('Location: /taskflow/public/project/index');
                    exit();
                } else {
                    $error = "Identifiants incorrects.";
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        // Inclusion de la vue de connexion
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Affiche la vue d'inscription et gère la création de compte
     */
    public function register() {
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!empty($username) && !empty($email) && !empty($password)) {
                $userModel = new User();
                
                if ($userModel->register($username, $email, $password)) {
                    $success = "Inscription réussie. Vous pouvez vous connecter.";
                } else {
                    $error = "Erreur lors de l'inscription (email peut-être déjà utilisé).";
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        // Inclusion de la vue d'inscription
        require_once __DIR__ . '/../views/auth/register.php';
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /taskflow/public/auth/login');
        exit();
    }
}