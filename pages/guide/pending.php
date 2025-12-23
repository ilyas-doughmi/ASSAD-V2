<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte en Attente | ASSAD Zoo</title>
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
<body class="bg-dark text-white h-screen flex items-center justify-center p-4">

    <div class="max-w-lg w-full bg-[#111] border border-gold/30 rounded-2xl p-10 text-center shadow-[0_0_50px_rgba(198,168,124,0.1)]">
        
        <div class="w-20 h-20 bg-yellow-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-hourglass-half text-4xl text-gold animate-pulse"></i>
        </div>

        <h1 class="font-serif text-3xl font-bold mb-4 text-white">Validation Requise</h1>
        
        <p class="text-gray-400 mb-6 leading-relaxed">
            Merci de votre inscription en tant que <strong>Guide</strong>. 
            Votre compte est actuellement en cours d'examen par nos administrateurs.
        </p>



        <div class="flex flex-col gap-3">
            <a href="index.php" class="text-gold hover:underline text-sm font-bold">Retour à l'accueil</a>
            <a href="../../includes/auth/logout.php" class="text-gray-600 hover:text-white text-xs">Se déconnecter</a>
        </div>
    </div>

</body>
</html>