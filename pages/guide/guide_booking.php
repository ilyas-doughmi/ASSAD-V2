<?php 
require_once("../../includes/auth/guard.php");
require_role("guide");
?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations | Espace Guide</title>
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
            <a href="guide_dashboard.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-chart-pie w-6"></i><span class="text-sm font-medium">Tableau de bord</span>
            </a>
            <a href="guide_tours.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-list w-6"></i><span class="text-sm font-medium">Mes Visites</span>
            </a>
            <a href="guide_create.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-plus w-6"></i><span class="text-sm font-medium">Créer Visite</span>
            </a>
            <a href="guide_booking.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold">
                <i class="fa-solid fa-ticket w-6"></i><span class="text-sm font-medium">Réservations</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <header class="h-20 bg-[#0a0a0a] border-b border-white/5 flex items-center justify-between px-8">
            <h1 class="font-serif text-2xl text-white font-bold">Liste des Réservations</h1>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">
            
             <div class="relative w-full max-w-md mb-6">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500"></i>
                <input type="text" id="clientSearch" placeholder="Chercher un client..." class="w-full bg-[#151515] border border-gray-700 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:border-gold focus:outline-none text-gray-300">
            </div>

            <div class="bg-dark-card border border-white/5 rounded-xl overflow-hidden shadow-lg">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-black text-gray-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Visite</th>
                            <th class="px-6 py-4">Date Visite</th>
                            <th class="px-6 py-4">Date Réservation</th>
                            <th class="px-6 py-4 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5" id="bookingTable">
                         </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        loadBookings();

        function loadBookings(){
            const container = document.getElementById('bookingTable');
            container.innerHTML = "";
            
            let data = new FormData();
            data.append("get_bookings", "");
            
            fetch("../../includes/guide/visite_data.php", { method: "POST", body: data })
            .then(res => res.json())
            .then(data => {
                if(data.length === 0){
                    container.innerHTML = "<tr><td colspan='5' class='px-6 py-4 text-center'>Aucune réservation trouvée.</td></tr>";
                    return;
                }
                data.forEach(b => {
                    const row = `
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 text-white font-bold">${b.full_name}</td>
                        <td class="px-6 py-4 text-gray-300">${b.titre}</td>
                        <td class="px-6 py-4 text-gold">${b.date_heure_debut}</td>
                        <td class="px-6 py-4 text-xs">${b.date_reservation}</td>
                        <td class="px-6 py-4 text-right font-bold text-white">${b.prix} DH</td>
                    </tr>`;
                    container.insertAdjacentHTML('beforeend', row);
                });
            });
        }

        document.getElementById('clientSearch').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#bookingTable tr');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html> 