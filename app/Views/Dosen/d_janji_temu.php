<?php $title = 'Persetujuan';
include(APPPATH . 'Views/template/d_header.php'); ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Persetujuan Janji Temu</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Mahasiswa</th>
                <th class="py-2 px-4 border-b">Tanggal</th>
                <th class="py-2 px-4 border-b">Waktu</th>
                <th class="py-2 px-4 border-b">Tempat</th>
                <th class="py-2 px-4 border-b">Keterangan</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($janjiTemuList as $janjiTemu): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?= esc($janjiTemu['username_mahasiswa   ']) ?></td>
                    <td class="py-2 px-4 border-b"><?= esc($janjiTemu['tanggal']) ?></td>
                    <td class="py-2 px-4 border-b"><?= esc($janjiTemu['waktu']) ?></td>
                    <td class="py-2 px-4 border-b"><?= esc($janjiTemu['tempat']) ?></td>
                    <td class="py-2 px-4 border-b"><?= esc($janjiTemu['keterangan']) ?></td>
                    <td class="py-2 px-4 border-b">
                        <span class="inline-block py-1 px-2 rounded-lg 
                            <?= $janjiTemu['status'] == 'pending' ? 'bg-yellow-400 text-yellow-900' : ($janjiTemu['status'] == 'rejected' ? 'bg-red-400 text-red-900' : 'bg-green-400 text-green-900') ?>">
                            <?= ucfirst($janjiTemu['status']) ?>
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="<?= site_url('dosen/janji_temu/updateStatus/' . $janjiTemu['id'] . '/Disetujui') ?>" class="bg-green-500 text-white py-1 px-2 rounded">Setujui</a>
                        <a href="<?= site_url('dosen/janji_temu/updateStatus/' . $janjiTemu['id'] . '/Dibatalkan') ?>" class="bg-red-500 text-white py-1 px-2 rounded">Tolak</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include(APPPATH . 'Views/template/footer.php'); ?>