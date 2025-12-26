<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Nos Visites | ASSAD Zoo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Outfit"', 'sans-serif'], serif: ['"Cinzel"', 'serif'] },
                    colors: { gold: '#C6A87C', dark: '#050505' }
                }
            }
        }
    </script>
</head>
<body class="bg-dark text-gray-100 font-sans">


    <?php include(dirname(__DIR__).'/includes/visitor_nav.php'); ?>

    <header class="pt-32 pb-12 px-6 text-center bg-[#0a0a0a]">
        <h1 class="font-serif text-4xl text-white font-bold mb-4">Expéditions Guidées</h1>
        <p class="text-gray-400 max-w-2xl mx-auto">Rejoignez nos guides experts pour une immersion en direct au cœur de la savane et de la jungle.</p>
    </header>

    <div class="sticky top-20 z-40 bg-black/95 border-y border-white/10 py-4 px-6">
        <div class="max-w-7xl mx-auto flex flex-wrap gap-4 justify-center md:justify-between items-center">
            <div class="relative w-full md:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500"></i>
                <input type="text" id="searchInput" placeholder="Rechercher une visite..." class="w-full bg-[#151515] border border-gray-700 rounded pl-10 pr-4 py-2 text-sm focus:border-gold outline-none">
            </div>
            <div class="flex gap-4">
                <select id="langueFilter" class="bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded px-4 py-2 focus:border-gold outline-none">
                    <option value="">Toutes les langues</option>
                    <option value="Français">Français</option>
                    <option value="Anglais">Anglais</option>
                    <option value="Arabe">Arabe</option>
                    <option value="Espagnol">Espagnol</option>
                </select>
                <input type="date" id="dateFilter" class="bg-[#151515] border border-gray-700 text-gray-300 text-sm rounded px-4 py-2 focus:border-gold outline-none">
            </div>
        </div>
    </div>

    <div id="tour_container" class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        
      


    </div>

    <script>
        let allTours = [];
        
        showTours();
        
        // Add event listeners for filters
        document.getElementById('searchInput').addEventListener('input', filterTours);
        document.getElementById('langueFilter').addEventListener('change', filterTours);
        document.getElementById('dateFilter').addEventListener('change', filterTours);
        
        function showTours(){
            const tour_container = document.getElementById("tour_container");
            let data = new FormData();
            data.append("gettours","");

            fetch("../includes/visitor/visites_data.php",{
                method:"POST",
                body:data
            })
            .then(response=>response.json())
            .then(data=>{
                allTours = data;
                displayTours(allTours);
            })
        }
        
        function displayTours(tours){
            const tour_container = document.getElementById("tour_container");
            tour_container.innerHTML = "";
            
            if(tours.length === 0){
                tour_container.innerHTML = '<div class="col-span-3 text-center py-12 text-gray-500">Aucune visite trouvée</div>';
                return;
            }
            
            tours.forEach(function(e){
                const remainingCapacity = e.remaining_capacity || 0;
                const capacityClass = remainingCapacity > 10 ? 'text-green-400' : remainingCapacity > 0 ? 'text-yellow-400' : 'text-red-400';
                const capacityText = remainingCapacity > 0 ? `${remainingCapacity} places` : 'Complet';
                
                const card = `<div class="bg-[#111] border border-white/5 rounded-xl overflow-hidden group hover:border-gold/50 transition">
            <div class="h-56 relative overflow-hidden">
                <img src="${e.tour_image}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute top-4 left-4 bg-green-900/80 text-green-400 text-[10px] font-bold px-2 py-1 rounded border border-green-500/30">DISPONIBLE</div>
                <div class="absolute top-4 right-4 bg-black/80 ${capacityClass} text-[10px] font-bold px-2 py-1 rounded border border-white/20">${capacityText}</div>
            </div>
            <div class="p-6">
                <h3 class="font-serif text-xl text-white mb-2 group-hover:text-gold transition">${e.titre}</h3>
                <div class="flex gap-4 text-xs text-gray-400 mb-4">
                    <span><i class="fa-regular fa-clock text-gold mr-1"></i>${e.date_heure_debut}</span>
                    <span><i class="fa-solid fa-language text-gold mr-1"></i> ${e.langue}</span>
                </div>
                <div class="flex justify-between items-center border-t border-white/10 pt-4">
                    <span class="text-xl font-bold text-white">${e.prix} DH</span>
                    <a href="tour_details.php?id=${e.id}" class="text-gold text-sm font-bold hover:underline">Voir détails <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>`;

                tour_container.insertAdjacentHTML("beforeend",card);
            });
        }
        
        function filterTours(){
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const langueFilter = document.getElementById('langueFilter').value;
            const dateFilter = document.getElementById('dateFilter').value;
            
            let filteredTours = allTours.filter(tour => {
                const matchesSearch = tour.titre.toLowerCase().includes(searchTerm) || 
                                    tour.description.toLowerCase().includes(searchTerm);
                const matchesLangue = !langueFilter || tour.langue === langueFilter;
                const matchesDate = !dateFilter || tour.date_heure_debut.includes(dateFilter);
                
                return matchesSearch && matchesLangue && matchesDate;
            });
            
            displayTours(filteredTours);
        }
    </script>
</body>
</html>