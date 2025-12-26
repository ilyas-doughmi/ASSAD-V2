<?php 
require_once("../../includes/auth/guard.php");
require_role("admin");

?>

<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | ASSAD Zoo</title>
    
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
                        'dark-hover': '#1a1a1a'
                    }
                }
            }
        }
    </script>
    <style>
        /* CSS-Only Simple Charts */
        .chart-bar {
            transition: height 1s ease-out;
        }
        .chart-bar:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body class="bg-dark text-gray-100 font-sans h-screen flex overflow-hidden selection:bg-gold selection:text-black">

    <aside class="w-64 bg-black border-r border-white/10 hidden md:flex flex-col z-20">
        <div class="h-20 flex items-center px-8 border-b border-white/5 bg-gold/5">
            <i class="fa-solid fa-crown text-gold text-xl mr-3"></i>
            <span class="font-serif font-bold text-lg tracking-widest text-white">ASSAD ADMIN</span>
        </div>

        <nav class="flex-1 py-6 space-y-1 overflow-y-auto">
            <p class="px-8 text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 mt-2">Principal</p>
            
            <a href="admin_dashboard.php" class="flex items-center px-8 py-3 text-gold bg-gold/10 border-r-4 border-gold">
                <i class="fa-solid fa-chart-line w-6"></i>
                <span class="text-sm font-medium">Statistiques</span>
            </a>
            
            <p class="px-8 text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 mt-6">Gestion</p>

            <a href="manage_users.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition group">
                <i class="fa-solid fa-users w-6 group-hover:text-gold transition"></i>
                <span class="text-sm font-medium">Utilisateurs</span>
            </a>

            <a href="manage_animals.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition group">
                <i class="fa-solid fa-paw w-6 group-hover:text-gold transition"></i>
                <span class="text-sm font-medium">Animaux</span>
            </a>

            <a href="manage_habitats.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition group">
                <i class="fa-solid fa-tree w-6 group-hover:text-gold transition"></i>
                <span class="text-sm font-medium">Habitats</span>
            </a>

            <a href="manage_tours.php" class="flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition group">
                <i class="fa-solid fa-compass w-6 group-hover:text-gold transition"></i>
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
        
        <header class="md:hidden h-16 bg-black border-b border-white/10 flex items-center justify-between px-4">
            <span class="font-serif font-bold text-gold">ADMIN PANEL</span>
            <button class="text-white"><i class="fa-solid fa-bars"></i></button>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10 bg-[#0a0a0a]">
            
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h1 class="font-serif text-3xl text-white font-bold">Vue d'ensemble</h1>
                    <p class="text-gray-500 text-sm mt-1">Données en temps réel du Zoo Virtuel.</p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                <div class="bg-dark-card border border-white/5 p-6 rounded-xl shadow-lg relative overflow-hidden group">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition">
                        <i class="fa-solid fa-users text-6xl text-white"></i>
                    </div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-2">Tout l'utilisateur</p>
                    <h3 class="text-3xl font-bold text-white" id="users_text"></h3>
                </div>

                <div class="bg-dark-card border border-gold/30 p-6 rounded-xl shadow-[0_0_15px_rgba(198,168,124,0.1)] relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10">
                        <i class="fa-solid fa-user-shield text-6xl text-gold"></i>
                    </div>
                    <p class="text-gold text-xs font-bold uppercase tracking-widest mb-2">Guides en Attente</p>
                    <h3 class="text-3xl font-bold text-white" id="not_active_count"></h3>
                    <p class="text-xs text-gray-400 mt-2">Action requise</p>
                </div>

                <div class="bg-dark-card border border-white/5 p-6 rounded-xl shadow-lg relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10">
                        <i class="fa-solid fa-paw text-6xl text-white"></i>
                    </div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-2">Animaux Recensés</p>
                    <h3 class="text-3xl font-bold text-white" id="animals_count"></h3>
                    <p class="text-xs text-gray-500 mt-2"><span id="h_count"></span> Habitats</p>
                </div>

                <div class="bg-dark-card border border-white/5 p-6 rounded-xl shadow-lg relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-10">
                        <i class="fa-solid fa-coins text-6xl text-white"></i>
                    </div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-2">Revenus Billetterie</p>
                    <?php
                    require_once '../../Classes/db.php';
                    $pdo = new db();
                    $stmt = $pdo->connect()->query("SELECT SUM(prix) as total FROM tours");
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $total = $result['total'] ?? 0;
                    ?>
                    <h3 class="text-3xl font-bold text-white"><?php echo number_format($total, 2); ?> <span class="text-sm font-normal text-gray-500">DH</span></h3>
                    <p class="text-xs text-green-500 mt-2">CAN 2025 Boost</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                
                <!-- Most Viewed Animals -->
                <div class="bg-dark-card border border-white/5 rounded-xl p-0 shadow-lg flex flex-col">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <h3 class="font-serif text-lg text-white font-bold">Animaux Populaires</h3>
                        <i class="fa-solid fa-eye text-gold"></i>
                    </div>

                    <div id="most_viewed_container" class="flex-1 overflow-y-auto p-4 space-y-3">                                         
                    </div>
                </div>

                <!-- Most Reserved Tours -->
                <div class="bg-dark-card border border-white/5 rounded-xl p-0 shadow-lg flex flex-col">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <h3 class="font-serif text-lg text-white font-bold">Visites Populaires</h3>
                        <i class="fa-solid fa-fire text-gold"></i>
                    </div>

                    <div id="most_reserved_container" class="flex-1 overflow-y-auto p-4 space-y-3">                                         
                    </div>
                </div>

                <div class="bg-dark-card border border-white/5 rounded-xl p-0 shadow-lg flex flex-col">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <h3 class="font-serif text-lg text-white font-bold">Approbations</h3>
                        <a href="manage_users.php" class="text-xs text-gold hover:underline">Voir tout</a>
                    </div>

                    <div id="app_container" class="flex-1 overflow-y-auto p-4 space-y-3">                                         

                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        getUsersCount();
        getAnimalsCount();
        getNotActiveUsers();
        getHabitatsCount();
        getMostViewedAnimals();
        getMostReservedTours();
        
        function getUsersCount(){
            const users_text = document.getElementById("users_text");
            let data = new FormData();
            data.append("users_count","all");
            fetch("../../includes/admin/users_data.php",{
                method : "POST",
                body : data
        })
        .then(response=>response.text())
        .then(data=>{
            users_text.innerText = data;
        })
        }

        function getMostViewedAnimals(){
            const container = document.getElementById("most_viewed_container");
            container.innerHTML = "";
            let data = new FormData();
            data.append("most_viewed_animals", "");
            data.append("limit", "5");
            
            fetch("../../includes/admin/statistics_data.php",{
                method: "POST",
                body: data
            })
            .then(response=>response.json())
            .then(data=>{
                if(data.length === 0){
                    container.innerHTML = '<p class="text-gray-500 text-sm text-center">Aucune donnée</p>';
                    return;
                }
                data.forEach(function(animal){
                    const card = `
                        <div class="bg-black/40 p-3 rounded-lg border border-white/5 flex items-center gap-3">
                            <img src="${animal.image}" class="w-12 h-12 rounded object-cover" alt="${animal.nom}">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-white">${animal.nom}</p>
                                <p class="text-xs text-gray-500">${animal.espece}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gold font-bold">${animal.vues || 0}</p>
                                <p class="text-xs text-gray-500">vues</p>
                            </div>
                        </div>`;
                    container.insertAdjacentHTML("beforeend", card);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                container.innerHTML = '<p class="text-red-500 text-sm text-center">Erreur de chargement</p>';
            });
        }

        function getMostReservedTours(){
            const container = document.getElementById("most_reserved_container");
            container.innerHTML = "";
            let data = new FormData();
            data.append("most_reserved_tours", "");
            data.append("limit", "5");
            
            fetch("../../includes/admin/statistics_data.php",{
                method: "POST",
                body: data
            })
            .then(response=>response.json())
            .then(data=>{
                if(data.length === 0){
                    container.innerHTML = '<p class="text-gray-500 text-sm text-center">Aucune donnée</p>';
                    return;
                }
                data.forEach(function(tour){
                    const card = `
                        <div class="bg-black/40 p-3 rounded-lg border border-white/5">
                            <p class="text-sm font-bold text-white mb-1">${tour.titre}</p>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-500">${tour.langue}</p>
                                <div class="text-right">
                                    <p class="text-xs text-gold font-bold">${tour.reservation_count || 0}</p>
                                    <p class="text-xs text-gray-500">réservations</p>
                                </div>
                            </div>
                        </div>`;
                    container.insertAdjacentHTML("beforeend", card);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                container.innerHTML = '<p class="text-red-500 text-sm text-center">Erreur de chargement</p>';
            });
        }

         function getNotActiveUsers(){
            const not_active_count = document.getElementById("not_active_count");
            let data = new FormData();
            data.append("users_count","notactiveusers");
            fetch("../../includes/admin/users_data.php",{
                method : "POST",
                body : data
        })
        .then(response=>response.json())
        .then(data=>{
            not_active_count.innerText = data;
        })
        }
show_app();
        function show_app(){
            const app_container = document.getElementById("app_container");
            app_container.innerHTML = "";
            let data = new FormData();
            data.append("users","pending");
            fetch("../../includes/admin/users_data.php",{
                method: "POST",
                body: data
            })
            .then(response=>response.json())
            .then(data=>{
                data.forEach(function(e){
                    
                    const card = ` <div class="bg-black/40 p-4 rounded-lg border border-white/5 flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">${e.full_name}</p>
                                    <p class="text-xs text-gray-500">${e.email}</p>
                                </div>
                            </div>
                            <div class="flex gap-2 w-full">
                                    <button onclick="acceptRequest(${e.id})" class="w-full py-2 bg-green-900/30 text-green-500 border border-green-900 rounded hover:bg-green-900/50 text-xs font-bold transition">
                                        <i class="fa-solid fa-check mr-1"></i> Valider
                                    </button>
                        
                                    <button onclick="refuseRequest(${e.id})" class="w-full py-2 bg-red-900/30 text-red-500 border border-red-900 rounded hover:bg-red-900/50 text-xs font-bold transition">
                                        <i class="fa-solid fa-xmark mr-1"></i> Refuser
                                    </button>
                            </div>
                        </div>`

                        app_container.insertAdjacentHTML("afterbegin",card);
                })
            })
            }


            function acceptRequest(id){
                let data = new FormData();
                data.append("user_id",id);
                fetch("../../includes/admin/actions/approve_guide.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                .then(data=>console.log(data,id));
                show_app();
            }

             function refuseRequest(id){
                let data = new FormData();
                data.append("user_id",id);
                fetch("../../includes/admin/actions/refuse_guide.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                .then(data=>console.log(data,id));
                show_app();
            }


            // animals //
            function getAnimalsCount(){
                const animals_count = document.getElementById("animals_count");
                let data = new FormData();
                data.append("animals_count","")
                fetch("../../includes/admin/animal_data.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                .then(data=>animals_count.textContent = data)
            }


            // habitats
            function getHabitatsCount(){
                const h_count = document.getElementById("h_count");
                let data = new FormData();
                data.append("habitat_count","")
                fetch("../../includes/admin/habitat_data.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                .then(data=>h_count.textContent = data)
            }            
            
    </script>
</body>
</html>