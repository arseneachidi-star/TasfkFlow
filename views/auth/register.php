<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - TaskFlow (conceptic.io)</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-950 flex flex-col min-h-screen justify-between">

    <!-- En-tête minimaliste -->
    <header class="py-4 px-6 border-b border-gray-200">
        <h1 class="text-xl font-bold text-gray-950">TaskFlow <span class="text-emerald-600 text-sm font-normal">/ conceptic.io</span></h1>
    </header>

    <!-- Contenu Principal -->
    <main class="flex items-center justify-center py-12 px-4 flex-grow">
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-sm w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-950">Créer un compte</h2>
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4 text-sm">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-lg mb-4 text-sm">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form action="/taskflow/public/auth/register" method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-950 text-sm font-semibold mb-2">Nom d'utilisateur</label>
                    <input type="text" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white">
                </div>

                <div>
                    <label class="block text-gray-950 text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white">
                </div>
                
                <div>
                    <label class="block text-gray-950 text-sm font-semibold mb-2">Mot de passe</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-950 bg-white">
                </div>
                
                <div class="pt-2">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm">
                        S'inscrire
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-700">
                Déjà un compte ? <a href="/taskflow/public/auth/login" class="text-emerald-600 hover:underline font-semibold">Se connecter</a>
            </p>
        </div>
    </main>

    <!-- Footer Sombre -->
    <footer class="bg-gray-900 text-gray-300 py-6 text-center text-sm">
        <p>&copy; <?= date('Y') ?> TaskFlow - conceptic.io. Tous droits réservés.</p>
    </footer>

</body>
</html>