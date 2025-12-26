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
    <title>ASSAD | Inscription</title>
    
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
                        atlas: {
                            gold: '#C6A87C',
                            dark: '#0a0a0a',
                            gray: '#1a1a1a',
                        }
                    },
                    backgroundImage: {
                        'moroccan-pattern': "url('https://www.transparenttextures.com/patterns/arabesque.png')"
                    }
                }
            }
        }
    </script>

    <style>
        /* Shared Background Styles */
        .bg-atlas {
            background-image: url('https://images.unsplash.com/photo-1546182990-dffeafbe841d?q=80&w=2059&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .overlay-pattern {
            background-color: rgba(5, 5, 5, 0.85);
            background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');
            background-blend-mode: overlay;
            opacity: 0.4;
        }
        .glass-panel {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(198, 168, 124, 0.15);
            box-shadow: 0 0 50px rgba(0,0,0, 0.9);
        }
        .atlas-input:focus {
            border-color: #C6A87C;
            box-shadow: 0 0 0 1px #C6A87C;
        }

        /* Custom Radio Button Logic for Roles */
        .role-radio:checked + div {
            border-color: #C6A87C;
            background-color: rgba(198, 168, 124, 0.1);
        }
        .role-radio:checked + div .role-icon {
            color: #C6A87C;
        }
    </style>
</head>
<body class="bg-atlas min-h-screen flex items-center justify-center p-4 text-gray-100">

    <div class="absolute inset-0 bg-black/70 z-0"></div>
    <div class="absolute inset-0 overlay-pattern z-0 pointer-events-none"></div>

    <div class="relative z-10 w-full max-w-6xl flex rounded-2xl overflow-hidden glass-panel min-h-[700px]">
        
        <div class="hidden md:flex md:w-5/12 relative overflow-hidden bg-black group flex-col justify-between">
            
            <img src="https://media.istockphoto.com/id/1140829787/photo/sunset-at-savannah-plains.jpg?s=612x612&w=0&k=20&c=z1e1kvLk52k10-2hT-mdnO_EAmT8BmnAm3qWP9vZ4UQ=" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-[4s]" 
                 alt="Savannah Landscape">
            
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/90"></div>

            <div class="relative z-10 p-10">
                <h2 class="font-serif text-3xl font-bold text-white tracking-wider">ASSAD</h2>
                <div class="h-1 w-12 bg-atlas-gold mt-2"></div>
            </div>

            <div class="relative z-10 p-10">
                <h3 class="font-serif text-xl text-white font-bold mb-2">Rejoignez l'Aventure</h3>
                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                    Créez votre compte pour explorer les merveilles de l'Atlas ou devenez guide pour partager votre passion.
                </p>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded bg-white/10 backdrop-blur-sm border border-white/10">
                    <i class="fa-solid fa-shield-cat text-atlas-gold"></i>
                    <span class="text-xs font-bold tracking-widest text-white">COMMUNAUTÉ SÉCURISÉE</span>
                </div>
            </div>
        </div>

        <div class="w-full md:w-7/12 p-8 md:p-12 overflow-y-auto max-h-[90vh] custom-scrollbar">
            
            <div class="mb-8 text-center md:text-left">
                <h1 class="font-serif text-3xl text-white font-bold">Créer un Compte</h1>
                <p class="text-gray-400 text-sm mt-1">Veuillez remplir les informations ci-dessous.</p>
            </div>

            <form action="includes/auth/register.php" method="POST" class="space-y-5" id="registerForm">
                
                <div class="space-y-2">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Je veux être</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="visitor" class="hidden role-radio" checked>
                            <div class="border border-gray-700 bg-[#151515] rounded-lg p-4 flex flex-col items-center justify-center gap-2 hover:border-gray-500 transition-all">
                                <i class="fa-solid fa-binoculars text-2xl text-gray-500 role-icon transition-colors"></i>
                                <span class="font-serif font-bold text-sm">Visiteur</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="guide" class="hidden role-radio">
                            <div class="border border-gray-700 bg-[#151515] rounded-lg p-4 flex flex-col items-center justify-center gap-2 hover:border-gray-500 transition-all">
                                <i class="fa-solid fa-compass text-2xl text-gray-500 role-icon transition-colors"></i>
                                <span class="font-serif font-bold text-sm">Guide</span>
                            </div>
                        </label>
                    </div>
                    <p id="guide-hint" class="hidden text-xs text-yellow-500/80 text-center mt-1">
                        <i class="fa-solid fa-circle-info mr-1"></i> 
                        Le compte Guide nécessite une approbation par l'administrateur.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest ml-1">Nom Complet</label>
                        <input type="text" name="nom" required pattern="[a-zA-ZÀ-ÿ\s\-]{2,50}" title="Lettres et espaces uniquement (2-50 caractères)" placeholder="Achraf Chaoub" class="atlas-input w-full bg-[#111] border border-gray-800 text-gray-200 text-sm rounded-lg py-3 px-4 focus:outline-none transition-all placeholder-gray-600">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest ml-1">Email</label>
                        <input type="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Adresse email valide requise" placeholder="nom@exemple.com" class="atlas-input w-full bg-[#111] border border-gray-800 text-gray-200 text-sm rounded-lg py-3 px-4 focus:outline-none transition-all placeholder-gray-600">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-widest ml-1">Mot de passe</label>
                    <div class="relative">
                        <input name="password" type="password" id="password" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}" title="8+ caractères, 1 majuscule, 1 minuscule, 1 chiffre" class="atlas-input w-full bg-[#111] border border-gray-800 text-gray-200 text-sm rounded-lg py-3 px-4 focus:outline-none transition-all placeholder-gray-600">
                        <button type="button" class="absolute right-3 top-3 text-gray-500 hover:text-atlas-gold toggle-pass"><i class="fa-regular fa-eye"></i></button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Min. 8 caractères avec 1 majuscule, 1 minuscule et 1 chiffre</p>
                </div>


                <div class="flex items-start gap-2 pt-2">
                    <input type="checkbox" required class="mt-1 rounded bg-gray-800 border-gray-700 text-atlas-gold focus:ring-0">
                    <span class="text-xs text-gray-500">J'accepte les <a href="#" class="text-gray-400 underline hover:text-atlas-gold">Conditions Générales</a> et la Politique de Confidentialité du Zoo ASSAD.</span>
                </div>

                <button type="submit" class="w-full bg-atlas-gold text-black font-serif font-bold py-3.5 rounded-lg shadow-lg hover:bg-[#d4b589] transform transition-all hover:-translate-y-0.5 mt-2">
                    S'INSCRIRE
                </button>
            </form>

            <div class="mt-8 text-center border-t border-gray-800 pt-6">
                <p class="text-sm text-gray-500">
                    Vous avez déjà un compte ? 
                    <a href="login.php" class="text-atlas-gold font-bold hover:underline underline-offset-4">Se connecter</a>
                </p>
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
        // 1. Password Visibility
        document.querySelectorAll('.toggle-pass').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                if(input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
        // 3. Guide Role Hint
        const radios = document.getElementsByName('role');
        const guideHint = document.getElementById('guide-hint');
        
        radios.forEach(radio => {
            radio.addEventListener('change', (e) => {
                if(e.target.value === 'guide') {
                    guideHint.classList.remove('hidden');
                } else {
                    guideHint.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>