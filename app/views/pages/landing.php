
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Personal Wallet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <script src="https://cdn.tailwindcss.com"></script>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  />
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-indigo-100 text-gray-800">

  <header class="bg-white/80 backdrop-blur shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
        <i class="fa-solid fa-wallet mr-2"></i>Personal Wallet
      </h1>
      <div class="space-x-4">
        <a href="../auth/login.php" class="text-gray-600 hover:text-purple-600 font-medium">
          Se connecter
        </a>
        <a href="../auth/register.php"
           class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:opacity-90 transition">
          S’inscrire
        </a>
      </div>
    </div>
  </header>

  <section class="max-w-7xl mx-auto px-6 py-20 text-center">
    <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-gray-900">
      Gérez votre argent en toute
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
        simplicité
      </span>
    </h2>

    <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">
      <strong>Personal Wallet</strong> vous aide à suivre vos dépenses mensuelles,
      maîtriser votre budget et mieux comprendre vos habitudes financières,
      le tout dans une interface claire et moderne.
    </p>

    <div class="flex justify-center gap-6">
      <a href="../auth/register.php"
         class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl text-lg font-semibold shadow-lg hover:scale-105 transition">
        <i class="fa-solid fa-user-plus"></i>
        Créer un compte
      </a>
      <a href="../auth/login.php"
         class="flex items-center gap-2 border-2 border-purple-600 text-purple-600 px-8 py-3 rounded-xl text-lg font-semibold hover:bg-purple-50 transition">
        <i class="fa-solid fa-right-to-bracket"></i>
        J’ai déjà un compte
      </a>
    </div>
  </section>

  <section class="py-16">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-10 text-center">

      <div class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">
        <div class="text-4xl text-blue-600 mb-4">
          <i class="fa-solid fa-list"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Suivi des dépenses</h3>
        <p class="text-gray-600">
          Enregistrez et organisez facilement toutes vos dépenses mensuelles.
        </p>
      </div>

      <div class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">
        <div class="text-4xl text-purple-600 mb-4">
          <i class="fa-solid fa-piggy-bank"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Contrôle du budget</h3>
        <p class="text-gray-600">
          Fixez un budget mensuel et gardez toujours le contrôle de vos finances.
        </p>
      </div>

      <div class="bg-white rounded-2xl shadow-lg p-8 hover:scale-105 transition">
        <div class="text-4xl text-indigo-600 mb-4">
          <i class="fa-solid fa-chart-pie"></i>
        </div>
        <h3 class="text-xl font-bold mb-3">Visualisation claire</h3>
        <p class="text-gray-600">
          Analysez vos habitudes grâce à des graphiques simples et lisibles.
        </p>
      </div>

    </div>
  </section>

  <section class="py-16 text-center">
    <div class="max-w-3xl mx-auto bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-10 text-white shadow-xl">
      <h3 class="text-3xl font-extrabold mb-4">
        Prenez le contrôle de votre budget dès aujourd’hui
      </h3>
      <p class="mb-6 text-white/90">
        Inscrivez-vous gratuitement et commencez à gérer votre wallet personnel.
      </p>
      <a href="../auth/register.php"
         class="inline-flex items-center gap-2 bg-white text-purple-600 px-8 py-3 rounded-xl font-bold hover:scale-105 transition">
        <i class="fa-solid fa-arrow-right"></i>
        Commencer maintenant
      </a>
    </div>
  </section>

  <footer class="bg-white/80 backdrop-blur py-6 text-center text-gray-500">
    © 2026 <span class="font-semibold text-purple-600">Personal Wallet</span>. Tous droits réservés.
  </footer>

</body>
</html>
