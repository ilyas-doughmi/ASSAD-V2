<?php 
if(isset($_GET["id"])){
    $tour_id = $_GET["id"];
}
else{
    header("location: tours.php?message=choose");
}

include_once("../includes/guide/visite_data.php");



$tour_info = getTourInfo($tour_id);
$guide_id = $tour_info["guide_id"];
$guide = getGuideName($guide_id);


?>

<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Détails Visite | ASSAD Zoo</title>
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

    <div class="h-[50vh] relative">
        <img src="<?=  $tour_info["tour_image"] ?>" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-dark to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-8 max-w-7xl mx-auto w-full">
            <h1 class="font-serif text-5xl font-bold text-white mb-2"><?= $tour_info["titre"] ?></h1>
            <div class="flex gap-6 text-sm text-gray-300">
                <span><i class="fa-regular fa-clock text-gold mr-2"></i> <?= $tour_info["duree_minutes"] ?> Minutes</span>
                <span><i class="fa-solid fa-language text-gold mr-2"></i><?= $tour_info["langue"] ?></span>
                <span><i class="fa-solid fa-user-tie text-gold mr-2"></i> Guide: <?= $guide["full_name"] ?></span>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-12">
        
        <div class="md:col-span-2 space-y-12">
            
            <div>
                <h2 class="font-serif text-2xl text-white mb-4">À propos de cette expérience</h2>
                <p class="text-gray-400 leading-relaxed">
                    <?= $tour_info["description"] ?>
                </p>
            </div>

            <div>
                <h2 class="font-serif text-2xl text-white mb-6">Votre Parcours</h2>
                <div id="steps_container" class="border-l-2 border-gray-800 ml-3 space-y-8">           
        
                </div>
            </div>

        
        </div>

        <div class="relative">
            <div class="bg-[#111] border border-gold/30 rounded-xl p-6 sticky top-24 shadow-2xl">
                <div class="flex justify-between items-end mb-6">
                    <span class="text-gray-400">Prix par personne</span>
                    <span class="text-3xl font-serif font-bold text-gold">150 DH</span>
                </div>
                
                    <input type="hidden" name="tour_id" value="1">
                    
                    <div class="mb-4">
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-2">Date</label>
                        <div class="w-full bg-black border border-gray-700 rounded px-4 py-3 text-white text-sm">
                            <?= $tour_info["date_heure_debut"] ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs uppercase text-gray-500 font-bold mb-2">Nombre de personnes</label>
                        <input type="number" name="nb_people" value="1" min="1" max="10" class="w-full bg-black border border-gray-700 rounded px-4 py-3 text-white focus:border-gold outline-none">
                    </div>

                    <button onclick="reserve(<?= $tour_info['id'] ?>)" type="submit" class="w-full bg-gold text-black font-bold py-4 rounded hover:bg-white transition uppercase tracking-widest text-sm">
                        Réserver maintenant
                    </button>
                    <p class="text-center text-xs text-gray-500 mt-4"><i class="fa-solid fa-lock mr-1"></i> Paiement sécurisé</p>
            </div>
        </div>

    </div>

    <script>
        fetchSteps(<?= $tour_id ?>);
        function fetchSteps(id){
            const steps_container = document.getElementById("steps_container");
            let firstPass = false;
            let card;
            let data = new FormData();
            data.append("show_steps",id);
            fetch("../includes/guide/visite_action/steps_visite.php",{
                method: "POST",
                body: data 
            })
            .then(response=>response.json())
            .then(data=>{
                data.forEach(function(e){
                    if(!firstPass){
                        card = `<div class="relative pl-8">
                        <span class="absolute -left-[9px] top-0 w-5 h-5 rounded-full bg-gold border-4 border-dark"></span>
                        <h3 class="text-white font-bold text-lg">${e.titre_etape}</h3>
                        <p class="text-gray-500 text-sm">${e.description_etape}</p>
                    </div>`
                    firstPass = true;
                    }else{
                        card = `       <div class="relative pl-8">
                        <span class="absolute -left-[9px] top-0 w-5 h-5 rounded-full bg-gray-700 border-4 border-dark"></span>
                        <h3 class="text-white font-bold text-lg">${e.titre_etape}</h3>
                        <p class="text-gray-500 text-sm">${e.description_etape}</p>
                    </div>`
                    }

                    steps_container.insertAdjacentHTML("beforeend",card);

                })

            })

             window.reserve = function(tour_id){
                let data = new FormData();
                data.append("reserve",tour_id);

                fetch("../includes/guide/visite_action/reserve_tour.php",{
                    method : "POST",
                    body : data
                })
                .then(response=>response.text())
                .then(data=>{
                    console.log(data);
                })
                
            }
        }
    </script>
</body>
</html>