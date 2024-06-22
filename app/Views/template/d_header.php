<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Siakad | <?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Pemanggilan Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5HVqk4dgR3ra48Ype4+WHgeN/TJO6ptg5WYLTKL4r1lqQ==" crossorigin=""></script>
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">

    <script src="<?= base_url('conf/script.js') ?>"></script>


    <link rel="icon" type="image/png" href="<?= base_url('assets/upb.png') ?>">
</head>

<body>
    <?php if (!isset($is_auth_page) || !$is_auth_page) : ?>
        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center text-white text-lg font-bold">
                    Siakad
                    <br>
                    <a href="<?= site_url('info') ?>" class="ml-80 text-gray-300 hover:text-white">Info</a>
                    <a href="<?= site_url('d_absen') ?>" class="ml-20 text-gray-300 hover:text-white">Absen</a>
                    <a href="<?= site_url('dosen/janji_temu') ?>" class="ml-20 text-gray-300 hover:text-white">Mahasiswa</a>
                </div>
                <div class="relative">
                    <?php if (current_url() == site_url('profil')) : ?>
                        <a href="<?= site_url('home') ?>" class="text-gray-300 hover:text-white">
                            <img src="<?= base_url('backicon.png') ?>" alt="Kembali" class="w-6 h-6">
                        </a>
                    <?php else : ?>
                        <button id="menuButton" class="focus:outline-none hover:text-white">
                            Menu
                        </button>
                        <div id="menuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                            <a href="<?= site_url('d_profil') ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profil</a>
                            <a href="<?= site_url('d/logout') ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    <?php endif; ?>