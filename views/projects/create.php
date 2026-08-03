<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Projet - TaskFlow (conceptic.io)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-950 flex flex-col min-h-screen">

    <!-- En-tête / Navigation -->
    <header class="bg-white border-b border-gray-200 py-4 px-6 flex justify-between items-center shadow-sm">
        <h1 class="text-xl font-bold text-gray-950">TaskFlow <span class="text-emerald-600 text-sm font-normal">/ Nouveau Projet</span></h1>
        <div class="flex items-center gap-4">
            <a href="/taskflow/public/project/index" class="text-sm text-gray-700 hover:text-gray-950 font-medium">&larr; Retour au tableau de bord</a>
            <span class="text-sm text-gray-700">|</span>
            <a href="/taskflow/public/auth/logout" class="text-sm text-red-600 hover:underline font-medium">Déconnexion</a>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="flex-grow container mx-auto px-4 py-8 max-w-xl">
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-sm">
            <h2 class="text-2xl font-bold text-gray-950 mb-6">Créer un nouveau projet</h2>

            <form action="/taskflow/public/project/create" method="POST" class="space-y-5">
                <!-- Titre du projet -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-1">Titre du projet</label>
                    <input type="text" id="title" name="title" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent text-gray-950 text-sm"
                        placeholder="Ex: Refonte site web e-commerce">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-800 mb-1">Description (optionnelle)</label>
                    <textarea id="description" name="description" rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent text-gray-950 text-sm"
                        placeholder="Décrivez brièvement les objectifs du projet..."></textarea>
                </div>

                <!-- Dates de début et de fin -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-gray-800 mb-1">Date de début</label>
                        <input type="date" id="start_date" name="start_date" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent text-gray-950 text-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-gray-800 mb-1">Date d'échéance</label>
                        <input type="date" id="end_date" name="end_date" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent text-gray-950 text-sm">
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="/taskflow/public/project/index" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition shadow-sm">
                        Enregistrer le projet
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