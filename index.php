<?php
session_start();
$isConnected = true;
if(!isset($_SESSION["id"])){
    $isConnected = false;
}

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
    <title>ASSAD Zoo | L'Expérience Virtuelle CAN 2025</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
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
                        'dark-lighter': '#0f0f0f',
                    },
                    backgroundImage: {
                        'hero-pattern': "url('https://www.transparenttextures.com/patterns/cubes.png')"
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Smooth Scrolling */
        html { scroll-behavior: smooth; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #C6A87C; }

        /* Hero Zoom Effect */
        .hero-img {
            animation: slowZoom 20s infinite alternate;
        }
        @keyframes slowZoom {
            from { transform: scale(1); }
            to { transform: scale(1.1); }
        }
    </style>
</head>
<body class="bg-dark text-gray-100 font-sans selection:bg-gold selection:text-black">

    <?php include(__DIR__.'/includes/visitor_nav.php'); ?>

    <header class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?q=80&w=2071&auto=format&fit=crop" 
                 class="w-full h-full object-cover hero-img opacity-60" 
                 alt="Savannah Background">
            <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/40 to-black/30"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-10">
            
            <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full border border-gold/30 bg-black/50 backdrop-blur-md mb-6 animate-pulse">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span class="text-xs uppercase tracking-widest text-gold font-bold">En direct de l'Atlas</span>
            </div>

            <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                Explorez le <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold to-yellow-600">Royaume Sauvage</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-10 font-light max-w-2xl mx-auto leading-relaxed">
                Plongez au cœur de la faune africaine sans quitter votre écran. 
                Une expérience immersive officielle pour la <strong class="text-white">Coupe d'Afrique des Nations 2025</strong>.
            </p>

            <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                <a href="register.php" class="w-full md:w-auto px-8 py-4 bg-gold text-black font-bold uppercase tracking-widest hover:bg-white transition-all transform hover:-translate-y-1 shadow-[0_0_20px_rgba(198,168,124,0.3)]">
                    Commencer l'aventure
                </a>
                <a href="pages/asaad.php" class="w-full md:w-auto px-8 py-4 border border-white/20 bg-white/5 backdrop-blur-sm text-white font-bold uppercase tracking-widest hover:bg-white/10 transition-all">
                    Découvrir Asaad
                </a>
            </div>
        </div>
    </header>


    <footer class="bg-[#050505] border-t border-white/5 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-crown text-gold text-2xl"></i>
                    <span class="font-serif font-bold text-2xl text-white">ASSAD</span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Plateforme officielle de découverte animale pour la Coupe d'Afrique des Nations 2025.
                </p>
            </div>

            <div>
                <h4 class="text-white font-serif font-bold mb-6">Navigation</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-gold transition">Accueil</a></li>
                    <li><a href="pages/asaad.php" class="hover:text-gold transition">Asaad</a></li>
                    <li><a href="#" class="hover:text-gold transition">Visites Guidées</a></li>
                    <li><a href="login.php" class="hover:text-gold transition">Connexion Espace Membre</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-serif font-bold mb-6">Légal</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-gold transition">Mentions Légales</a></li>
                    <li><a href="#" class="hover:text-gold transition">Politique de Confidentialité</a></li>
                    <li><a href="#" class="hover:text-gold transition">CGV</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-serif font-bold mb-6">Contact</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-envelope text-gold"></i> contact@assad.ma</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-phone text-gold"></i> +212 5 37 00 00 00</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-gold"></i> Rabat, Maroc</li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-white/5 text-center">
            <p class="text-gray-600 text-xs">© 2025 Zoo ASSAD. Developed by Achraf Chaoub (YouCode). All rights reserved.</p>
        </div>
    </footer>

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
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-black/90', 'backdrop-blur-md', 'shadow-lg', 'border-b', 'border-white/10');
                navbar.classList.remove('py-4', 'border-transparent');
                navbar.classList.add('py-2');
            } else {
                navbar.classList.remove('bg-black/90', 'backdrop-blur-md', 'shadow-lg', 'border-b', 'border-white/10', 'py-2');
                navbar.classList.add('py-4', 'border-transparent');
            }
        });
    </script>
</body>
</html>