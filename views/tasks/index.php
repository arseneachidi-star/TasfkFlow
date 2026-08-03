<?php
if (!isset($project)) {
    $project = ['id' => 0, 'title' => 'Projet', 'description' => ''];
}
if (!isset($tasks)) {
    $tasks = [];
}
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tâches du Projet - TaskFlow (conceptic.io)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-950 flex flex-col min-h-screen">

    <!-- En-tête / Navigation -->
    <header class="bg-white border-b border-gray-200 py-4 px-6 flex justify-between items-center shadow-sm">
        <h1 class="text-xl font-bold text-gray-950">TaskFlow <span class="text-emerald-600 text-sm font-normal">/ Tâches</span></h1>
        <div class="flex items-center gap-4">
            <a href="/taskflow/public/project/index" class="text-sm text-gray-700 hover:text-gray-950 font-medium">&larr; Retour aux projets</a>
            <span class="text-sm text-gray-700">|</span>
            <a href="/taskflow/public/auth/logout" class="text-sm text-red-600 hover:underline font-medium">Déconnexion</a>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-4xl">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-950"><?= htmlspecialchars($project['title']) ?></h2>
                <p class="text-sm text-gray-700 mt-1"><?= htmlspecialchars($project['description']) ?></p>
            </div>
            <a href="/taskflow/public/task/create?project_id=<?= $project['id'] ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg transition shadow-sm">
                + Nouvelle Tâche
            </a>
        </div>

        <?php if (empty($tasks)): ?>
            <div class="bg-gray-50 border border-gray-200 text-gray-700 p-6 rounded-lg text-center">
                Aucune tâche pour ce projet pour le moment.
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($tasks as $task): ?>
                    <div class="bg-white border border-gray-200 p-5 rounded-xl shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="text-lg font-bold text-gray-950"><?= htmlspecialchars($task['title']) ?></h3>
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full 
                                    <?= $task['status'] === 'Terminé' ? 'bg-emerald-100 text-emerald-800' : ($task['status'] === 'En cours' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-800') ?>">
                                    <?= htmlspecialchars($task['status']) ?>
                                </span>
                                <span class="text-xs text-gray-500 font-medium">Priorité : <?= htmlspecialchars($task['priority']) ?></span>
                            </div>
                            <?php if (!empty($task['description'])): ?>
                                <p class="text-gray-700 text-sm"><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center gap-3 w-full md:w-auto justify-end border-t md:border-t-0 pt-3 md:pt-0 border-gray-100">
                            <!-- Changement de statut rapide -->
                            <?php if ($task['status'] !== 'Terminé'): ?>
                                <a href="/taskflow/public/task/updateStatus?id=<?= $task['id'] ?>&status=Terminé&project_id=<?= $project['id'] ?>" class="text-xs bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 font-semibold px-3 py-1.5 rounded-lg transition">
                                    Terminer
                                </a>
                            <?php else: ?>
                                <a href="/taskflow/public/task/updateStatus?id=<?= $task['id'] ?>&status=À faire&project_id=<?= $project['id'] ?>" class="text-xs bg-gray-50 text-gray-700 border border-gray-200 hover:bg-gray-100 font-semibold px-3 py-1.5 rounded-lg transition">
                                    Rouvrir
                                </a>
                            <?php endif; ?>

                            <a href="/taskflow/public/task/delete?id=<?= $task['id'] ?>&project_id=<?= $project['id'] ?>" onclick="return confirm('Supprimer cette tâche ?');" class="text-red-600 hover:text-red-800 text-sm font-medium">
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