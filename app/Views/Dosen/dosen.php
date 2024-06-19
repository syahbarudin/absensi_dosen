<?php $title = 'Dosen'; ?>
<?php include(APPPATH . 'Views/template/d_header.php'); ?>

<div class="container mx-auto p-4">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-3xl font-bold mb-4"><?= esc($greeting) ?>, <?= esc($username) ?>!</h1>
        <p class="text-lg">Selamat datang di SIAKAD. Ini adalah halaman home Anda.</p>
        <!-- Tombol untuk membuka modal absen -->
        <button id="absenButton" class="mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Absen
        </button>
    </div>
</div>

<!-- Modal Absen -->
<div id="absenModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Konten modal -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Absen</h3>
                        <p id="tanggal" class="text-sm font-medium text-gray-700"></p>
                        <p id="waktu" class="text-sm font-medium text-gray-700 mb-4"></p>
                        <!-- Container untuk peta Leaflet -->
                        <div id="map" class="h-64 rounded-lg shadow-md"></div>
                        <p id="lokasi" class="text-sm font-medium text-gray-700 mt-4"></p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="closeModal" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
                <button id="absenSubmit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Absen
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Skrip JavaScript untuk Leaflet.js -->
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- Skrip JavaScript kustom Anda -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var absenButton = document.getElementById('absenButton');
    var absenModal = document.getElementById('absenModal');
    var closeModal = document.getElementById('closeModal');
    var tanggalInput = document.getElementById('tanggal');
    var waktuInput = document.getElementById('waktu');
    var mapContainer = document.getElementById('map');

    absenButton.addEventListener('click', function () {
        absenModal.classList.remove('hidden');
        var now = new Date();
        var tanggal = now.toISOString().slice(0, 10);
        var waktu = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        tanggalInput.textContent = 'Tanggal: ' + tanggal;
        waktuInput.textContent = 'Waktu: ' + waktu;

        var map = L.map(mapContainer).setView([-6.2088, 106.8456], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                L.marker(userLocation).addTo(map)
                    .bindPopup('Lokasi Anda')
                    .openPopup();

                document.getElementById('lokasi').textContent = 'Lokasi Anda: ' + userLocation.lat + ', ' + userLocation.lng;
                map.setView(userLocation, 15);
            }, function (error) {
                console.error(error);
                document.getElementById('lokasi').textContent = 'Tidak dapat mengambil lokasi';
            });
        } else {
            document.getElementById('lokasi').textContent = 'Geolokasi tidak didukung oleh browser ini';
        }
    });

    closeModal.addEventListener('click', function () {
        absenModal.classList.add('hidden');
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.sm:inline-block')) {
            absenModal.classList.add('hidden');
        }
    });

    document.getElementById('absenSubmit').addEventListener('click', function () {
        var tanggal = document.getElementById('tanggal').textContent.replace('Tanggal: ', '');
        var waktu = document.getElementById('waktu').textContent.replace('Waktu: ', '');
        var lokasi = document.getElementById('lokasi').textContent.replace('Lokasi Anda: ', '');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= site_url('absen/absen') ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert('Absen berhasil disimpan!');
                    absenModal.classList.add('hidden');
                } else {
                    alert('Gagal menyimpan absen.');
                }
            }
        };
        var data = JSON.stringify({ tanggal: tanggal, waktu: waktu, lokasi: lokasi });
        xhr.send(data);
    });
});
</script>

<?php include(APPPATH . 'Views/template/footer.php'); ?>
