<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Projets - TaskFlow</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    <!-- En-tête / Navigation -->
    <header class="bg-white border-b border-gray-200 py-4 px-6 flex justify-between items-center shadow-sm">
        <h1 class="text-xl font-bold text-gray-900">TaskFlow <span class="text-emerald-600 text-sm font-normal">/ Projets</span></h1>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-700">Connecté en tant que : <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong></span>
            <a href="/taskflow/public/auth/logout" class="text-sm text-red-600 hover:underline font-medium">Déconnexion</a>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-5xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Mes Projets</h2>
            <a href="/taskflow/public/project/create" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg transition shadow-sm">
                + Nouveau Projet
            </a>
        </div>

        <!-- Bloc d'affichage des messages Flash (Erreur / Succès) -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($projects)): ?>
            <div class="bg-gray-50 border border-gray-200 text-gray-700 p-6 rounded-lg text-center">
                Aucun projet trouvé. Commencez par en créer un !
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($projects as $project): ?>
                    <div class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($project['title']) ?></h3>
                            <p class="text-gray-700 text-sm mb-4"><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                            <div class="text-xs text-gray-500 mb-4 space-y-1">
                                <p>Début : <?= htmlspecialchars($project['start_date']) ?></p>
                                <p>Fin : <?= htmlspecialchars($project['end_date']) ?></p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <a href="/taskflow/public/task/index?project_id=<?= $project['id'] ?>" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm flex items-center gap-1">
                                Voir les tâches &rarr;
                            </a>
                            <a href="/taskflow/public/project/delete?id=<?= $project['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Supprimer
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer Sombre -->
    <footer class="bg-gray-900 text-gray-300 py-6 text-center text-sm mt-auto">
        <p>&copy; <?= date('Y') ?> TaskFlow - conceptic.io. Tous droits réservés.</p>
    </footer>

</body>
</html>