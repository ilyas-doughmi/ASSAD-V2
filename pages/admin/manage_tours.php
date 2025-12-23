<?php 
require_once("../../includes/auth/guard.php");
require_role("admin");

?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Visites | Admin ASSAD</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Outfit"', 'sans-serif'],
                        serif: ['"Cinzel"', 'serif'],
                    },
                    colors: {
                        gold: '#C6A87C',
                        dark: '#050505',
                        'dark-card': '#111111',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-dark text-gray-100 font-sans h-screen flex overflow-hidden">

    <aside class="w-64 bg-black border-r border-white/10 hidden md:flex flex-col z-20">
        <div class="h-20 flex items-center px-8 border-b border-white/5 bg-gold/5">
            <i class="fa-solid fa-crown text-gold text-xl mr-3"></i>
            <span class="font-serif font-bold text-lg tracking-widest text-white">ASSAD ADMIN</span>
        </div>

        <nav class="flex-1 py-6 space-y-1 overflow-y-auto">
            <p class="px-8 text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 mt-2">Principal</p>
            <a href="admin_dashboard.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-chart-line w-6"></i>
                <span class="text-sm font-medium">Statistiques</span>
            </a>
            
            <p class="px-8 text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 mt-6">Gestion</p>
            <a href="manage_users.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-users w-6"></i>
                <span class="text-sm font-medium">Utilisateurs</span>
            </a>
            <a href="manage_animals.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-paw w-6"></i>
                <span class="text-sm font-medium">Animaux</span>
            </a>
            <a href="manage_habitats.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-tree w-6"></i>
                <span class="text-sm font-medium">Habitats</span>
            </a>
            <a href="manage_tours.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold transition">
                <i class="fa-solid fa-compass w-6"></i>
                <span class="text-sm font-medium">Visites Guidées</span>
            </a>
        </nav>
     <div class="p-6 border-t border-white/5 bg-black">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=C6A87C&color=000" class="w-10 h-10 rounded-full border border-gold">
                <div>
                    <p class="text-sm font-bold text-white">Super Admin</p>
                    <a href="../../includes/auth/logout.php" class="text-xs text-red-500 hover:text-red-400">Déconnexion</a>
                </div>
            </div>
        </div>
</aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-20 bg-[#0a0a0a] border-b border-white/5 flex items-center justify-between px-8">
            <h1 class="font-serif text-2xl text-white font-bold">Supervision des Visites</h1>
            
            <div class="flex gap-3">
                <div class="bg-black border border-white/10 rounded-lg px-4 py-2 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-xs text-gray-400">5 Visites en cours</span>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">
            
            <div class="flex flex-col sm:flex-row gap-4 mb-6 justify-between items-center">
                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500"></i>
                    <input type="text" placeholder="Rechercher titre, guide..." class="w-full bg-[#151515] border border-gray-700 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:border-gold focus:outline-none text-gray-300">
                </div>
                
                <div class="flex gap-4 w-full sm:w-auto">
                    <select class="bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded-lg px-4 py-2.5 focus:border-gold focus:outline-none cursor-pointer">
                        <option value="all">Tous les Statuts</option>
                        <option value="scheduled">Planifié</option>
                        <option value="completed">Terminé</option>
                        <option value="cancelled">Annulé</option>
                    </select>
                    
                    <select class="bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded-lg px-4 py-2.5 focus:border-gold focus:outline-none cursor-pointer">
                        <option value="all">Tous les Guides</option>
                        <option value="1">Ahmed Bennani</option>
                        <option value="2">Sarah Oulad</option>
                    </select>
                </div>
            </div>

            <div class="bg-dark-card border border-white/5 rounded-xl overflow-hidden shadow-lg">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-black text-gray-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">id</th>
                            <th class="px-6 py-4">titre</th>
                            <th class="px-6 py-4">guide_id</th>
                            <th class="px-6 py-4">date_heure_debut</th>
                            <th class="px-6 py-4">prix</th>
                            <th class="px-6 py-4">status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <?php
                        include '../../includes/db.php';
                        $q = mysqli_query($conn, "SELECT * FROM tours");
                        while($row = mysqli_fetch_assoc($q)){
                            echo '<tr>';
                            echo '<td class="px-6 py-4">'.$row['id'].'</td>';
                            echo '<td class="px-6 py-4">'.$row['titre'].'</td>';
                            echo '<td class="px-6 py-4">'.$row['guide_id'].'</td>';
                            echo '<td class="px-6 py-4">'.$row['date_heure_debut'].'</td>';
                            echo '<td class="px-6 py-4">'.$row['prix'].'</td>';
                            echo '<td class="px-6 py-4">'.$row['status'].'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="flex justify-between items-center mt-6">
                <p class="text-xs text-gray-500">2 sur 45 visites</p>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-black border border-white/10 rounded text-gray-500 hover:text-white transition">Précédent</button>
                    <button class="px-3 py-1 bg-gold text-black font-bold rounded">1</button>
                    <button class="px-3 py-1 bg-black border border-white/10 rounded text-gray-500 hover:text-white transition">Suivant</button>
                </div>
            </div>
        </div>
    </main>

    <div id="tourDetailsModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#111] w-full max-w-lg rounded-xl border border-white/10 shadow-2xl p-8 relative animate-fade-in-up">
            
            <button onclick="closeDetailsModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
            
            <h2 class="font-serif text-2xl text-white mb-2">Détails de la Visite</h2>
            <p class="text-gold font-bold mb-6">Safari Nocturne : Les Félins</p>
            
            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                <div class="bg-white/5 p-3 rounded">
                    <p class="text-gray-500 text-xs uppercase">Guide</p>
                    <p class="text-white font-bold">Ahmed Bennani</p>
                </div>
                <div class="bg-white/5 p-3 rounded">
                    <p class="text-gray-500 text-xs uppercase">Revenus Est.</p>
                    <p class="text-white font-bold">2,700 DH</p>
                </div>
            </div>

            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Parcours Défini</h3>
            <div class="relative pl-6 border-l-2 border-gray-800 space-y-6">
                
                <div class="relative">
                    <span class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-gold border-4 border-[#111]"></span>
                    <h4 class="text-white font-bold text-sm">Point de rencontre</h4>
                    <p class="text-gray-500 text-xs">Entrée Principale - Zone Nord</p>
                </div>

                <div class="relative">
                    <span class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-gray-700 border-4 border-[#111]"></span>
                    <h4 class="text-white font-bold text-sm">Enclos des Lions</h4>
                    <p class="text-gray-500 text-xs">Observation silencieuse (15 min)</p>
                </div>

                 <div class="relative">
                    <span class="absolute -left-[31px] top-0 w-4 h-4 rounded-full bg-gray-700 border-4 border-[#111]"></span>
                    <h4 class="text-white font-bold text-sm">Zone Hyènes</h4>
                    <p class="text-gray-500 text-xs">Nourrissage (Optionnel)</p>
                </div>
            </div>

            <div class="mt-8 text-right">
                <button onclick="closeDetailsModal()" class="px-6 py-2 bg-gray-800 text-gray-300 rounded hover:bg-white hover:text-black transition text-sm font-bold">Fermer</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('tourDetailsModal');

        function openDetailsModal(id) {
            // In a real app, you would fetch details via AJAX using the ID
            modal.classList.remove('hidden');
        }

        function closeDetailsModal() {
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>