<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - TaskFlow (conceptic.io)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900 font-sans antialiased min-h-screen flex flex-col justify-between">

    <div class="flex flex-1 min-h-0">
        <!-- Sidebar de Navigation -->
        <aside class="w-64 bg-slate-50 border-r border-slate-200 flex flex-col justify-between hidden md:flex text-slate-800">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-emerald-600 tracking-wider">Task<span class="text-slate-900">Flow</span></h1>
                <p class="text-xs text-slate-500 uppercase tracking-widest mt-1">Espace Admin</p>
                
                <nav class="mt-8 space-y-2">
                    <a href="/taskflow/public/admin/dashboard" class="flex items-center gap-3 px-4 py-3 bg-emerald-600 text-white rounded-xl font-medium transition shadow-lg shadow-emerald-600/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Vue d'ensemble
                    </a>
                    <a href="/taskflow/public/project/index" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-100 hover:text-slate-900 rounded-xl font-medium transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Tableau de bord personnel
                    </a>
                </nav>
            </div>

            <div class="p-6 border-t border-slate-200">
                <a href="/taskflow/public/auth/logout" class="flex items-center gap-3 text-rose-600 hover:text-rose-700 font-medium transition text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Déconnexion
                </a>
            </div>
        </aside>

        <!-- Contenu Principal -->
        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto bg-white">
            
            <!-- Header Supérieur -->
            <header class="bg-white border-b border-slate-200 p-6 flex justify-between items-center sticky top-0 z-10 text-slate-900 shadow-sm">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Tableau de Bord Administrateur <span class="text-emerald-600 text-sm font-normal">/ Espace Sécurisé</span></h2>
                    <p class="text-sm text-slate-500 mt-0.5">Supervisez l'activité globale et les collaborateurs de TaskFlow.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-full text-xs font-semibold">Admin connecté</span>
                </div>
            </header>

            <!-- Conteneur des blocs -->
            <div class="p-8 space-y-8 max-w-7xl w-full mx-auto">

                <!-- Messages Flash -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm flex items-center justify-between font-medium">
                        <span><?= $_SESSION['success']; unset($_SESSION['success']); ?></span>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm flex items-center justify-between font-medium">
                        <span><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Cartes de Statistiques Rapides -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-slate-50 border border-slate-200 text-slate-900 p-6 rounded-xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100 rounded-full blur-2xl"></div>
                        <p class="text-sm font-medium text-slate-500">Collaborateurs</p>
                        <h3 class="text-3xl font-bold text-slate-900 mt-2"><?= count($users ?? []) ?></h3>
                    </div>
                    <div class="bg-slate-50 border border-slate-200 text-slate-900 p-6 rounded-xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100 rounded-full blur-2xl"></div>
                        <p class="text-sm font-medium text-slate-500">Projets Totaux</p>
                        <h3 class="text-3xl font-bold text-slate-900 mt-2"><?= count($projects ?? []) ?></h3>
                    </div>
                    <div class="bg-slate-50 border border-slate-200 text-slate-900 p-6 rounded-xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100 rounded-full blur-2xl"></div>
                        <p class="text-sm font-medium text-slate-500">Tâches Actives</p>
                        <h3 class="text-3xl font-bold text-slate-900 mt-2"><?= count($tasks ?? []) ?></h3>
                    </div>
                </div>

                <!-- Grille de Gestion (Utilisateurs & Tâches Globales) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <!-- Liste des Utilisateurs -->
                    <div class="bg-slate-50 border border-slate-200 text-slate-900 rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Équipe & Collaborateurs</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-700">
                                <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
                                    <tr>
                                        <th class="p-3 rounded-l-lg">Utilisateur</th>
                                        <th class="p-3">Email</th>
                                        <th class="p-3 rounded-r-lg">Rôle</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    <?php if (!empty($users)): ?>
                                        <?php foreach ($users as $user): ?>
                                        <tr class="hover:bg-slate-100/60 transition">
                                            <td class="p-3 font-medium text-slate-900"><?= htmlspecialchars($user['username']) ?></td>
                                            <td class="p-3 text-slate-600"><?= htmlspecialchars($user['email']) ?></td>
                                            <td class="p-3">
                                                <?php if ($user['role'] === 'admin'): ?>
                                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-md text-xs font-semibold">Admin</span>
                                                <?php else: ?>
                                                    <span class="px-2.5 py-1 bg-slate-200 text-slate-700 rounded-md text-xs font-semibold">User</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="p-4 text-center text-slate-400">Aucun utilisateur trouvé.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Suivi Global des Tâches -->
                    <div class="bg-slate-50 border border-slate-200 text-slate-900 rounded-xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Suivi Global des Tâches</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-slate-700">
                                <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
                                    <tr>
                                        <th class="p-3 rounded-l-lg">Tâche</th>
                                        <th class="p-3">Statut</th>
                                        <th class="p-3 text-right rounded-r-lg">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    <?php if (!empty($tasks)): ?>
                                        <?php foreach ($tasks as $task): ?>
                                        <tr class="hover:bg-slate-100/60 transition">
                                            <td class="p-3 font-medium text-slate-900"><?= htmlspecialchars($task['title'] ?? $task['name'] ?? $task['task_name'] ?? 'Sans titre') ?></td>
                                            <td class="p-3">
                                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded-md text-xs font-semibold">
                                                    <?= htmlspecialchars($task['status'] ?? 'En cours') ?>
                                                </span>
                                            </td>
                                            <td class="p-3 text-right">
                                                <a href="/admin/task/delete/<?= $task['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette tâche en tant qu\'administrateur ?');" class="text-rose-600 hover:text-rose-700 font-medium text-xs bg-rose-50 border border-rose-200 px-3 py-1.5 rounded-lg transition inline-block">
                                                    Supprimer
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="p-4 text-center text-slate-400">Aucune tâche enregistrée.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- Footer Sombre (Conservé tel quel) -->
    <footer class="bg-slate-900 border-t border-slate-800 py-6 text-center text-sm text-slate-400">
        <p>&copy; <?= date('Y') ?> TaskFlow - conceptic.io. Tous droits réservés. - Espace Administrateur Sécurisé</p>
    </footer>

</body>
</html>