<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Personal Wallet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-700 min-h-screen flex items-center justify-center py-12">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
     
        <div class="text-center mb-8">
            <i class="fa-solid fa-wallet text-6xl text-indigo-600 mb-4"></i> 
            <h1 class="text-3xl font-bold text-gray-900">Créer un compte</h1>
            <p class="text-gray-600 mt-2">Rejoignez Personal Wallet</p>
        </div>

        <form action="/personalwallet/index.php?action=submit-register" method="POST">
            <input type="hidden" name="csrf_token" value="">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-user mr-2"></i>Nom complet
                </label>
                <input type="text" name="nom" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="Ahmed Benjelloun">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-envelope mr-2"></i>Email
                </label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="votre@email.com">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-lock mr-2"></i>Mot de passe
                </label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="Min. 8 caractères">
                <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    <i class="fas fa-lock mr-2"></i>Confirmer le mot de passe
                </label>
                <input type="password" name="confirm_password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="••••••••">
            </div>

            <button type="submit" 
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                <i class="fas fa-user-plus mr-2"></i>S'inscrire
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Déjà un compte ? 
                <a href="login.php" class="text-indigo-600 font-semibold hover:text-indigo-700">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</body>
</html>
