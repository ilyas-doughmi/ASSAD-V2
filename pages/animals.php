<?php
require_once(dirname(__DIR__).'/Classes/db.php');
require_once(dirname(__DIR__).'/Classes/Animal.php');
include(dirname(__DIR__).'/includes/auth/guard.php');

$db = new db();
$animalModel = new Animal($db);

$habitat = $_GET['habitat'] ?? null;
$country = $_GET['country'] ?? null;
$search = $_GET['search'] ?? null;

$animals = $animalModel->searchAnimals($habitat, $country, $search);
?>

<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Animaux | ASSAD Zoo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Outfit"', 'sans-serif'], serif: ['"Cinzel"', 'serif'] },
                    colors: { gold: '#C6A87C', dark: '#050505', 'dark-card': '#111111' }
                }
            }
        }
    </script>
</head>
<body class="bg-dark text-gray-100 font-sans selection:bg-gold selection:text-black min-h-screen flex flex-col">

    <?php include(dirname(__DIR__).'/includes/visitor_nav.php'); ?>

    <header class="pt-32 pb-10 px-6 bg-[#0a0a0a] border-b border-white/5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gold/5 rounded-full filter blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto text-center md:text-left">
            <h1 class="font-serif text-4xl md:text-5xl text-white font-bold mb-2">Les Résidents</h1>
            <p class="text-gray-400 max-w-2xl">Découvrez la faune majestueuse de l'Afrique.</p>
        </div>
    </header>

    <div class="sticky top-20 z-40 bg-[#0a0a0a]/95 backdrop-blur-sm border-b border-white/10 py-4 px-6 shadow-md">
        <form method="GET" class="max-w-7xl mx-auto flex flex-col md:flex-row gap-4 items-center justify-between">
            
            <div class="flex flex-wrap w-full md:w-auto gap-4">
                <div class="relative w-full md:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-500"></i>
                    <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Rechercher..." 
                           class="w-full bg-[#151515] border border-gray-700 text-white text-sm rounded-lg py-2.5 pl-10 pr-4 focus:outline-none focus:border-gold transition-colors">
                </div>
                
                <select name="habitat" onchange="this.form.submit()" class="w-full md:w-48 bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded-lg py-2.5 pl-4 pr-10 focus:outline-none focus:border-gold cursor-pointer">
                    <option value="all">Tous les Habitats</option>
                    <option value="Savane" <?= (isset($_GET['habitat']) && $_GET['habitat']=='Savane')?'selected':'' ?>>Savane</option>
                    <option value="Jungle" <?= (isset($_GET['habitat']) && $_GET['habitat']=='Jungle')?'selected':'' ?>>Jungle</option>
                    <option value="Désert" <?= (isset($_GET['habitat']) && $_GET['habitat']=='Désert')?'selected':'' ?>>Désert</option>
                </select>

                <select name="country" onchange="this.form.submit()" class="w-full md:w-48 bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded-lg py-2.5 pl-4 pr-10 focus:outline-none focus:border-gold cursor-pointer">
                    <option value="all">Tous les Pays</option>
                    <option value="Maroc" <?= (isset($_GET['country']) && $_GET['country']=='Maroc')?'selected':'' ?>>Maroc</option>
                    <option value="Kenya" <?= (isset($_GET['country']) && $_GET['country']=='Kenya')?'selected':'' ?>>Kenya</option>
                    <option value="Congo" <?= (isset($_GET['country']) && $_GET['country']=='Congo')?'selected':'' ?>>Congo</option>
                </select>
            </div>

            <div class="text-gray-500 text-sm font-medium">
                <span class="text-gold font-bold"><?= count($animals) ?></span> résultats
            </div>
        </form>
    </div>

    <section class="flex-1 py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <?php if(count($animals) > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach($animals as $animal): ?>
                    <div class="group bg-dark-card rounded-xl overflow-hidden border border-white/5 hover:border-gold/50 transition-all duration-300 shadow-lg flex flex-col">
                        <div class="relative h-64 overflow-hidden">
                            <img src="<?= htmlspecialchars($animal['image']) ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="<?= htmlspecialchars($animal['nom']) ?>">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <h3 class="font-serif text-2xl text-white group-hover:text-gold transition"><?= htmlspecialchars($animal['nom']) ?></h3>
                                <p class="text-gray-500 text-xs italic"><?= htmlspecialchars($animal['espece']) ?></p>
                            </div>
                            <div class="mt-auto pt-4 border-t border-white/10 flex justify-between text-sm text-gray-400">
                                <span class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-gold"></i> <?= htmlspecialchars($animal['pays_origin']) ?></span>
                                <span><i class="fa-solid fa-tree text-gold mr-1"></i> <?= htmlspecialchars($animal['habitat_nom']) ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-20 opacity-50">
                    <i class="fa-solid fa-paw text-6xl mb-4 text-gray-600"></i>
                    <h2 class="text-xl text-gray-400 font-serif">Aucun animal trouvé.</h2>
                    <a href="animals.php" class="text-gold hover:underline mt-2 inline-block">Réinitialiser les filtres</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

</body>
</html>