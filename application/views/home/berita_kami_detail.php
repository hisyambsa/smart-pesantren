<?php

use Carbon\Carbon;

Carbon::setLocale('id');
?>
<div class="container my-4">
    <div class="row">
        <div class="col-md-4">
            <img src="<?= base_url('uploads/berita/' . $data_berita->attachment) ?>" alt="gambar" class="img-fluid">
        </div>
        <div class="col-md-8">
            <p class="text-justify">
                <?= $data_berita->isi ?></p>
        </div>
    </div>
    <div class="text-right">
        <?= $data_berita->penulis ?>
        <br>
        <?= Carbon::parse($data_berita->update_at)->isoFormat('dddd, D MMMM ggg') ?>
    </div>
</div>