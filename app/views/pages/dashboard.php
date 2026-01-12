<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard – Personal Wallet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-indigo-100 min-h-screen p-8">

  <header class="flex justify-between items-center mb-10">
    <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
      <i class="fa-solid fa-wallet mr-2"></i>Personal Wallet
    </h1>
    <button class="text-red-500 font-semibold">
      <i class="fa-solid fa-right-from-bracket mr-1"></i> Déconnexion
    </button>
  </header>


  <section class="grid md:grid-cols-4 gap-6 mb-10">

    <div class="bg-white rounded-2xl shadow-lg p-6">
      <p class="text-gray-500">Wallet mensuel</p>
      <p class="text-2xl font-extrabold text-blue-600"><?= number_format($walletBalance, 2) ?> DH</p>
      <form method="POST" action="index.php?action=updateWallet" class="mt-3">
        <input type="number" name="amount" min="0" step="0.01" placeholder="Modifier budget"
          class="mt-3 w-full border rounded-lg p-2" />
        <button class="mt-3 w-full bg-blue-600 text-white rounded-lg py-2">
          Mettre à jour
        </button>
      </form>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">
      <p class="text-gray-500">Total dépenses</p>
      <p class="text-2xl font-extrabold text-purple-600"> <?= number_format($totalExpenses, 2) ?> DH</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">
      <p class="text-gray-500">Solde restant</p>
      <p class="text-2xl font-extrabold text-green-600"><?= number_format($remaining, 2) ?> DH</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6">
      <p class="text-gray-500">Budget mensuel</p>
      <p class="text-2xl font-extrabold text-blue-600"><?= number_format($monthlyBudget, 2) ?> DH</p>
      <form method="POST" action="index.php?action=setBudget">
        <input type="number" min="0" name="budget" placeholder="Mettre à jour budget"
          class="w-full border rounded-lg p-2 mt-2" />
        <button class="mt-3 w-full bg-blue-600 text-white rounded-lg py-2">
          Mettre à jour
        </button>
      </form>
    </div>

  </section>

  <!-- Categories -->
  <section class="bg-white rounded-2xl shadow-lg p-8 mb-10">
    <h2 class="text-xl font-bold mb-4">
      <i class="fa-solid fa-tags mr-2 text-purple-600"></i>Catégories
    </h2>

    <div class="flex gap-4 mb-4">
      <form method="POST" action="index.php?action=addCategory">
        <input type="text" name="category_name" placeholder="Nouvelle catégorie" class="border rounded-lg p-2 flex-1" />
        <button class="bg-purple-600 text-white px-6 rounded-lg">Ajouter</button>
      </form>
    </div>

    <div class="flex gap-3 flex-wrap">
      <?php foreach ($categories as $cat): ?>
        <span class="px-4 py-1 bg-blue-100 text-blue-600 rounded-full flex items-center gap-1">
          <?= htmlspecialchars($cat['name']) ?>
        </span>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Add Expense -->
  <section class="bg-white rounded-2xl shadow-lg p-8 mb-10">
    <h2 class="text-xl font-bold mb-6">
      <i class="fa-solid fa-plus mr-2 text-blue-600"></i>Ajouter une dépense
    </h2>

    <form method="POST" action="index.php?action=addExpense" class="grid md:grid-cols-4 gap-4">
      <input type="text" name="title" placeholder="Titre" class="border p-3 rounded-lg" required />
      <input type="number" name="amount" min="0" placeholder="Montant" class="border p-3 rounded-lg" step="0.01" required />
      <input type="date" name="date" class="border p-3 rounded-lg" required />
      <select name="category_id" class="border p-3 rounded-lg" required>
        <option value="">Catégorie</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
        <?php endforeach; ?>
      </select>

      <div class="md:col-span-4 text-right">
        <button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl">
          Ajouter la dépense
        </button>
      </div>
    </form>
  </section>

 


</body>
</html>
