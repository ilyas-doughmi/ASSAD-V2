<?php 
require_once("../../includes/auth/guard.php");
require_role("guide");
?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Guide | ASSAD Zoo</title>
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
<body class="bg-dark text-gray-100 font-sans h-screen flex overflow-hidden">

    <aside class="w-64 bg-black border-r border-white/10 hidden md:flex flex-col z-20">
        <div class="h-20 flex items-center px-8 border-b border-white/5 bg-gold/5">
            <i class="fa-solid fa-crown text-gold text-xl mr-3"></i>
            <span class="font-serif font-bold text-lg tracking-widest text-white">GUIDE SPACE</span>
        </div>
        <nav class="flex-1 py-6 space-y-1">
            <a href="guide_dashboard.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold">
                <i class="fa-solid fa-chart-pie w-6"></i><span class="text-sm font-medium">Tableau de bord</span>
            </a>
            <a href="guide_tours.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-list w-6"></i><span class="text-sm font-medium">Mes Visites</span>
            </a>
            <a href="guide_create.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-plus w-6"></i><span class="text-sm font-medium">Créer Visite</span>
            </a>
            <a href="guide_booking.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-ticket w-6"></i><span class="text-sm font-medium">Réservations</span>
            </a>
        </nav>
        <div class="p-6 border-t border-white/5 bg-black">
             <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gray-800 border border-gold flex items-center justify-center text-gold font-bold">G</div>
                <div>
                    <p class="text-sm font-bold text-white">Guide</p>
                    <a href="../../includes/auth/logout.php" class="text-xs text-red-500 hover:text-red-400">Déconnexion</a>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <header class="md:hidden h-16 bg-black border-b border-white/10 flex items-center justify-between px-4">
            <span class="font-serif font-bold text-gold">GUIDE DASHBOARD</span>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10 bg-[#0a0a0a]">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="font-serif text-3xl text-white font-bold">Bonjour</h1>
                    <p class="text-gray-500 text-sm mt-1">Voici le programme de vos expéditions.</p>
                </div>
                <button onclick="window.location.href='guide_create.php'" class="hidden md:flex bg-gold text-black font-bold px-4 py-2 rounded shadow hover:bg-white transition items-center gap-2 text-sm">
                    <i class="fa-solid fa-plus"></i> Nouvelle Visite
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-dark-card border border-white/5 p-5 rounded-xl flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-900/20 flex items-center justify-center text-blue-500">
                        <i class="fa-solid fa-compass text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Visites ce mois</p>
                        <p class="text-2xl font-bold text-white" id="stat_tours">-</p>
                    </div>
                </div>

                <div class="bg-dark-card border border-white/5 p-5 rounded-xl flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-green-900/20 flex items-center justify-center text-green-500">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Visiteurs Total</p>
                        <p class="text-2xl font-bold text-white" id="stat_visitors">-</p>
                    </div>
                </div>

                <div class="bg-dark-card border border-white/5 p-5 rounded-xl flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-yellow-900/20 flex items-center justify-center text-yellow-500">
                        <i class="fa-solid fa-star text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase">Note Moyenne</p>
                        <p class="text-2xl font-bold text-white" id="stat_rating">-</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-dark-card border border-white/5 rounded-xl overflow-hidden shadow-lg">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <h3 class="font-serif text-lg text-white font-bold">Prochaines Visites</h3>
                        <a href="guide_tours.php" class="text-xs text-gold hover:underline">Voir tout</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-400">
                            <thead class="bg-black text-gray-500 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4">Visite</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4">Prix</th>
                                </tr>
                            </thead>
                            <tbody id="upcoming_container" class="divide-y divide-white/5">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        loadStats();
        loadUpcoming();

        function loadStats(){
            let data = new FormData();
            data.append("get_stats", "");
            fetch("../../includes/guide/visite_data.php", { method: "POST", body: data })
            .then(res => res.json())
            .then(data => {
                document.getElementById('stat_tours').innerText = data.tours_month;
                document.getElementById('stat_visitors').innerText = data.visitors;
                document.getElementById('stat_rating').innerText = data.rating;
            });
        }

        function loadUpcoming(){
            let data = new FormData();
            data.append("get_upcoming", "");
            fetch("../../includes/guide/visite_data.php", { method: "POST", body: data })
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('upcoming_container');
                container.innerHTML = "";
                if(data.length === 0) {
                     container.innerHTML = '<tr><td colspan="3" class="px-6 py-4 text-center">Aucune visite à venir.</td></tr>';
                }
                data.forEach(t => {
                    const row = `
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-bold text-white">${t.titre}</td>
                            <td class="px-6 py-4 text-gold">${t.date_heure_debut}</td>
                            <td class="px-6 py-4">${t.prix} DH</td>
                        </tr>`;
                    container.insertAdjacentHTML('beforeend', row);
                });
            });
        }
    </script>
</body>
</html>