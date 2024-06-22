<?php $title = 'Profil Mahasiswa'; ?>
<?php include(APPPATH . 'Views/template/header.php'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Profil Mahasiswa</h3>
                </div>
                <div class="card-body text-center">
                    <img src="/uploads/profile/<?= esc($mahasiswa['profile_image']) ?>" alt="Profile Image" width="100">
                    <p><strong>Username:</strong> <?= esc($mahasiswa['username']) ?></p>
                    <p><strong>Nama Lengkap:</strong> <?= esc($biodata['nama_lengkap']) ?></p>
                    <p><strong>Email:</strong> <?= esc($biodata['email']) ?></p>
                    <p><strong>Alamat:</strong> <?= esc($biodata['alamat']) ?></p>
                    <p><strong>Telepon:</strong> <?= esc($biodata['telepon']) ?></p>

                    <a href="<?= route_to('edit_profile') ?>" class="btn btn-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(APPPATH . 'Views/template/footer.php'); ?>