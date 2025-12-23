<?php 
require_once("../../includes/auth/guard.php");
require_role("guide");

?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Visite | Espace Guide</title>
    
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
                        'dark-panel': '#121212',
                    }
                }
            }
        }
    </script>
    <style>
        .dash-input {
            background-color: #0a0a0a;
            border: 1px solid #333;
            color: white;
            transition: all 0.3s;
        }
        .dash-input:focus {
            border-color: #C6A87C;
            box-shadow: 0 0 0 1px #C6A87C;
            outline: none;
        }
        /* Animation for wizard steps */
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
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
            <a href="guide_tours.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-list w-6"></i>
                <span class="text-sm font-medium">Mes Visites</span>
            </a>
            <a href="guide_create.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold">
                <i class="fa-solid fa-plus w-6"></i>
                <span class="text-sm font-medium">Créer Visite</span>
            </a>
            <a href="guide_booking.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
                <i class="fa-solid fa-ticket w-6"></i>
                <span class="text-sm font-medium">Réservations</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        
        <header class="h-20 bg-[#0a0a0a] border-b border-white/5 flex items-center justify-between px-8">
            <h1 class="font-serif text-2xl text-white font-bold">Nouvelle Expédition</h1>
            <div class="flex items-center gap-4 text-sm">
                <div id="ind-step1" class="flex items-center gap-2 text-gold font-bold transition-all">
                    <span class="w-6 h-6 rounded-full border border-gold flex items-center justify-center text-xs">1</span>
                    <span>Informations</span>
                </div>
                <div class="w-10 h-[1px] bg-gray-700"></div>
                <div id="ind-step2" class="flex items-center gap-2 text-gray-600 transition-all">
                    <span class="w-6 h-6 rounded-full border border-gray-700 flex items-center justify-center text-xs">2</span>
                    <span>Parcours (Étapes)</span>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">
            
<div id="step1" class="fade-in space-y-8">

    <div class="bg-dark-panel border border-white/10 rounded-xl p-8">
        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Média</h3>
        <div class="flex items-start gap-6">
            <div class="w-32 h-32 bg-black border border-gray-700 rounded-lg overflow-hidden flex items-center justify-center shrink-0">
                <i class="fa-solid fa-link text-2xl text-gray-600"></i>
            </div>
            <div class="flex-1">
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">URL de l'image</label>
                <input id="input_image" type="text" name="image" placeholder="https://example.com/image.jpg" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white placeholder-gray-600 focus:border-gold focus:outline-none">
                <p class="text-xs text-gray-600 mt-2">Collez le lien direct vers l'image de couverture.</p>
            </div>
        </div>
    </div>

    <div class="bg-dark-panel border border-white/10 rounded-xl p-8">
        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Détails Principaux</h3>
        
        <div class="grid grid-cols-1 gap-6 mb-6">
            <div>
                <label  class="block text-xs uppercase text-gray-500 font-bold mb-1">Titre de la visite</label>
                <input id="input_title" type="text" name="titre" required placeholder="Ex: Safari Nocturne" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none">
            </div>
            <div>
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Description</label>
                <textarea id="input_description" name="description" rows="3" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none"></textarea>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Date & Heure Début</label>
                <input id="input_date" type="datetime-local" name="date_heure_debut" required class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none">
            </div>
            
            <div>
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Durée (Minutes)</label>
                <input id="input_duree" type="number" name="duree_minutes" placeholder="90" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none">
            </div>
            
            <div>
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Prix (DH)</label>
                <input id="input_prix" type="number" step="0.01" name="prix" placeholder="150" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none">
            </div>

            <div>
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Langue</label>
                <select id="input_langue" name="langue" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none">
                    <option value="Français">Français</option>
                    <option value="Anglais">Anglais</option>
                    <option value="Arabe">Arabe</option>
                    <option value="Espagnol">Espagnol</option>
                </select>
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-xs uppercase text-gray-500 font-bold mb-1">Capacité Max</label>
                <input id="input_capacity" type="number" name="capacity_max" placeholder="20" class="dash-input w-full rounded-lg px-4 py-3 text-sm bg-black border border-gray-700 text-white focus:border-gold focus:outline-none">
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="button" onclick="goToStep(2)" class="bg-gold text-black font-bold px-8 py-3 rounded shadow hover:bg-white transition flex items-center gap-2">
            Suivant : Définir le Parcours <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
