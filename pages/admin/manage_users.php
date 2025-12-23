<?php 
require_once("../../includes/auth/guard.php");
require_role("admin");

?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs | Admin ASSAD</title>
    
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
    <style>
        .nav-link.active {
            background: linear-gradient(90deg, rgba(198,168,124,0.1) 0%, transparent 100%);
            border-left: 4px solid #C6A87C;
            color: #C6A87C;
        }
    </style>
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
            <a href="manage_users.php" class="nav-link active flex items-center px-8 py-3 text-gray-400 hover:text-white hover:bg-white/5 transition">
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
            <h1 class="font-serif text-2xl text-white font-bold">Gestion des Utilisateurs</h1>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-500"></i>
                    <input type="text" id="userSearch" placeholder="Rechercher nom, email..." class="bg-[#151515] border border-gray-700 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:border-gold focus:outline-none w-64 text-gray-300">
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 bg-[#0a0a0a]">
            

            <div class="bg-dark-card border border-white/5 rounded-xl overflow-hidden shadow-lg">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-black text-gray-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Utilisateur</th>
                            <th class="px-6 py-4">Rôle</th>
                            <th class="px-6 py-4">Date Inscription</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="users_container" class="divide-y divide-white/5">
                    

                     

                    </tbody>
                </table>
            </div>
                
        </div>
    </main>

    <script>
        show_all();
        document.getElementById('userSearch').addEventListener('input', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if(text.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function toggleBan(userId) {
            if(confirm("Êtes-vous sûr de vouloir désactiver cet utilisateur ? Il ne pourra plus se connecter.")) {
                // Here you would redirect to PHP script
                // window.location.href = 'ban_user.php?id=' + userId;
                alert("Action simulée: Utilisateur " + userId + " désactivé.");
            }
        }

        function show_all(){
             let card;
            const container = document.getElementById("users_container");
            let data = new FormData();
            data.append("users","all");
            fetch("../../includes/admin/users_data.php",{
                method: "POST",
                body: data
            })
            .then(response=>response.json())
            .then(data=>{
                container.innerHTML = "";
                data.forEach(function(e){
                    if(e.isActive == 0 && e.isBanned == 0){
                            card = ` <tr class="hover:bg-white/5 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white font-bold">YA</div>
                                    <div>
                                        <p class="text-white font-bold">${e.full_name}</p>
                                        <p class="text-xs">${e.email}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-purple-900/30 text-purple-400 border border-purple-900/50 text-xs font-bold">GUIDE</span>
                            </td>
                            <td class="px-6 py-4">${e.created_at}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-yellow-900/30 text-yellow-500 border border-yellow-900/50 text-xs font-bold flex items-center w-fit gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> En attente
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                        <button onclick="approve_guide(${e.id})" type="submit" class="w-8 h-8 rounded bg-green-900/30 text-green-500 hover:bg-green-500 hover:text-black border border-green-900/50 transition flex items-center justify-center" title="Approuver">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <button onclick="reject_guide(${e.id})" type="submit" class="w-8 h-8 rounded bg-red-900/30 text-red-500 hover:bg-red-500 hover:text-black border border-red-900/50 transition flex items-center justify-center" title="Rejeter">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                </div>
                            </td>
                        </tr>`
                    }
                    else if(e.isActive == 1 && e.isBanned == 0){
                        card = `<tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white font-bold">SO</div>
                                    <div>
                                        <p class="text-white font-bold">${e.full_name}</p>
                                        <p class="text-xs">${e.email}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-purple-900/30 text-purple-400 border border-purple-900/50 text-xs font-bold">${e.role}</span>
                            </td>
                            <td class="px-6 py-4">${e.created_at}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-green-900/30 text-green-500 border border-green-900/50 text-xs font-bold">
                                    Actif
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="reject_guide(${e.id})" class="text-gray-500 hover:text-red-500 transition" title="Désactiver / Bannir">
                                    <i class="fa-solid fa-power-off"></i>
                                </button>
                            </td>
                        </tr>`
                    }

                    else if(e.isBanned = 1 || e.isActive == 1){
                        card = `
                        <tr class="hover:bg-white/5 transition opacity-60">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-500 font-bold">XX</div>
                                    <div>
                                        <p class="text-gray-400 font-bold line-through">${e.full_name}</p>
                                        <p class="text-xs">${e.email}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-gray-800 text-gray-500 text-xs font-bold">${e.role}</span>
                            </td>
                            <td class="px-6 py-4">${e.created_at}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-red-900/30 text-red-500 border border-red-900/50 text-xs font-bold">
                                    Banni
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="active_account(${e.id})" class="text-gray-500 hover:text-green-500 transition" title="Réactiver">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button>
                            </td>
                        </tr>`
                    }
                   

                    container.insertAdjacentHTML("afterbegin",card);

                })
            })
            }


            function approve_guide(id){
                   let data = new FormData();
                data.append("user_id",id);
                fetch("../../includes/admin/actions/approve_guide.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                show_all();
            }

            function reject_guide(id){
                  let data = new FormData();
                data.append("user_id",id);
                fetch("../../includes/admin/actions/refuse_guide.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                show_all();
            }
            function active_account(id){
                       let data = new FormData();
                data.append("user_id",id);
                fetch("../../includes/admin/actions/active_account.php",{
                    method: "POST",
                    body: data
                })
                .then(response=>response.text())
                
                show_all();
                
            }
    </script>
</body>
</html>