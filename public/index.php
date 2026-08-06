<?php
/**
 * Fichier : public/index.php
 * Rôle : Front Controller unique de l'application.
 */



session_start();



// Inclusion des classes/contrôleurs
require_once __DIR__ . '/../Controllers/AdminController.php'; 
// (Adapte le chemin '../app/Controllers/' selon l'arborescence réelle de ton projet)

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



// Nettoyage et découpage de l'URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$urlSegments = explode('/', $url);

// Détermination du Contrôleur et de l'Action
$controllerName = !empty($urlSegments[0]) ? ucfirst(strtolower($urlSegments[0])) . 'Controller' : 'AuthController';
$actionName = !empty($urlSegments[1]) ? $urlSegments[1] : 'login';

$controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            http_response_code(404);
            echo "Erreur 404 : Action '$actionName' introuvable.";
        }
    } else {
        http_response_code(404);
        echo "Erreur 404 : Classe '$controllerName' introuvable.";
    }
} else {
    http_response_code(404);
    echo "Erreur 404 : Contrôleur introuvable.";

// Le routage de l'administrateur 

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Nettoyage éventuel du préfixe du sous-dossier XAMPP si nécessaire
$uri = str_replace('/taskflow/public', '', $uri); // Adapte selon ton arborescence

if ($uri === '/admin/dashboard') {
    $controller = new AdminController();
    $controller->dashboard();
} elseif (preg_match('#^/admin/task/delete/(\d+)$#', $uri, $matches)) {
    $controller = new AdminController();
    $controller->deleteTask($matches[1]);
}
}