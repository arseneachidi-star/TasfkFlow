taskflow/
│
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
│   ├── Project.php           # Modèle de données pour les projets (avec les 5 arguments pour create)
│   └── Task.php              # Modèle de données pour les tâches
│
├── public/
│   ├── index.php             # Front Controller (le routeur unique qui analyse les URLs)
│   ├── .htaccess             # (Optionnel) Réécriture d'URL si tu gères du URL rewriting
│   └── assets/               # Dossier pour tes fichiers CSS personnalisés, JS ou images
│
└── views/
    ├── auth/
    │   ├── login.php         # Formulaire de connexion
    │   └── register.php      # Formulaire d'inscription
    ├── projects/
    │   ├── index.php         # Tableau de bord principal (liste des projets)
    │   └── create.php        # Formulaire de création d'un projet
    └── tasks/
        ├── index.php         # Liste des tâches d'un projet spécifique
        └── create.php        # Formulaire de création d'une tâche