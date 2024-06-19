<?php
$title = 'Janji Temu';
include(APPPATH . 'Views/template/header.php');
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Janji Temu</h1>

    <table id="janjiTemuTable" class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 py-2 px-4 text-left">Dosen</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Mahasiswa</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Tanggal</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Waktu</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Tempat</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Keterangan</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($janjiTemuList as $janjiTemu): ?>
                <tr>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['dosen_id'] ?></td>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['mahasiswa_id'] ?></td>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['tanggal'] ?></td>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['waktu'] ?></td>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['tempat'] ?></td>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['keterangan'] ?></td>
                    <td class="border border-gray-300 py-2 px-4"><?= $janjiTemu['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include(APPPATH . 'Views/template/footer.php'); ?>
