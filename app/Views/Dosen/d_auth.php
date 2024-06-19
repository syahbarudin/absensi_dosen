        <?php
        $title = isset($page) && $page == 'daftar' ? 'Daftar' : 'Login';
        $is_auth_page = true;
        include(APPPATH . 'Views/template/header.php');
        ?>

        <div class="vid-container">
            <video class="bgvid" autoplay muted loop>
                <source src="<?= base_url('bg/background.mp4') ?>" type="video/mp4">
            </video>
            <div class="inner-container">
                <div class="box">
                    <?php if (isset($page) && $page == 'daftar') : ?>
                        <h1>Daftar</h1>
                        <form action="<?= site_url('d/register') ?>" method="post">
                            <input type="text" name="username" placeholder="Username" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="submit">Daftar</button>
                        </form>
                        <p>Already a member? <a href="<?= site_url('/d_auth') ?>">Login</a></p>

                    <?php else : ?>
                        <h1>Login</h1>
                        <form action="<?= site_url('d/login') ?>" method="post">
                            <input type="text" name="username" placeholder="Username" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="submit">Login</button>
                        </form>
                        <p>Not a member? <a href="<?= current_url()?>?page=daftar">Sign Up</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php include(APPPATH . 'Views/template/footer.php'); ?>