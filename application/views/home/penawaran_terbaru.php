<div class="container my-5">
    <h2 class="h4-responsive red-text">Penawaran Terbaru</h2>
    <hr class="border-bottom border-danger my-2">
    <div class="row">
        <div class="col-md-4">
            <p class="text-justify">
                Kami menawarkan penawaran terus menerus
                sepanjang musim sepanjang tahun, dan
                penawaran kami ditandai dengan harga
                yang kompetitif dan kemewahan
                yang tinggi sehingga kami berusaha
                untuk memuaskan pelanggan kami
                di tingkat pertama. Semua penawaran
            </p>
            <a href="<?= base_url('penawaran') ?>"><button class="btn btn-info btn-rounded"> LIHAT SEMUA PENAWARAN</button></a>
        </div>
        <div class="col-md-8">
            <div class="card-group text-center">
                <?php $i = 0; ?>
                <?php foreach ($data_penawaran_umroh as $key) { ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="<?= base_url("uploads/images/$key->master_foto") ?>" data-alt="Foto <?= $key->nama_paket ?>" data-title="<?= $key->nama_paket ?>" data-lightbox="list_penawaran">
                                <img loading="lazy" style="max-height: 120px;" src="<?= base_url("uploads/images/$key->master_foto") ?>" class="img-flduid" alt="1">
                            </a>
                            <hr>
                            <div class="text-center">
                                <p class="red-text"><?= $key->nama_paket ?></p>
                                <a href="<?= base_url('penawaran/detail/umroh/') . $key->id ?>" class="btn btn-danger"><i class="fas fa-clone left"></i> lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php } ?>
                <?php foreach ($data_penawaran_tour as $key) { ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="<?= base_url("uploads/images/$key->master_foto") ?>" data-alt="Foto <?= $key->nama_paket ?>" data-title="<?= $key->nama_paket ?>" data-lightbox="list_penawaran">
                                <img loading="lazy" style="max-height: 120px;" src="<?= base_url("uploads/images/$key->master_foto") ?>" class="img-flduid" alt="1">
                            </a>
                            <hr>
                            <div class="text-center">
                                <p class="red-text"><?= $key->nama_paket ?></p>
                                <a href="<?= base_url('penawaran/detail/tour/') . $key->id ?>" class="btn btn-danger"><i class="fas fa-clone left"></i> lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php } ?>
                <?php if ($i == 0) : ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-muted text-center display-4">
                                TIDAK ADA <br> PENAWARAN TERBARU
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>