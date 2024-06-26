<?php $title = 'Home';
include(APPPATH . 'Views/template/d_header.php'); ?>

<div class="container mx-auto p-4">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-3xl font-bold mb-4"><?= esc($greeting) ?>, <?= esc($username) ?>!</h1>
        <p class="text-lg">Selamat datang di SIAKAD. Ini adalah halaman home Anda.</p>
        <!-- Tombol untuk membuka modal absen -->
    </div>
</div>

<?php include(APPPATH . 'Views/template/footer.php'); ?>