</div>

                <div id="step2" class="fade-in hidden space-y-8">
                    
                    <div class="bg-dark-panel border border-white/10 rounded-xl p-8">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest">Le Parcours</h3>
                                <p class="text-xs text-gray-400 mt-1">Définissez les étapes clés de la visite pour vos clients.</p>
                            </div>
                            <button type="button" onclick="addStep()" class="text-xs border border-gold text-gold px-3 py-1.5 rounded hover:bg-gold hover:text-black transition">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter une étape
                            </button>
                        </div>

                        <div id="stepsContainer" class="space-y-4">
                            
                            <div class="step-item bg-black border border-gray-800 rounded-lg p-4 relative">
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gold rounded-l-lg"></div>
                                <div class="flex gap-4">
                                    <div class="flex-1">
                                        <label class="text-[10px] uppercase text-gray-500 font-bold">Titre de l'étape</label>
                                        <input id="title_step_0" type="text" name="steps[0][title]" placeholder="Ex: Rencontre avec les Lions" class="bg-transparent border-b border-gray-700 w-full text-white text-sm py-1 focus:border-gold focus:outline-none">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input id="description_step_0"  type="text" name="steps[0][desc]" placeholder="Description de l'activité..." class="bg-transparent text-gray-500 text-xs w-full focus:outline-none">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <button type="button" onclick="goToStep(1)" class="text-gray-500 hover:text-white transition flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i> Retour
                        </button>
                        <button id="submit_btn" type="submit" class="bg-green-600 text-white font-bold px-8 py-3 rounded shadow hover:bg-green-500 transition flex items-center gap-2">
                            <i class="fa-solid fa-check"></i> Finaliser et Publier
                        </button>
                    </div>
                </div>

        </div>
    </main>

    <script>

        const input_image = document.getElementById("input_image");
        const input_title = document.getElementById("input_title");
        const input_description = document.getElementById("input_description");
        const input_date = document.getElementById("input_date");
        const input_duree = document.getElementById("input_duree"); 
        const input_prix = document.getElementById("input_prix");
        const input_langue = document.getElementById("input_langue");
        const input_capacity = document.getElementById("input_capacity");

        let imageValue = "";
        let titleValue = "";
        let descriptionValue = "";
        let dateValue = "";
        let dureeValue = "";
        let prixValue = "";
        let langueValue = "";
        let capacityValue = "";

        // 1. Wizard Logic
        function goToStep(stepNumber) {
            imageValue = input_image.value;
            titleValue = input_title.value;
            descriptionValue = input_description.value;
            dateValue = input_date.value;
            dureeValue = input_duree.value;
            prixValue = input_prix.value;
            langueValue = input_langue.value;
            capacityValue = input_capacity.value;
            if (!imageValue || !titleValue || !descriptionValue || !dateValue || !dureeValue || !prixValue || !langueValue || !capacityValue) {
                alert("Please fill in all fields before continuing.");
                return;
            }
            else{
                            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const ind1 = document.getElementById('ind-step1');
            const ind2 = document.getElementById('ind-step2');

            if(stepNumber === 2) {
                step1.classList.add('hidden');
                step2.classList.remove('hidden');
                
                // Update Indicators
                ind1.classList.remove('text-gold', 'font-bold');
                ind1.classList.add('text-gray-600');
                
                ind2.classList.remove('text-gray-600');
                ind2.classList.add('text-gold', 'font-bold');
            } else {
                step2.classList.add('hidden');
                step1.classList.remove('hidden');

                // Update Indicators
                ind2.classList.remove('text-gold', 'font-bold');
                ind2.classList.add('text-gray-600');
                
                ind1.classList.remove('text-gray-600');
                ind1.classList.add('text-gold', 'font-bold');
            }
            }
        }

        // 2. Image Preview Logic
        function previewImage(input) {
            const preview = document.getElementById('imgPreview');
            const icon = document.getElementById('imgIcon');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    icon.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // 3. Dynamic Steps Logic
        let steps =[];
        let stepCount = 1;
        function addStep() {
            const container = document.getElementById('stepsContainer');
            const newStep = document.createElement('div');
            newStep.className = 'step-item bg-black border border-gray-800 rounded-lg p-4 relative fade-in';
            newStep.innerHTML = `
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gray-700 rounded-l-lg"></div>
                <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500"><i class="fa-solid fa-trash text-xs"></i></button>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="text-[10px] uppercase text-gray-500 font-bold">Titre de l'étape</label>
                        <input id="title_step_${stepCount}" type="text" name="steps[${stepCount}][title]" placeholder="Nouvelle étape" class="bg-transparent border-b border-gray-700 w-full text-white text-sm py-1 focus:border-gold focus:outline-none">
                    </div>
                </div>
                <div class="mt-2"> 
                    <input id="description_step_${stepCount}" type="text" name="steps[${stepCount}][desc]" placeholder="Description..." class="bg-transparent text-gray-500 text-xs w-full focus:outline-none">
                </div>
            `;
            container.appendChild(newStep);
            stepCount++;

            
        }

        // send creating 

        const submit_btn = document.getElementById("submit_btn");
        submit_btn.addEventListener("click",function(){

            let data = new FormData();
            data.append("image", imageValue);
            data.append("title", titleValue);
            data.append("description", descriptionValue);
            data.append("date", dateValue);
            data.append("duree", dureeValue);
            data.append("prix", prixValue);
            data.append("langue", langueValue);
            data.append("capacity", capacityValue);
            data.append("guide_id",<?= $_SESSION["id"] ?>)

            fetch("../../includes/guide/visite_action/create_visite.php",{
                method:"POST",
                body:data
            })
            .then(response=>response.text())
            .then(data=>{
                if(data == "problem"){
                    window.location.href = "guide_dashboard?message=added";
            }
            else{
                for(let i = 0 ; i < stepCount ; i++){
                    const title = document.getElementById(`title_step_${i}`)
                    const description = document.getElementById(`description_step_${i}`);
                    let stepdata = new FormData();
                    stepdata.append("step_title",title.value);
                    stepdata.append("step_description",description.value);
                    stepdata.append("step_order",i);
                    stepdata.append("tour_id",data);
                    fetch("../../includes/guide/visite_action/add_tourSteps.php",{
                        method:"POST",
                        body:stepdata
                    })
                    .then(response=>response.text())
                    .then(data=>{
                        if(data == "problem"){
                            console.log(data);
                        }
                        else{
                            window.location.href = "guide_dashboard.php?message=done";
                        }
                    })
                }
            }
           
        });
    })
    </script>
</body>
</html>