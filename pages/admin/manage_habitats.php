<?php
require_once("../../includes/auth/guard.php");
require_role("admin");

?>
<!DOCTYPE html>
<html lang="fr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Habitats | Admin ASSAD</title>

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
            <a href="manage_habitats.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold transition">
                <i class="fa-solid fa-tree w-6"></i>
                <span class="text-sm font-medium">Habitats</span>
            </a>
            <a href="manage_tours.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
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
            <h1 class="font-serif text-2xl text-white font-bold">Gestion des Habitats</h1>

            <button onclick="openModal('add')" class="bg-gold text-black font-bold px-4 py-2 rounded shadow hover:bg-white transition flex items-center gap-2 text-sm">
                <i class="fa-solid fa-plus"></i> Nouvel Habitat
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">

            <div class="bg-dark-card border border-white/5 rounded-xl overflow-hidden shadow-lg">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-black text-gray-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Nom de l'Habitat</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="h_container" class="divide-y divide-white/5">




                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="habitatModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#111] w-full max-w-lg rounded-xl border border-white/10 shadow-2xl p-8 relative animate-fade-in-up">

            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h2 id="modalTitle" class="font-serif text-2xl text-white mb-6">Ajouter un Habitat</h2>

            <form action="../../includes/admin/habitat_actions/process_habitat.php" method="POST"  class="space-y-4">
                <input type="hidden" name="id" id="habitatId">
                <input type="hidden" name="action" id="formAction" value="add">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Nom de l'Habitat</label>
                        <input type="text" name="nom" id="nom" required class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Zone du Zoo</label>
                        <select name="zone_zoo" id="zone" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                            <option value="nord">Zone Nord</option>
                            <option value="sud">Zone Sud</option>
                            <option value="est">Zone Est</option>
                            <option value="ouest">Zone Ouest</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Type de Climat</label>
                    <select name="type_climat" id="climate" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                        <option value="aride">Aride / Sec</option>
                        <option value="tropical">Tropical / Humide</option>
                        <option value="tempere">Tempéré</option>
                        <option value="froid">Froid / Montagneux</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Description</label>
                    <textarea name="description" id="desc" rows="3" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Image de couverture</label>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Lien de l'image (URL)</label>
                        <input type="text" name="image" id="imageInput" placeholder="https://exemple.com/mon-image.jpg" required
                            class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                    </div>
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-700 text-gray-400 rounded hover:text-white transition">Annuler</button>
                    <button type="submit" class="px-6 py-2 bg-gold text-black font-bold rounded hover:bg-white transition">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('habitatModal');
        const modalTitle = document.getElementById('modalTitle');
        const formAction = document.getElementById('formAction');
        const habitatId = document.getElementById('habitatId');
        
        const nomInput = document.getElementById('nom');
        const descInput = document.getElementById('desc');
        const climateInput = document.getElementById('climate');
        const zoneInput = document.getElementById('zone');
        const imageInput = document.getElementById('imageInput');

        function openModal(mode, data = null) {
            modal.classList.remove('hidden');
            
            if (mode === 'edit' && data) {
                modalTitle.innerText = "Modifier Habitat";
                formAction.value = "update";
                habitatId.value = data.id;
                
                
                nomInput.value = data.nom;
                descInput.value = data.description;
                climateInput.value = data.typeclimat || 'aride'; 
                zoneInput.value = data.zonezoo || 'nord';
                if(imageInput) imageInput.value = data.image || '';
            } else {
                modalTitle.innerText = "Ajouter un Habitat";
                formAction.value = "add";
                // Reset
                nomInput.value = "";
                descInput.value = "";
                climateInput.value = "aride";
                if(imageInput) imageInput.value = "";
            }
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        getHabitats();

        function getHabitats(){
            const h_container = document.getElementById("h_container");
            h_container.innerHTML = ""; 

            let data = new FormData();
            data.append("habitat","");

            fetch("../../includes/admin/habitat_data.php",{
                method : "POST",
                body : data
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(function(e){
                    
                    const safeName = e.nom.replace(/'/g, "\\'");
                    const safeDesc = e.description.replace(/'/g, "\\'");

                    const card = `
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <img src="${e.image}" class="w-16 h-10 rounded-md object-cover border border-gray-700" onerror="this.src='https://via.placeholder.com/150'">
                            </td>
                            <td class="px-6 py-4 font-bold text-white">${e.nom}</td>
                            <td class="px-6 py-4 truncate max-w-xs">${e.description}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button onclick="openModal('edit', {id:${e.id}, nom:'${safeName}', description:'${safeDesc}', typeclimat:'${e.typeclimat}', zonezoo:'${e.zonezoo}', image:'${e.image}'})" 
                                            class="w-8 h-8 rounded border border-gray-600 hover:border-gold hover:text-gold transition flex items-center justify-center">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    
                                    <button onclick="deleteHabitat(${e.id})" class="w-8 h-8 rounded border border-gray-600 hover:border-red-500 hover:text-red-500 transition flex items-center justify-center">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>`;

                    h_container.insertAdjacentHTML("afterbegin", card);
                })
            })
            .catch(error => console.error('Erreur:', error));
        }

        function deleteHabitat(id) {
            if(!confirm("Êtes-vous sûr de vouloir supprimer cet habitat ?")) return;

            let formData = new FormData();
            formData.append("id", id);

            fetch("../../includes/admin/habitat_actions/delete_habitat.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(res => {
                if (res.trim() === "success") {
                    getHabitats(); 
                } else {
                    alert("Erreur lors de la suppression: " + res);
                }
            })
            .catch(err => console.error(err));
        }
    </script>
</body>

</html>