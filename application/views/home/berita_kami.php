<?php

use Carbon\Carbon;
?>
<div class="container">
    <p class="lead"><span class="red-text">Berita Kami</span></p>
    <hr class="border-bottom border-danger my-2">

    <div class="list-group">
        <?php foreach ($data_berita as $key) { ?>
            <a href="<?= base_url('home/berita_kami_detail/' . $key->id) ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-2 h5 blue-text"><?= $key->judul ?></h5>

                    <small>
                        <?php
                        $dt = Carbon::parse($key->timestamp);
                        echo $dt->diffForHumans();
                        ?>
                    </small>
                </div>
                <p class="mb-2"><?= $key->isi ?></p>
                <small><?= $key->penulis ?></small>
            </a>
        <?php } ?>
    </div>

</div>
<script>
    $(function() {
        $('.carousel').carousel()
    });
</script>