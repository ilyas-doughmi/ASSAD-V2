<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations | ASSAD Zoo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['"Outfit"', 'sans-serif'], serif: ['"Cinzel"', 'serif'] }, colors: { gold: '#C6A87C', dark: '#050505' } } }
        }
    </script>
</head>
<body class="bg-dark text-gray-100 font-sans">
    
    <?php include(dirname(__DIR__).'/includes/visitor_nav.php'); ?>


    <div class="max-w-4xl mx-auto px-6 pt-32 pb-12">
        <h1 class="font-serif text-3xl text-white font-bold mb-8">Mes Réservations</h1>
        <div id="reservations_container"></div>
    </div>

    <script>
    fetch('../includes/visitor/get_my_reservations.php')
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById('reservations_container');
        if(data.length === 0) {
            container.innerHTML = '<div class="text-center text-gray-500">Aucune réservation trouvée.</div>';
            return;
        }
        data.forEach(e => {
            let status = '';
            let statusClass = '';
            let showFacture = false;
            let showReview = false;
            if(e.status === 'full' || e.status === 'open') {
                status = 'Confirmé';
                statusClass = 'bg-green-900/30 text-green-500 border-green-900/50';
                showFacture = true;
            } else if(e.status === 'cancelled') {
                status = 'Annulé';
                statusClass = 'bg-red-900/30 text-red-500 border-red-900/50';
            } else {
                status = 'Terminé';
                statusClass = 'bg-gray-700 text-gray-400 border-gray-700';
                showReview = true;
            }
            let date = new Date(e.date_heure_debut);
            let dateStr = date.toLocaleDateString('fr-FR', { day: '2-digit', month: 'short', year: 'numeric' });
            let timeStr = date.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
            let actions = '';
            if(showFacture) {
                actions += `<a href="inovice.php?id=${e.id}" target="_blank" class="px-4 py-2 border border-gray-700 text-gray-300 rounded hover:text-white hover:border-white transition text-sm"><i class='fa-solid fa-file-invoice mr-2'></i>Facture</a>`;
            }
            if(showReview) {
                actions += `<button class='px-4 py-2 border border-gold text-gold rounded hover:bg-gold hover:text-black transition text-sm review-btn' data-tourid='${e.id}'><i class='fa-regular fa-star mr-2'></i>Noter</button>`;
            }
            container.innerHTML += `
            <div class="bg-[#111] border border-white/5 rounded-xl p-6 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <img src="${e.tour_image}" class="w-20 h-20 object-cover rounded-lg">
                    <div>
                        <h3 class="font-serif text-lg text-white">${e.titre}</h3>
                        <p class="text-sm text-gray-500">${dateStr} • ${timeStr}</p>
                        <span class="inline-block ${statusClass} text-[10px] font-bold px-2 py-0.5 rounded border mt-1">${status}</span>
                    </div>
                </div>
                <div class="flex gap-3">${actions}</div>
            </div>
            `;
        });
    });
    </script>

    <div id="reviewModal" class="hidden fixed inset-0 z-[60] bg-black/80 flex items-center justify-center p-4">
        <div class="bg-[#1a1a1a] p-8 rounded-xl max-w-md w-full border border-gold/30">
            <h3 class="font-serif text-xl text-white mb-4">Laisser un avis</h3>
            <div id="starContainer" class="flex justify-center gap-2 text-2xl text-gray-600 mb-4 cursor-pointer">
                <i class="fa-solid fa-star hover:text-gold"></i><i class="fa-solid fa-star hover:text-gold"></i><i class="fa-solid fa-star hover:text-gold"></i><i class="fa-solid fa-star hover:text-gold"></i><i class="fa-solid fa-star hover:text-gold"></i>
            </div>
            <textarea id="reviewComment" class="w-full bg-black border border-gray-700 rounded p-3 text-white text-sm mb-4" rows="3" placeholder="Votre expérience..."></textarea>
            <div class="flex justify-end gap-3">
                <button onclick="document.getElementById('reviewModal').classList.add('hidden')" class="text-gray-500 hover:text-white text-sm">Annuler</button>
                <button id="sendReviewBtn" class="bg-gold text-black font-bold px-4 py-2 rounded text-sm">Envoyer</button>
            </div>
        </div>
    </div>
    <script>
    let reviewTourId = null;
    let reviewNote = 0;
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('review-btn')){
            reviewTourId = e.target.getAttribute('data-tourid');
            document.getElementById('reviewModal').classList.remove('hidden');
        }
    });
    const stars = document.querySelectorAll('#starContainer i');
    stars.forEach((star, i) => {
        star.addEventListener('click', function(){
            reviewNote = i+1;
            stars.forEach((s, j) => s.classList[j<=i ? 'add' : 'remove']('text-gold'));
        });
    });
    document.getElementById('sendReviewBtn').onclick = function(){
        const comment = document.getElementById('reviewComment').value;
        if(reviewTourId && reviewNote && comment){
            let fd = new FormData();
            fd.append('tour_id', reviewTourId);
            fd.append('note', reviewNote);
            fd.append('comment', comment);
            fetch('../includes/visitor/add_review.php', {
                method: 'POST',
                body: fd
            }).then(response => response.text()).then(data => {
                console.log('response data', data);
            });
        }
    }
    </script>

</body>
</html>