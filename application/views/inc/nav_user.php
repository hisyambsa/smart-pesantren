<!--Navbar-->
<nav class="navbar navbar-expand-lg sticky-top navbar-light justify-content-between red-text">
    <div class="container">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img loading="lazy" src="<?= base_url('uploads/settings/' . $this->session->userdata('settings')->logo_16_9) ?>" height="30" alt="logo sidebar">
        </a>

        <!-- Collapse button -->
        <button class="navbar-toggler btn-sm btn-outline-danger red-text" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon red-text"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav justify-content-between ml-auto">
                <li class="nav-item">
                    <a class="nav-link red-text" href="<?= base_url('') ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link red-text dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tentang Perusahaan</a>
                    <div class="dropdown-menu dropdown-danger" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item red-text" href="<?= base_url('ringkasan') ?>">Ringkasan</a>
                        <a class="dropdown-item red-text" href="<?= base_url('visi-misi') ?>">Visi dan Misi</a>
                        <a class="dropdown-item red-text d-none" href="<?= base_url('kata-ketua') ?>">Kata Ketua</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link red-text" href="<?= base_url('penawaran/') ?>">Penawaran</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown d-none">
                    <a class="nav-link red-text dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pelayanan Kami</a>
                    <div class="dropdown-menu dropdown-danger" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item red-text" href="<?= base_url('belajar') ?>">Belajar ke Luar Negeri</a>
                        <a class="dropdown-item red-text" href="<?= base_url('reservasi-hotel') ?>">Reservasi Hotel</a>
                        <a class="dropdown-item red-text" href="<?= base_url('penerbitan-tiket') ?>">Penerbitan Tiket</a>
                        <a class="dropdown-item red-text" href="<?= base_url('penyewaan-mobil') ?>">Penyewaan Mobil dan Lisensi Internasional</a>
                    </div>
                </li>
                <li class="nav-item act">
                    <a class="nav-link red-text" href="<?= base_url('kontak-kami') ?>">Kontak Kami</a>
                </li>
                <?php
                if ($this->ion_auth->logged_in()) { ?>
                    <li class="nav-item act">
                        <a class="nav-link green-text" href="<?= base_url('admin/home') ?>"><i class="fa-solid fa-gears fa-lg"></i></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Collapsible content -->

    </div>
</nav>
<!--/.Navbar-->