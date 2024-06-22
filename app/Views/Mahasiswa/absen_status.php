<?php
$title = 'Kehadiran Dosen';
include(APPPATH . 'Views/template/header.php');
?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Status Kehadiran Dosen</h1>

    <input type="text" id="searchBar" onkeyup="searchDosen()" placeholder="Cari nama dosen.." class="border border-gray-300 rounded-lg p-2 mb-6 w-full">

    <table id="dosenTable" class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 py-2 px-4 text-left">Nama Dosen</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Status</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Aksi</th>
                <th class="border border-gray-300 py-2 px-4 text-left">Status Janji Temu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dosens as $dosen) : ?>
                <tr>
                    <td class="border border-gray-300 py-2 px-4"><?= $dosen['username'] ?></td>
                    <td class="border border-gray-300 py-2 px-4">
                        <span class="inline-block py-1 px-2 rounded-lg 
                        <?php
                        if ($dosen['status'] == 'Hadir') {
                            echo 'bg-green-400 text-white-400';
                        } elseif ($dosen['status'] == 'Tidak Hadir') {
                            echo 'bg-red-400 text-white-400';}
                            ?>">
                            <?= ucfirst($dosen['status']) ?>
                        </span>
                    </td>
                    <td class="border border-gray-300 py-2 px-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="openModal(<?= $dosen['id'] ?>, '<?= $dosen['username'] ?>')">Buat Janji</button>
                    </td>
                    <td class="border border-gray-300 py-2 px-4">
                        <span class="inline-block py-1 px-2 rounded-lg 
                            <?php
                            if ($dosen['janji_temu_status'] == 'Menunggu') {
                                echo 'bg-yellow-400 text-yellow-900';
                            } elseif ($dosen['janji_temu_status'] == 'Ditolak') {
                                echo 'bg-red-400 text-red-900';
                            } elseif ($dosen['janji_temu_status'] == 'Diterima') {
                                echo 'bg-green-400 text-green-900';
                            }
                            ?>
                        ">
                            <?= ucfirst($dosen['janji_temu_status']) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="janjiForm" action="<?= site_url('mahasiswa/create') ?>" method="post">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Buat Janji</h3>
                            <div class="mt-2">
                                <input type="hidden" name="dosen_id" id="dosen_id">
                                <input type="hidden" name="mahasiswa_id" value="<?= session()->get('mahasiswa_id') ?>">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dosen_nama">Nama Dosen</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dosen_nama" type="text" readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal">Tanggal</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tanggal" name="tanggal" type="date" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="waktu">Waktu</label>
                                    <div class="relative">
                                        <select id="hour" name="hour" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-20 inline-block">
                                            <?php for ($h = 0; $h < 24; $h++) : ?>
                                                <option value="<?= str_pad($h, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($h, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <span class="px-2">:</span>
                                        <select id="minute" name="minute" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-20 inline-block">
                                            <?php for ($m = 0; $m < 60; $m++) : ?>
                                                <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($m, 2, '0', STR_PAD_LEFT) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tempat">Tempat</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tempat" name="tempat" type="text" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="keterangan">Keterangan</label>
                                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="keterangan" name="keterangan" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" onclick="closeModal()">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(dosenId, dosenName) {
        document.getElementById('dosen_id').value = dosenId;
        document.getElementById('dosen_nama').value = dosenName;
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function searchDosen() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('searchBar');
        filter = input.value.toLowerCase();
        table = document.getElementById('dosenTable');
        tr = table.getElementsByTagName('tr');
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName('td')[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }
</script>

<?php include(APPPATH . 'Views/template/footer.php'); ?>