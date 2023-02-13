<div class="container">
    <div class="text-center">
        <p class="font-weight-bold h5-responsive">
            <?= $no_pendaftaran ?>
            <br>
            <span class="font-weight-bolder"><?= $jenjang . ' | ' . $nama_santri ?></span>
        </p>
        <h4 class="h4-responsive">Status : <span class="font-weight-bold"><?= $status ?></span></h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="stepper stepper-horizontal">

                <li class="completed">
                    <a href="#!">
                        <span class="circle"><i class="fas fa-check"></i></span>
                        <span class="label">Pendaftaran</span>
                    </a>
                </li>
                <li class="<?= $status_proses_0 = ($upload_pas_foto == '' or $upload_pas_foto == NULL) ? '' : 'completed'; ?><?= $status_lulus_2 = ($status == 'Tidak Lulus') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_0 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Dokumen</span>
                    </a>
                </li>
                <li class="<?= $status_proses_1 = ($status == 'Lulus' or $status == 'Diterima' or $status == 'Tidak Diterima' or $status == 'Daftar Ulang' or $status == 'Tidak Daftar Ulang') ? 'completed' : ''; ?><?= $status_lulus_2 = ($status == 'Tidak Lulus') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_1 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Lulus</span>
                    </a>
                </li>
                <li class="<?= $status_proses_2 = ($status == 'Diterima' or $status == 'Daftar Ulang' or $status == 'Tidak Daftar Ulang') ? 'completed' : ''; ?><?= $status_lulus_2 = ($status == 'Tidak Diterima') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_2 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Diterima</span>
                    </a>
                </li>
                <li class="<?= $status_proses_3 = ($status == 'Daftar Ulang') ? 'completed' : ''; ?><?= $status_lulus_2 = ($status == 'Tidak Daftar Ulang') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_3 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Daftar Ulang</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
$ciphertext = base64_encode(openssl_encrypt($row->no_pendaftaran, "AES-128-ECB", $this->config->item('hash')));
return base_url('c_ppdb/read/' . $ciphertext);