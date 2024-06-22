<?php $title = 'Edit Profil'; ?>
<?php include(APPPATH . 'Views/template/header.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Edit Profil</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="/profil/update_profile" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Username :</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= esc($mahasiswa['username']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap :</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= esc($biodata['nama_lengkap']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($biodata['email']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= esc($biodata['alamat']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon :</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= esc($biodata['telepon']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Foto Profil :</label>
                            <input type="file" class="form-control-file" id="profile_image" name="profile_image" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(APPPATH . 'Views/template/footer.php'); ?>
