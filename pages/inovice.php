<?php
include('../includes/db.php');
require_once('../Classes/Tour.php');
require_once('../Classes/User.php');

session_start();
if(!isset($_SESSION['id'])){
    header('Location: /assad-2025/login.php');
    exit;
}

$user_id = $_SESSION['id'];
$tour_id = 0;
if(isset($_GET['id'])){
    $tour_id = $_GET['id'];
}

$pdo_db = new db();
$db = $pdo_db->connect();

$tourObj = new tour($db);
$tour = $tourObj->getTourById($tour_id);

$userObj = new User($pdo_db);
$user = $userObj->getUserById($user_id);

$prix = $tour['prix'];
$total = $prix;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #INV-<?= $tour_id ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <style>
        @media print { 
            @page { margin: 0; }
            body { background: white; -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
        body { font-family: 'Outfit', sans-serif; }
        .font-serif { font-family: 'Cinzel', serif; }
    </style>
</head>
<body class="bg-gray-800 flex flex-col items-center min-h-screen p-8">
    <div class="no-print w-full max-w-2xl mb-4 flex justify-between">
        <a href="my_reservation.php" class="text-white hover:text-gray-300 flex items-center gap-2">
            <span>&larr; Retour</span>
        </a>
        <button onclick="window.print()" class="bg-[#C6A87C] text-black font-bold px-6 py-2 rounded hover:bg-white transition">
            Imprimer
        </button>
    </div>
    <div class="bg-white w-full max-w-2xl p-12 shadow-2xl text-black">
        <div class="flex justify-between items-start border-b-2 border-[#C6A87C] pb-8 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-gray-900 tracking-wider">ASSAD ZOO</h1>
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest">Zoo Virtuel Officiel - CAN 2025</p>
                <p class="text-sm text-gray-600 mt-2">Rabat, Maroc</p>
            </div>
            <div class="text-right">
                <h2 class="text-4xl font-bold text-gray-200">FACTURE</h2>
                <p class="text-gray-500 font-bold mt-1">#INV-<?= $tour_id ?></p>
                <p class="text-sm text-gray-500">Date: <?= $tour['date_heure_debut'] ?></p>
            </div>
        </div>
        <div class="mb-10 flex justify-between">
            <div>
                <p class="text-xs text-gray-400 uppercase font-bold mb-1">Facturé à :</p>
                <p class="font-bold text-lg"><?= $user['full_name'] ?></p>
                <p class="text-sm text-gray-600"><?= $user['email'] ?></p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase font-bold mb-1">Statut :</p>
                <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded border border-green-200">PAYÉ</span>
            </div>
        </div>
        <table class="w-full text-left mb-10">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <th class="py-3 px-4">Description</th>
                    <th class="py-3 px-4 text-center">Qté</th>
                    <th class="py-3 px-4 text-right">Prix Unit.</th>
                    <th class="py-3 px-4 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                <tr>
                    <td class="py-4 px-4">
                        <p class="font-bold text-gray-800"><?= $tour['titre'] ?></p>
                        <p class="text-xs text-gray-500">Guide: -</p>
                    </td>
                    <td class="py-4 px-4 text-center">1</td>
                    <td class="py-4 px-4 text-right"><?= $prix ?> DH</td>
                    <td class="py-4 px-4 text-right font-bold"><?= $total ?> DH</td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end">
            <div class="w-1/2">
                <div class="flex justify-between py-4 border-t-2 border-[#C6A87C] mt-2">
                    <span class="text-lg font-serif font-bold">Total</span>
                    <span class="text-xl font-bold text-[#C6A87C]"><?= $total ?> DH</span>
                </div>
            </div>
        </div>
        <div class="mt-16 pt-8 border-t border-gray-100 text-center text-xs text-gray-400">
            <p>Merci de contribuer à la protection du Lion de l'Atlas.</p>
            <p>ASSAD Zoo S.A.R.L - RC 123456 - Rabat</p>
        </div>
    </div>
</body>
</html>