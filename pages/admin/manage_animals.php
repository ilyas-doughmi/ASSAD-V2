<?php
require_once("../../includes/auth/guard.php");
require_role("admin");

?>
<!DOCTYPE html>
<html lang="fr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Animaux | Admin ASSAD</title>

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
            <a href="manage_animals.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold transition">
                <i class="fa-solid fa-paw w-6"></i>
                <span class="text-sm font-medium">Animaux</span>
            </a>
            <a href="manage_habitats.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
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
            <h1 class="font-serif text-2xl text-white font-bold">Catalogue Animaux</h1>

            <button onclick="openModal('add')" class="bg-gold text-black font-bold px-4 py-2 rounded shadow hover:bg-white transition flex items-center gap-2 text-sm">
                <i class="fa-solid fa-plus"></i> Ajouter un Animal
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">

            <div class="flex flex-col sm:flex-row gap-4 mb-6 justify-between items-center">
                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher..." class="w-full bg-[#151515] border border-gray-700 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:border-gold focus:outline-none text-gray-300">
                </div>
                <select id="habitatFilter" class="bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded-lg px-4 py-2.5 focus:border-gold focus:outline-none">
                    <option value="all" selected>Tous les Habitats</option>
                </select>
            </div>

            <div class="bg-dark-card border border-white/5 rounded-xl overflow-hidden shadow-lg">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-black text-gray-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Image</th>
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4">Description</th>
                            <th class="px-6 py-4">Alimentation</th>
                            <th class="px-6 py-4">Pays</th>
                            <th class="px-6 py-4">Habitat</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="animals_container" class="divide-y divide-white/5">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="animalModal" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-[#111] w-full max-w-lg rounded-xl border border-white/10 shadow-2xl p-8 relative animate-fade-in-up">

            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <h2 id="modalTitle" class="font-serif text-2xl text-white mb-6">Ajouter un Animal</h2>

            <div class="space-y-4">
                <input type="hidden" id="animalId">
                <input type="hidden" id="formAction" value="add">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Nom</label>
                        <input type="text" id="nom" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Espèce</label>
                        <input type="text" id="espece" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Habitat</label>
                        <select id="habitat_container" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                            
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Pays d'origine</label>
                        <input type="text" id="pays" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                    </div>
                </div>
                
                <div>
                     <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Alimentation</label>
                     <input type="text" id="alimentation" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Description courte</label>
                    <textarea id="description" rows="3" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Image URL</label>
                    <input type="text" id="image" class="w-full bg-black border border-gray-700 rounded px-3 py-2 text-white text-sm focus:border-gold focus:outline-none" placeholder="https://exemple.com/image.jpg">
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-700 text-gray-400 rounded hover:text-white transition">Annuler</button>
                    <button type="button" onclick="saveAnimal()" class="px-6 py-2 bg-gold text-black font-bold rounded hover:bg-white transition">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    const modal = document.getElementById('animalModal');
    const modalTitle = document.getElementById('modalTitle');
    const formAction = document.getElementById('formAction');
    const animalId = document.getElementById('animalId');

    const nomInput = document.getElementById('nom');
    const especeInput = document.getElementById('espece');
    const paysInput = document.getElementById('pays');
    
    const habitatInput = document.getElementById('habitat_container'); 
    
    const descriptionInput = document.getElementById('description');
    const alimentationInput = document.getElementById('alimentation');
    const imageInput = document.getElementById('image');
    const habitatFilter = document.getElementById("habitatFilter");

    getAnimals();
    getHabitats("filter"); 

    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#animals_container tr');
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    document.getElementById('habitatFilter').addEventListener('change', function() {
        console.log("Filter changed to: " + this.value);
    });

    function openModal(mode, data = null) {
        modal.classList.remove('hidden');
        
        getHabitats("modal"); 

        if (mode === 'edit' && data) {
            modalTitle.innerText = "Modifier Animal";
            formAction.value = "update";
            animalId.value = data.id;

            nomInput.value = data.name;
            especeInput.value = data.species;
            paysInput.value = data.country;
            
            habitatInput.value = data.habitat; 
            
            descriptionInput.value = data.description;
            alimentationInput.value = data.alimentation;
            imageInput.value = data.image;
        } else {
            modalTitle.innerText = "Ajouter un Animal";
            formAction.value = "add";
            
            nomInput.value = "";
            especeInput.value = "";
            paysInput.value = "";
            habitatInput.value = ""; 
            descriptionInput.value = "";
            alimentationInput.value = "";
            imageInput.value = "";
        }
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    function saveAnimal() {
        const formData = new FormData();
        formData.append("nom", nomInput.value);
        formData.append("espece", especeInput.value);
        formData.append("pays", paysInput.value);
        formData.append("habitat_id", habitatInput.value);
        formData.append("description", descriptionInput.value);
        formData.append("alimentation", alimentationInput.value);
        formData.append("image", imageInput.value);
        
        let url = "";
        if(formAction.value === 'update'){
            url = "../../includes/admin/animals_actions/edit_animal.php";
            formData.append("id", animalId.value);
        } else {
            url = "../../includes/admin/animals_actions/create_animal.php";
        }

        fetch(url, {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            closeModal();
            getAnimals();
        });
    }

    function deleteAnimal(id) {
        if(confirm("Êtes-vous sûr de vouloir supprimer cet animal ?")) {
            let data = new FormData();
            data.append("id", id);
            fetch("../../includes/admin/animals_actions/delete_animal.php", {
                method: "POST",
                body: data
            })
            .then(response => response.text())
            .then(() => getAnimals());
        }
    }

    function getAnimals() {
        const animals_container = document.getElementById("animals_container");
        let data = new FormData();
        data.append("animals", "");

        fetch("../../includes/admin/animal_data.php", {
                method: "POST",
                body: data
            })
            .then(response => response.json())
            .then(data => {
                animals_container.innerHTML = "";
                data.forEach(function(e) {
                    let name = "text_"+ e.id;

                    const card = `  <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <img src="${e.image}" class="w-12 h-12 rounded-lg object-cover border border-gray-700">
                        </td>
                        <td class="px-6 py-4 font-bold text-white">${e.nom}</td>
                        <td class="px-6 py-4 text-xs italic text-gray-500 truncate max-w-xs">${e.description_courte}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded bg-gray-700 text-gray-300 text-xs font-bold">${e.alimentation}</span>
                        </td>
                        <td class="px-6 py-4">${e.pays_origin}</td>
                        <td class="px-6 py-4" id="${name}">${loadHabitatName(e.habitat_id,name)}</td>

                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick='openModal("edit", {
                                    id: ${e.id},
                                    name: "${e.nom}",
                                    species: "${e.espece}",
                                    country: "${e.pays_origin}",
                                    habitat: ${e.habitat_id},
                                    alimentation: "${e.alimentation}",
                                    description: "${e.description_courte}",
                                    image: "${e.image}"
                                })' class="w-8 h-8 rounded border border-gray-600 hover:border-gold hover:text-gold transition flex items-center justify-center">
                                <i class="fa-solid fa-pen"></i>
                                </button>

                                <button onclick="deleteAnimal(${e.id})" class="w-8 h-8 rounded border border-gray-600 hover:border-red-500 hover:text-red-500 transition flex items-center justify-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>`
                    animals_container.insertAdjacentHTML("afterbegin", card);
                })
            })
    }

    function getHabitats(target){
        let data = new FormData();
        data.append("habitat","");

        fetch("../../includes/admin/habitat_data.php",{
            method : "POST",
            body : data
        })
        .then(response=>response.json())
        .then(data=>{
            let container;
            
            if(target === 'filter') {
                container = document.getElementById("habitatFilter");
                container.innerHTML = '<option value="all" selected>Tous les Habitats</option>';
            } else {
                container = document.getElementById("habitat_container");
                container.innerHTML = '';
            }
            
            data.forEach(function(e){
                const card = `<option value="${e.id}">${e.nom}</option>`
                container.insertAdjacentHTML("beforeend", card);
            })
        });
    }


   function loadHabitatName(habitatId, elementId) {
    let data = new FormData();
    data.append("habitat_id", habitatId);

    fetch("../../includes/admin/habitat_actions/gethabitatName.php", {
            method: "POST",
            body: data
        })
        .then(response => response.text())
        .then(name => {
            let cell = document.getElementById(elementId);
            if (cell) {
                cell.innerText = name;
            }
        });
}
</script>
</body>
</html>