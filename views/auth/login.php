<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - TaskFlow (conceptic.io)</title>
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
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-950">Connexion à votre espace</h2>
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-4 text-sm">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/taskflow/public/auth/login" method="POST" class="space-y-4">
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
                        Se connecter
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-700">
                Pas encore de compte ? <a href="/taskflow/public/auth/register" class="text-emerald-600 hover:underline font-semibold">S'inscrire</a>
            </p>
        </div>
    </main>

    <!-- Footer Sombre -->
    <footer class="bg-gray-900 text-gray-300 py-6 text-center text-sm">
        <p>&copy; <?= date('Y') ?> TaskFlow - conceptic.io. Tous droits réservés.</p>
    </footer>

</body>
</html>