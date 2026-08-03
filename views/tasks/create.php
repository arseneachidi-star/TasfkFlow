<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Tâche - TaskFlow (conceptic.io)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-950 flex flex-col min-h-screen">

    <!-- En-tête / Navigation -->
    <header class="bg-white border-b border-gray-200 py-4 px-6 flex justify-between items-center shadow-sm">
        <h1 class="text-xl font-bold text-gray-950">TaskFlow <span class="text-emerald-600 text-sm font-normal">/ Nouvelle Tâche</span></h1>
        <a href="/taskflow/public/task/index?project_id=<?= $_GET['project_id'] ?? '' ?>" class="text-sm text-gray-700 hover:text-gray-950 font-medium">&larr; Retour aux tâches</a>
    </header>

    <!-- Contenu Principal -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-lg">
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-sm">
            <h2 class="text-2xl font-bold text-gray-950 mb-6">Ajouter une tâche</h2>

            <form action="/taskflow/public/task/create?project_id=<?= $_GET['project_id'] ?? '' ?>" method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-950 text-sm font-semibold mb-2">Titre de la tâche</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white">
                </div>

                <div>
                    <label class="block text-gray-950 text-sm font-semibold mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-950 text-sm font-semibold mb-2">Statut</label>
                        <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white">
                            <option value="À faire">À faire</option>
                            <option value="En cours">En cours</option>
                            <option value="Terminé">Terminé</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-950 text-sm font-semibold mb-2">Priorité</label>
                        <select name="priority" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white">
                            <option value="Basse">Basse</option>
                            <option value="Moyenne" selected>Moyenne</option>
                            <option value="Haute">Haute</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm">
                        Enregistrer la tâche
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer Sombre -->
    <footer class="bg-gray-900 text-gray-300 py-6 text-center text-sm mt-auto">
        <p>&copy; <?= date('Y') ?> TaskFlow - conceptic.io. Tous droits réservés.</p>
    </footer>

</body>
</html>