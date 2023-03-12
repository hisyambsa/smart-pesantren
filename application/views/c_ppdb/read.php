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
            <ul class="stepper stepper-vertical">
                <li class="completed">
                    <a href="#!">
                        <span class="circle"><i class="fas fa-check"></i></span>
                        <span class="label">Pendaftaran</span>
                    </a>
                </li>
                <li class="<?= $status_proses_0 = ($status == 'Proses' or $upload_pas_foto == '' or $upload_pas_foto == NULL) ? '' : 'active'; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_0 == 'active') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Dokumen</span>
                    </a>
                    <?php if ($status == 'Proses' or $upload_pas_foto == '' or $upload_pas_foto == NULL) : ?>
                        <div class="step-content grey lighten-3">
                            <?php $ciphertext = base64_encode(openssl_encrypt($no_pendaftaran, "AES-128-ECB", $this->config->item('hash'))); ?>
                            <?php
                            $whitelist = array('127.0.0.1', "::1");
                            if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
                                $href =  "https://ppdb.smartponpes.id/c_ppdb/detail/$ciphertext";
                            } else {
                                $href =  base_url('c_ppdb/detail/' . $ciphertext);
                            }
                            ?>
                            <a href="<?= $href ?>">
                                <button class="btn btn-primary">
                                    UPLOAD DOKUMEN DISINI!
                                </button>
                            </a>
                        </div>
                    <?php endif ?>
                </li>
                <li class="<?= $status_proses_1 = ($status == 'Lulus' or $status == 'Diterima' or $status == 'Tidak Diterima' or $status == 'Daftar Ulang' or $status == 'Tidak Daftar Ulang') ? 'completed' : ''; ?><?= $status_lulus_2 = ($status == 'Tidak Lulus') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_1 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Status Kelulusan</span>
                    </a>
                </li>
                <li class="<?= $status_proses_2 = ($status == 'Diterima' or $status == 'Daftar Ulang' or $status == 'Tidak Daftar Ulang') ? 'completed' : ''; ?><?= $status_lulus_2 = ($status == 'Tidak Diterima') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_2 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Status Penerimaan</span>
                    </a>
                </li>
                <li class="<?= $status_proses_3 = ($status == 'Daftar Ulang') ? 'completed' : ''; ?><?= $status_lulus_2 = ($status == 'Tidak Daftar Ulang') ? 'warning' : ''; ?>">
                    <a href="#!">
                        <span class="circle"><?= $status_check = ($status_proses_3 == 'completed') ? '<i class="fas fa-check"></i>' : '<i class="fas fa-exclamation"></i>'; ?></span>
                        <span class="label">Status Daftar Ulang</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>