taskflow/
├── config/
│   └── database.php          # Connexion PDO à la base de données
│
├── controllers/
│   ├── AuthController.php    # Gestion de la connexion, inscription, déconnexion
│   ├── ProjectController.php # Gestion des projets (dashboard, création, suppression)
│   └── TaskController.php    # Gestion des tâches (liste, ajout, changement de statut, suppression)
│
├── models/
│   ├── User.php              # Modèle de données pour les utilisateurs
│   ├── Project.php           # Modèle de données pour les projets
│   └── Task.php              # Modèle de données pour les tâches
│
├── public/
│   ├── index.php             # Front Controller (routeur unique)
│   ├── .htaccess             # Réécriture d'URL (URL rewriting)
│   └── assets/               # Dossier pour les fichiers CSS, JS, images
│
└── views/
    ├── auth/
    │   ├── login.php         # Formulaire de connexion
    │   └── register.php      # Formulaire d'inscription
    ├── projects/
    │   ├── index.php         # Tableau de bord principal (liste des projets)
    │   └── create.php        # Formulaire de création d'un projet
    └── tasks/
        ├── index.php         # Liste des tâches
        └── create.php        # Formulaire de création d'une tâche