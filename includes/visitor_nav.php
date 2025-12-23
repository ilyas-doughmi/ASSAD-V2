<?php
if(!isset($_SESSION)) session_start();
$isConnected = isset($_SESSION['id']);
?>
<nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 py-4 border-b border-transparent">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <a href="/assad-2025/index.php" class="flex items-center gap-2 group">
            <div class="w-10 h-10 bg-gradient-to-br from-gold to-yellow-800 rounded-full flex items-center justify-center text-black shadow-lg shadow-gold/20">
                <i class="fa-solid fa-lion"></i>
            </div>
            <div>
                <span class="font-serif font-bold text-xl tracking-widest text-white group-hover:text-gold transition-colors">ASSAD</span>
                <span class="block text-[0.6rem] text-gold uppercase tracking-[0.2em] -mt-1">Maroc 2025</span>
            </div>
        </a>
        <?php if($isConnected): ?>
        <div class="hidden md:flex items-center gap-8 text-sm uppercase tracking-wider font-medium text-gray-300">
            <a href="/assad-2025/index.php" class="hover:text-gold transition-colors<?php if(basename($_SERVER['SCRIPT_NAME'])=='index.php') echo ' text-white border-b border-gold'; ?>">Accueil</a>
            <a href="/assad-2025/pages/asaad.php" class="hover:text-gold transition-colors">L'Esprit Asaad</a>
            <a href="/assad-2025/pages/animals.php" class="hover:text-gold transition-colors">Animaux</a>
            <a href="/assad-2025/pages/tours.php" class="hover:text-gold transition-colors<?php if(basename($_SERVER['SCRIPT_NAME'])=='tours.php') echo ' text-white border-b border-gold'; ?>">Visites</a>
            <a href="/assad-2025/pages/my_reservation.php" class="hover:text-gold transition-colors<?php if(basename($_SERVER['SCRIPT_NAME'])=='my_reservation.php') echo ' text-white border-b border-gold'; ?>">Mes Visites</a>
        </div>
        <?php endif; ?>
        <div class="flex items-center gap-4">
            <?php if(!$isConnected): ?>
                <a href="/assad-2025/login.php" class="hidden md:block text-sm font-bold text-gray-300 hover:text-white transition-colors">Connexion</a>
                <a href="/assad-2025/register.php" class="px-6 py-2 bg-gold text-black text-sm font-bold rounded-sm uppercase tracking-widest hover:bg-white transition-colors shadow-lg shadow-gold/20">Rejoindre</a>
            <?php else: ?>
                <a href="/assad-2025/includes/auth/logout.php" class="px-6 py-2 bg-red-600 text-white text-sm font-bold rounded-sm uppercase tracking-widest hover:bg-white hover:text-black transition-colors shadow-lg shadow-gold/20">Déconnexion</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
