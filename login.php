<?php
$message = "";
    if(isset($_GET["message"])){
        $message = $_GET["message"];
    }

?>
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSAD | Authentification</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Outfit"', 'sans-serif'],
                        serif: ['"Cinzel"', 'serif'], // The "Game of Thrones" / Royal style font
                    },
                    colors: {
                        atlas: {
                            gold: '#C6A87C',      // Muted luxury gold
                            dark: '#0a0a0a',      // True black
                            red: '#A82525',       // Moroccan Flag Red (Subtle accent)
                            green: '#006233'      // Moroccan Flag Green (Subtle accent)
                        }
                    },
                    backgroundImage: {
                        // A subtle Moroccan pattern overlay
                        'moroccan-pattern': "url('https://www.transparenttextures.com/patterns/arabesque.png')"
                    }
                }
            }
        }
    </script>

    <style>
        /* 1. The Real Background Image (Atlas/Lion Theme) */
        .bg-atlas {
            /* High quality Lion/Dark nature background */
            background-image: url('https://images.unsplash.com/photo-1546182990-dffeafbe841d?q=80&w=2059&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        /* 2. The Dark Overlay with Moroccan Pattern */
        .overlay-pattern {
            background-color: rgba(5, 5, 5, 0.85); /* Darken the image significantly */
            background-image: url('https://www.transparenttextures.com/patterns/arabesque.png'); /* Subtle texture */
            background-blend-mode: overlay;
            opacity: 0.4;
        }

        /* 3. The Glass Card */
        .glass-panel {
            background: rgba(20, 20, 20, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(198, 168, 124, 0.15); /* Gold border */
            box-shadow: 0 0 40px rgba(0,0,0, 0.8);
        }

        /* Custom Input focus */
        .atlas-input:focus {
            border-color: #C6A87C;
            box-shadow: 0 0 0 1px #C6A87C;
        }
    </style>
</head>
<body class="bg-atlas min-h-screen flex items-center justify-center p-4 text-gray-100">

    <div class="absolute inset-0 bg-black/70 z-0"></div>
    <div class="absolute inset-0 overlay-pattern z-0 pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-5xl h-[650px] flex rounded-2xl overflow-hidden glass-panel">
        
        <div class="w-full md:w-1/2 p-10 md:p-14 flex flex-col justify-center relative">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-atlas-gold to-transparent opacity-30"></div>

            <div class="mb-10 text-center md:text-left">
                <div class="inline-flex items-center gap-2 mb-2 px-3 py-1 rounded-full border border-atlas-gold/20 bg-atlas-gold/5">
                    <i class="fa-solid fa-star-and-crescent text-xs text-atlas-gold"></i>
                    <span class="text-[10px] uppercase tracking-widest text-atlas-gold font-bold">Maroc 2025</span>
                </div>
                <h1 class="font-serif text-4xl md:text-5xl text-white font-bold tracking-wide mt-2">
                    ASSAD
                </h1>
                <p class="text-gray-400 text-sm mt-2 font-light tracking-wide">
                    Portail officiel du Zoo Virtuel.
                </p>
            </div>

            <form action="includes/auth/login.php" method="POST" class="space-y-6">
                
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest ml-1">Identifiant</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input name="email" type="email" placeholder="Email institutionnel ou personnel" 
                            class="atlas-input w-full bg-[#111] border border-gray-800 text-gray-200 text-sm rounded-lg py-3.5 pl-11 focus:outline-none transition-all duration-300 placeholder-gray-600">
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between ml-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Mot de passe</label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input name="password" type="password" id="password" placeholder="••••••••••••" 
                            class="atlas-input w-full bg-[#111] border border-gray-800 text-gray-200 text-sm rounded-lg py-3.5 pl-11 pr-10 focus:outline-none transition-all duration-300 placeholder-gray-600">
                        <button type="button" id="togglePass" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-atlas-gold transition-colors">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" 
                    class="group w-full bg-gradient-to-r from-[#C6A87C] to-[#a68a5c] text-black font-serif font-bold py-4 rounded-lg shadow-lg hover:shadow-atlas-gold/20 transform transition-all duration-300 hover:-translate-y-1 mt-4 flex items-center justify-center gap-3">
                    <span>ACCÉDER AU ROYAUME</span>
                    <i class="fa-solid fa-arrow-right-long opacity-70 group-hover:translate-x-1 transition-transform"></i>
                </button>

                <div class="flex justify-between items-center text-xs mt-4 text-gray-500">
                    <label class="flex items-center gap-2 cursor-pointer hover:text-gray-300 transition-colors">
                        <input type="checkbox" class="rounded bg-gray-800 border-gray-700 text-atlas-gold focus:ring-0">
                        <span>Rester connecté</span>
                    </label>
                    <a href="register.php" class="hover:text-atlas-gold transition-colors underline decoration-dotted underline-offset-4">Créer un compte</a>
                </div>
            </form>
        </div>

        <div class="hidden md:flex md:w-1/2 relative overflow-hidden bg-black group">
            
            <img src="https://images.unsplash.com/photo-1614027164847-1b28cfe1df60?q=80&w=1986&auto=format&fit=crop" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-[3s]" 
                 alt="Lion Atlas">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/40"></div>

            <div class="absolute bottom-0 left-0 p-12 w-full z-10">
                <div class="border-l-2 border-atlas-gold pl-6">
                    <h3 class="font-serif text-2xl text-white font-bold mb-2">L'Esprit de l'Atlas</h3>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        "Plongez au cœur de la faune africaine. Une expérience immersive conçue pour célébrer la nature et l'héritage marocain."
                    </p>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-red-800 border-2 border-black flex items-center justify-center text-[10px] text-white font-bold">MA</div>
                            <div class="w-8 h-8 rounded-full bg-green-800 border-2 border-black flex items-center justify-center text-[10px] text-white font-bold">25</div>
                        </div>
                        <span class="text-xs text-atlas-gold font-bold tracking-wider">OFFICIAL PARTNER</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Notification Bar -->
<div id="notify"
     class="fixed top-6 right-6 z-50 <?= empty($message) ? 'hidden' : '' ?> items-center gap-3 px-5 py-4 rounded-xl
            bg-[#141414] border border-atlas-gold/30 text-gray-200 shadow-2xl
            backdrop-blur-md max-w-sm">

    <!-- Icon -->
    <i class="fa-solid fa-circle-check text-atlas-gold text-xl"></i>

    <!-- Message -->
    <span class="text-sm font-medium">
        <?= $message ?>
    </span>
</div>
    <script>
        document.getElementById('togglePass').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = this.querySelector('i');
            if(input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>