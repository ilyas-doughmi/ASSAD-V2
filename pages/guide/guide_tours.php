<?php 
require_once("../../includes/auth/guard.php");
require_role("guide");
?>

<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Visites | Espace Guide</title>
    
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
            <span class="font-serif font-bold text-lg tracking-widest text-white">GUIDE SPACE</span>
        </div>

        <nav class="flex-1 py-6 space-y-1">
            <a href="guide_dashboard.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-chart-pie w-6"></i>
                <span class="text-sm font-medium">Tableau de bord</span>
            </a>
            
            <a href="guide_tours.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold">
                <i class="fa-solid fa-list w-6"></i>
                <span class="text-sm font-medium">Mes Visites</span>
            </a>
            
            <a href="guide_create.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-plus w-6"></i>
                <span class="text-sm font-medium">Créer Visite</span>
            </a>

            <a href="guide_booking.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-ticket w-6"></i>
                <span class="text-sm font-medium">Réservations</span>
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
        
        <header class="h-20 bg-[#0a0a0a] border-b border-white/5 flex items-center justify-between px-8">
            <h1 class="font-serif text-2xl text-white font-bold">Gestion de mes Offres</h1>
            <a href="guide_create.php" class="bg-gold text-black font-bold px-4 py-2 rounded shadow hover:bg-white transition flex items-center gap-2 text-sm">
                <i class="fa-solid fa-plus"></i> Nouvelle Visite
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">
            
            <div class="flex flex-col sm:flex-row gap-4 mb-8 justify-between items-center">
                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500"></i>
                    <input type="text" placeholder="Rechercher une visite..." class="w-full bg-[#151515] border border-gray-700 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:border-gold focus:outline-none text-gray-300">
                </div>
                
                <div class="flex bg-[#151515] p-1 rounded-lg border border-gray-700">
                    <button class="px-4 py-1.5 rounded text-xs font-bold bg-gray-700 text-white shadow">Toutes</button>
                </div>
            </div>

            <div id="tours_container" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            </div>
        </div>
    </main>

    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#111] w-full max-w-2xl rounded-xl border border-white/10 shadow-2xl p-8 relative animate-fade-in-up overflow-y-auto max-h-[90vh]">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
            <h2 class="font-serif text-2xl text-white mb-6">Modifier la Visite</h2>
            
            <form action="../../includes/guide/visite_action/edit_visite.php" method="POST" class="space-y-4">
                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Titre</label>
                        <input type="text" name="titre" id="edit_titre" required class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Prix (DH)</label>
                        <input type="number" name="prix" id="edit_prix" required class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Date & Heure</label>
                        <input type="datetime-local" name="date_heure_debut" id="edit_date" required class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Durée (min)</label>
                        <input type="number" name="duree_minutes" id="edit_duree" required class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Langue</label>
                        <select name="langue" id="edit_langue" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                            <option value="Français">Français</option>
                            <option value="Anglais">Anglais</option>
                            <option value="Arabe">Arabe</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Capacité Max</label>
                        <input type="number" name="capacity_max" id="edit_capacite" required class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Image (URL)</label>
                    <input type="text" name="tour_image" id="edit_image" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none">
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Description</label>
                    <textarea name="description" id="edit_desc" rows="3" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white focus:border-gold outline-none"></textarea>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-700 text-gray-400 rounded hover:text-white transition">Annuler</button>
                    <button type="submit" class="px-6 py-2 bg-gold text-black font-bold rounded hover:bg-white transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <div id="cancelModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#111] w-full max-w-sm rounded-xl border border-red-900/30 shadow-2xl p-6 relative animate-fade-in-up">
            <h3 class="font-serif text-xl text-white font-bold mb-2">Annuler la visite ?</h3>
            <p class="text-gray-400 text-sm mb-6">Cette action changera le statut de la visite en "Annulé". Les réservations existantes seront affectées.</p>
            
            <input type="hidden" id="cancel_id_input">
            
            <div class="flex gap-3">
                <button onclick="closeCancelModal()" class="flex-1 py-2 border border-gray-700 text-gray-300 rounded hover:text-white transition">Non, retour</button>
                <button onclick="confirmCancel()" class="flex-1 py-2 bg-red-600 text-white font-bold rounded hover:bg-red-700 transition">Oui, annuler</button>
            </div>
        </div>
    </div>

    <script>
        let toursList = [];

        getTours();

        function getTours(){
            let card;
            const tours_container = document.getElementById("tours_container");
            tours_container.innerHTML = ""; 
            
            let data = new FormData();
            data.append("gettours","");

            fetch("../../includes/guide/visite_data.php",{
                method:"POST",
                body:data
            })
            .then(response=>response.json())
            .then(data=>{
                toursList = data;

                data.forEach((e, i) => {
                    const tourDate = new Date(e.date_heure_debut);
                    const today = new Date();
                    
                    if(e.status == "cancelled"){
                        card = `<div class="bg-dark-card border border-red-900/20 rounded-xl p-6 shadow-lg opacity-75 grayscale hover:grayscale-0 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="bg-red-900/20 text-red-500 border border-red-900/30 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider mb-2 inline-block">Annulé</span>
                                <h3 class="font-serif text-xl text-white font-bold">${e.titre}</h3>
                                <p class="text-sm text-gray-500 mt-1"><i class="fa-regular fa-calendar mr-2 text-gray-500"></i>${e.date_heure_debut}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-bold text-gray-500">${e.prix} <span class="text-xs font-normal text-gray-600">DH</span></span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 border-t border-white/5 pt-4">
                            <button class="w-full py-2 text-center text-red-500 text-sm cursor-not-allowed font-bold">
                                <i class="fa-solid fa-ban mr-2"></i> Visite Annulée
                            </button>
                        </div>
                    </div>`
                    }
                    else if(e.status == "open" && tourDate >= today){
                        card = `<div class="bg-dark-card border border-white/5 rounded-xl p-6 shadow-lg hover:border-gold/30 transition group">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="bg-yellow-900/20 text-yellow-500 border border-yellow-900/30 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider mb-2 inline-block">En attente</span>
                                <h3 class="font-serif text-xl text-white font-bold group-hover:text-gold transition">${e.titre}</h3>
                                <p class="text-sm text-gray-500 mt-1"><i class="fa-regular fa-calendar mr-2 text-gold"></i> ${e.date_heure_debut}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-bold text-white">${e.prix} <span class="text-xs font-normal text-gray-500">DH</span></span>
                                <span class="text-xs text-gray-500">par pers.</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Capacité</span>
                                <span class="text-white font-bold">${e.capacity_max} places</span>
                                <span class="text-yellow-500 font-bold" id="percent_${e.id}">0%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" id="bar_${e.id}" style="width: 0%"></div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 border-t border-white/5 pt-4">
                            <a href="guide_booking.php?tour_id=${e.id}" class="flex-1 py-2 text-center bg-white/5 hover:bg-white/10 rounded text-sm text-white font-medium transition">
                                <i class="fa-solid fa-users mr-2"></i> Voir les inscrits
                            </a>
                            <button onclick="openEditModal(${i})" class="w-10 h-10 flex items-center justify-center rounded border border-gray-700 hover:border-gold hover:text-gold transition" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button onclick="openCancelModal(${e.id})" class="w-10 h-10 flex items-center justify-center rounded border border-gray-700 hover:border-red-500 hover:text-red-500 transition" title="Annuler">
                                <i class="fa-solid fa-ban"></i>
                            </button>
                        </div>
                    </div>`
                    }
                    else if(e.status == "full" && tourDate >= today){
                        card = `
                <div class="bg-dark-card border border-white/5 rounded-xl p-6 shadow-lg hover:border-gold/30 transition group">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="bg-green-900/20 text-green-500 border border-green-900/30 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider mb-2 inline-block">Confirmé</span>
                                <h3 class="font-serif text-xl text-white font-bold group-hover:text-gold transition">${e.titre}</h3>
                                <p class="text-sm text-gray-500 mt-1"><i class="fa-regular fa-calendar mr-2 text-gold"></i> ${e.date_heure_debut}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-bold text-white">${e.prix} <span class="text-xs font-normal text-gray-500">DH</span></span>
                                <span class="text-xs text-gray-500">par pers.</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-400">Capacité</span>
                                <span class="text-white font-bold">${e.capacity_max} places</span>
                                <span class="text-green-500 font-bold" id="percent_${e.id}">0%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" id="bar_${e.id}" style="width: 0%"></div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 border-t border-white/5 pt-4">
                            <a href="guide_booking.php?tour_id=${e.id}" class="flex-1 py-2 text-center bg-white/5 hover:bg-white/10 rounded text-sm text-white font-medium transition">
                                <i class="fa-solid fa-users mr-2"></i> Voir les inscrits
                            </a>
                            <button onclick="openEditModal(${i})" class="w-10 h-10 flex items-center justify-center rounded border border-gray-700 hover:border-gold hover:text-gold transition" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button onclick="openCancelModal(${e.id})" class="w-10 h-10 flex items-center justify-center rounded border border-gray-700 hover:border-red-500 hover:text-red-500 transition" title="Annuler">
                                <i class="fa-solid fa-ban"></i>
                            </button>
                        </div>
                    </div>`
                    }
                    else if(tourDate < today){
                        card = `<div class="bg-dark-card border border-white/5 rounded-xl p-6 shadow-lg opacity-75 grayscale hover:grayscale-0 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="bg-gray-800 text-gray-400 border border-gray-700 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider mb-2 inline-block">Terminé</span>
                                <h3 class="font-serif text-xl text-white font-bold">${e.titre}</h3>
                                <p class="text-sm text-gray-500 mt-1"><i class="fa-regular fa-calendar mr-2 text-gray-500"></i>${e.date_heure_debut}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-bold text-gray-400">${e.prix} <span class="text-xs font-normal text-gray-600">DH</span></span>
                            </div>
                        </div>

                        <div class="mb-6 grid grid-cols-2 gap-4">
                            <div class="bg-black/30 p-2 rounded border border-white/5 text-center">
                                <p class="text-xs text-gray-500 uppercase">Revenus</p>
                                <p class="text-gold font-bold"> - </p>
                            </div>
                            <div class="bg-black/30 p-2 rounded border border-white/5 text-center">
                                <p class="text-xs text-gray-500 uppercase">Note</p>
                                <p class="text-yellow-500 font-bold"><i class="fa-solid fa-star mr-1"></i> -</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 border-t border-white/5 pt-4">
                            <button class="w-full py-2 text-center text-gray-500 text-sm cursor-not-allowed">
                                Archivé
                            </button>
                        </div>
                    </div>`
                }
                    
                tours_container.insertAdjacentHTML("afterbegin",card);

                });
                // After rendering, fetch reservations for each tour and update percentage
                data.forEach((e) => {
                    fetch(`../../includes/guide/get_tour_reservations.php?tour_id=${e.id}`)
                        .then(res => res.text())
                        .then(count => {
                            let percent = 0;
                            if (e.capacity_max > 0) {
                                percent = Math.round((parseInt(count) / e.capacity_max) * 100);
                                if (percent > 100) percent = 100;
                                if (percent < 0) percent = 0;
                            }
                            const percentSpan = document.getElementById(`percent_${e.id}`);
                            const barDiv = document.getElementById(`bar_${e.id}`);
                            if (percentSpan) percentSpan.innerText = percent + '%';
                            if (barDiv) barDiv.style.width = percent + '%';
                        });
                });
            })
        }


        function openEditModal(index) {
            const data = toursList[index];
            
            document.getElementById('editModal').classList.remove('hidden');
            
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_titre').value = data.titre;
            document.getElementById('edit_prix').value = data.prix;
            document.getElementById('edit_date').value = data.date_heure_debut;
            document.getElementById('edit_duree').value = data.duree_minutes;
            document.getElementById('edit_langue').value = data.langue;
            document.getElementById('edit_capacite').value = data.capacity_max;
            document.getElementById('edit_desc').value = data.description;
            document.getElementById('edit_image').value = data.tour_image || '';
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openCancelModal(id) {
            document.getElementById('cancel_id_input').value = id;
            document.getElementById('cancelModal').classList.remove('hidden');
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
        }

        function confirmCancel() {
            const id = document.getElementById('cancel_id_input').value;
            let formData = new FormData();
            formData.append("id", id);
            
            fetch("../../includes/guide/visite_action/cancel_visite.php", {
                method: "POST",
                body: formData
            }).then(res => {
                closeCancelModal();
                getTours();
            });
        }
    </script>
</body>
</html> 