<?= form_open($action, $attributes, $hidden) ?>
<div class="container">
    <p class="font-weight-bold h5-responsive">
        <?= $no_pendaftaran ?>
        <br>
        <span class="font-weight-bolder"><?= $jenjang . ' | ' . $nama_santri ?></span>
    </p>
    <div class="form-group md-form">
        <input type="text" class="form-control" name="nomor_kartu_keluarga" id="id_nomor_kartu_keluarga" placeholder="Masukan Nomor Kartu Keluarga" value="<?php echo $nomor_kartu_keluarga; ?>" />
        <label for="varchar">Nomor Kartu Keluarga <?php echo form_error('nomor_kartu_keluarga') ?></label>
    </div>
    <div class="form-group">
        <div for="varchar">Punya Buku Nasab <?php echo form_error('punya_buku_nasab') ?></div>
        <!-- Material inline 1 -->
        <div class="form-check form-check-inline">
            <input <?php echo set_radio('punya_buku_nasab', 'punya', $radio_punya_buku_nasab = ($punya_buku_nasab == 'punya') ? TRUE : FALSE); ?> value="punya" type="radio" class="form-check-input" id="id_punya_buku_nasab_1" name="punya_buku_nasab">
            <label class="form-check-label" for="id_punya_buku_nasab_1">Punya</label>
        </div>
        <!-- Material inline 2 -->
        <div class="form-check form-check-inline">
            <input <?php echo set_radio('punya_buku_nasab', 'tidak punya', $radio_punya_buku_nasab = ($punya_buku_nasab == 'tidak punya') ? TRUE : FALSE); ?> value="tidak punya" type="radio" class="form-check-input" id="id_punya_buku_nasab_2" name="punya_buku_nasab">
            <label class="form-check-label" for="id_punya_buku_nasab_2">Tidak Punya</label>
        </div>
    </div>
    <div class="form-group md-form">
        <input type="text" class="form-control" name="nama_ayah" id="id_nama_ayah" placeholder="Masukan Nama Ayah Santri" value="<?php echo $nama_ayah; ?>" />
        <label for="varchar">Nama Ayah <?php echo form_error('nama_ayah') ?></label>
    </div>
    <div class="form-group md-form">
        <input type="text" class="form-control" name="nama_ibu" id="id_nama_ibu" placeholder="Masukan Nama Ibu Santri" value="<?php echo $nama_ibu; ?>" />
        <label for="varchar">Nama Ibu <?php echo form_error('nama_ibu') ?></label>
    </div>
    <div class="alert alert-primary" role="alert">
        <p class="">
            Mohon Persiapkan Dokumen Scan dalam format .pdf <br>
        </p>
        <ul>
            <li id="info-kartu-keluarga">Kartu Keluarga</li>
            <li style="display:none;" id="info-ijasah-terakhir">Ijasah Terakhir dan Transkrip</li>
            <li style="display:none;" id="info-buku-nasab">Buku Nasab</li>
        </ul>
        <p> Ukuran File setiap Dokumen tidak lebih dari 2 MB (Megabyte)</p>
    </div>
</div>
<button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">SUBMIT</button>
<?= form_close() ?>

<script>
    $(function() {
        <?php if ($jenjang != "I'dadiyah") : ?>
            $('#info-ijasah-terakhir').show();
        <?php endif ?>
        $('input[name = "punya_buku_nasab"').change(function(e) {
            e.preventDefault();
            if ($("input[name='punya_buku_nasab']:checked").val() == 'punya') {
                $('#info-buku-nasab').show();
            } else {
                $('#info-buku-nasab').hide();
            }
        });
    });
</script>