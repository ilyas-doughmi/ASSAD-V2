<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asaad | L'Esprit de l'Atlas</title>
    
    <?php
    // Track views for Asaad (Lion of Atlas) - typically first animal in database
    require_once('../Classes/db.php');
    require_once('../Classes/Animal.php');
    
    $pdo = new db();
    $animal = new Animal($pdo);
    
    // Increment views for Asaad (ID 1)
    $animal->incrementViews(1);
    ?>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
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
                        card: '#111111'
                    },
                    backgroundImage: {
                        'atlas-pattern': "url('https://www.transparenttextures.com/patterns/arabesque.png')"
                    }
                }
            }
        }
    </script>
    <style>
        /* Parallax & Scroll Effects */
        .parallax-bg {
            background-image: url('https://images.unsplash.com/photo-1546182990-dffeafbe841d?q=80&w=2059&auto=format&fit=crop');
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
        
        .glass-stat {
            background: rgba(20, 20, 20, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(198, 168, 124, 0.1);
        }

        /* Hide Scrollbar for Gallery */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }
        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-dark text-gray-100 font-sans selection:bg-gold selection:text-black">

    <?php include(dirname(__DIR__).'/includes/visitor_nav.php'); ?>
            </div>
        </div>
    </nav>

    <header class="relative h-screen parallax-bg flex items-center justify-center">
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/10 to-dark"></div>
        
        <div class="relative z-10 text-center px-4 animate-fade-in-up">
            <div class="inline-block px-4 py-1 mb-4 border border-gold/50 rounded-full bg-black/40 backdrop-blur-sm">
                <span class="text-gold text-xs font-bold tracking-[0.3em] uppercase">Symbole Officiel CAN 2025</span>
            </div>
            <h1 class="font-serif text-6xl md:text-8xl font-bold text-white mb-2 tracking-tighter shadow-xl">
                ASAAD
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 font-light italic font-serif">
                "Le Roi des Montagnes"
            </p>
            
            <div class="mt-10">
                <a href="#stats" class="text-white hover:text-gold transition duration-300 flex flex-col items-center gap-2 text-sm uppercase tracking-widest opacity-80 hover:opacity-100">
                    Découvrir son histoire
                    <i class="fa-solid fa-arrow-down animate-bounce mt-2"></i>
                </a>
            </div>
        </div>
    </header>

    <section id="stats" class="py-20 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-2 glass-stat rounded-2xl p-8 border-l-4 border-gold">
                <h2 class="font-serif text-3xl text-white mb-4">Qui est Asaad ?</h2>
                <p class="text-gray-400 leading-relaxed mb-4">
                    Asaad n'est pas seulement un lion. Il est l'incarnation vivante du **Lion de l'Atlas** (Panthera leo leo), une sous-espèce légendaire qui régnait autrefois sur toute l'Afrique du Nord, du Maroc à l'Égypte.
                </p>
                <p class="text-gray-400 leading-relaxed">
                    Aujourd'hui éteint à l'état sauvage, son héritage survit grâce aux programmes de conservation royaux. Asaad représente la force, la noblesse et l'hospitalité marocaine pour la Coupe d'Afrique des Nations 2025.
                </p>
            </div>

            <div class="glass-stat rounded-2xl p-8 flex flex-col justify-center items-center text-center">
                <i class="fa-solid fa-dna text-4xl text-gold mb-4 opacity-50"></i>
                <h3 class="text-sm uppercase tracking-widest text-gray-500 mb-1">Nom Scientifique</h3>
                <p class="font-serif text-xl text-white italic">Panthera leo leo</p>
            </div>

            <div class="glass-stat rounded-2xl p-6 flex flex-col items-center justify-center">
                <span class="text-4xl font-serif text-gold font-bold">220<span class="text-sm ml-1 text-gray-500">kg</span></span>
                <span class="text-xs uppercase tracking-wider text-gray-500 mt-2">Poids Moyen</span>
            </div>
            <div class="glass-stat rounded-2xl p-6 flex flex-col items-center justify-center">
                <span class="text-4xl font-serif text-gold font-bold">12<span class="text-sm ml-1 text-gray-500">ans</span></span>
                <span class="text-xs uppercase tracking-wider text-gray-500 mt-2">Âge</span>
            </div>
            <div class="glass-stat rounded-2xl p-6 flex flex-col items-center justify-center">
                <span class="text-4xl font-serif text-gold font-bold">Danger</span>
                <span class="text-xs uppercase tracking-wider text-gray-500 mt-2">Statut Conservation</span>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#080808] relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-5 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-16">
            
            <div class="w-full md:w-1/2 relative group">
                <div class="absolute -inset-4 border border-gold/30 rounded-sm transform translate-x-2 translate-y-2 transition duration-500 group-hover:translate-x-0 group-hover:translate-y-0"></div>
                <img src="https://images.unsplash.com/photo-1614027164847-1b28cfe1df60?q=80&w=1986&auto=format&fit=crop" 
                     alt="Close up of Lion Face" 
                     class="relative z-10 w-full h-[500px] object-cover grayscale group-hover:grayscale-0 transition duration-700 shadow-2xl">
            </div>

            <div class="w-full md:w-1/2">
                <h2 class="font-serif text-4xl md:text-5xl text-white mb-6">
                    Le Gardien du <span class="text-gold">Royaume</span>
                </h2>
                <div class="w-20 h-1 bg-gold mb-8"></div>
                
                <p class="text-gray-400 text-lg leading-relaxed mb-6">
                    Contrairement aux lions de savane, le Lion de l'Atlas possède une crinière sombre et dense qui s'étend jusqu'au milieu du dos, une adaptation au climat froid des montagnes de l'Atlas marocain.
                </p>
                <p class="text-gray-400 text-lg leading-relaxed mb-8">
                    Les Romains les utilisaient dans les arènes de gladiateurs pour leur férocité impressionnante. Aujourd'hui, Asaad vit paisiblement dans notre zone protégée, ambassadeur d'une histoire millénaire.
                </p>

                <a href="tours.php" class="inline-flex items-center gap-3 px-8 py-4 bg-gold text-black font-bold uppercase tracking-widest text-sm hover:bg-white transition duration-300">
                    Réserver une visite privée
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-10 flex justify-between items-end">
            <div>
                <h2 class="font-serif text-3xl text-white">Galerie Royale</h2>
                <p class="text-gray-500 mt-2">Asaad dans son habitat naturel reconstitué.</p>
            </div>
            <div class="flex gap-4">
                <button onclick="scrollGallery('left')" class="w-12 h-12 rounded-full border border-gray-700 text-white hover:border-gold hover:text-gold flex items-center justify-center transition"><i class="fa-solid fa-chevron-left"></i></button>
                <button onclick="scrollGallery('right')" class="w-12 h-12 rounded-full border border-gray-700 text-white hover:border-gold hover:text-gold flex items-center justify-center transition"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

        <div id="galleryContainer" class="flex gap-6 overflow-x-auto hide-scroll px-6 md:px-[calc((100vw-1280px)/2)] pb-10 scroll-smooth">
            
            <div class="min-w-[300px] md:min-w-[400px] h-[300px] relative group cursor-pointer">
                <img src="https://plus.unsplash.com/premium_photo-1664304310991-b43610000fc2?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover rounded-lg filter brightness-75 group-hover:brightness-100 transition duration-500">
                <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-300">
                    <p class="font-serif font-bold">Le Repos du Guerrier</p>
                </div>
            </div>

            <div class="min-w-[300px] md:min-w-[400px] h-[300px] relative group cursor-pointer">
                <img src="https://images.unsplash.com/photo-1575550959106-5a7defe28b56?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover rounded-lg filter brightness-75 group-hover:brightness-100 transition duration-500">
                <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-300">
                    <p class="font-serif font-bold">Regard Intense</p>
                </div>
            </div>

            <div class="min-w-[300px] md:min-w-[400px] h-[300px] relative group cursor-pointer">
                <img src="https://media.istockphoto.com/id/2185687376/fr/photo/le-rugissement-du-lion-dans-la-nature.webp?a=1&b=1&s=612x612&w=0&k=20&c=bOnr335b4AXxANiv1nCMBPQAji6y0gXJhmg86ICNG7s=" class="w-full h-full object-cover rounded-lg filter brightness-75 group-hover:brightness-100 transition duration-500">
                <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-300">
                    <p class="font-serif font-bold">Chasse Nocturne</p>
                </div>
            </div>

            <div class="min-w-[300px] md:min-w-[400px] h-[300px] relative group cursor-pointer">
                <img src="https://media.istockphoto.com/id/1503490463/photo/africa-lion-king-of-the-jungle.jpg?s=612x612&w=0&k=20&c=ycFNMyKdLgVVR5tAreJdRjoHVKkAVpsDvwBd4h2PGd0=" class="w-full h-full object-cover rounded-lg filter brightness-75 group-hover:brightness-100 transition duration-500">
                <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition duration-300">
                    <p class="font-serif font-bold">La Meute</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="border-t border-white/10 bg-black py-12 text-center">
        <i class="fa-solid fa-crown text-gold text-2xl mb-4"></i>
        <p class="text-gray-500 text-sm">© 2025 Zoo ASSAD. Tous droits réservés. Partenaire Officiel CAN 2025.</p>
    </footer>

    <script>
        function scrollGallery(direction) {
            const container = document.getElementById('galleryContainer');
            const scrollAmount = 400; 
            if(direction === 'left') {
                container.scrollLeft -= scrollAmount;
            } else {
                container.scrollLeft += scrollAmount;
            }
        }
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