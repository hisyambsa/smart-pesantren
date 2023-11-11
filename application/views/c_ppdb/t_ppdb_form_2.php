<script src="https://cdn.jsdelivr.net/npm/piexifjs@1.0.6/piexif.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/css/fileinput.min.css" integrity="sha512-8KeRJXvPns3KF9uGWdZW18Azo4c1SG8dy2IqiMBq8Il1wdj7EWtR3EGLwj+DnvznrRjn0oyBU+OEwJk7A79n7w==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/fileinput.min.js" integrity="sha512-vDrq7v1F/VUDuBTB+eILVfb9ErriIMW7Dn3JC/HOQLI8ZzTBTRRKrKJO3vfMmZFQpEGVpi+EYJFatPgVFxOKGA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/js/locales/id.min.js" integrity="sha512-jzCNGQc2Inz0st0pcHOFXbRuZSP6AoRDZk5gV++BA1v9T70FR612nsMmKZw+nuHP/UaZ/RdC5o5mkXQK3YOQVg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.3/themes/fas/theme.min.js" integrity="sha512-BeQMmfGMfVp5kEkEGxUtlT5R9+m7jDVr5LDFCG2EK9VR50cEhR0kKzD5bn3XtSit/qNoYQUtr405lf5aSCSF8A==" crossorigin="anonymous"></script>

<?= form_open_multipart($action, $attributes, $hidden); ?>
<div class="container">
    <p class="font-weight-bold h5-responsive">
        <?= $no_pendaftaran ?>
        <br>
        <span class="font-weight-bolder"><?= $jenjang . ' | ' . $nama_santri ?></span>
    </p>
    <div class="form-group md-form">
        <input required type="text" class="form-control" name="nomor_kartu_keluarga" id="id_nomor_kartu_keluarga" placeholder="Masukan Nomor Kartu Keluarga" value="<?php echo $nomor_kartu_keluarga; ?>" />
        <label for="varchar">Nomor Kartu Keluarga <?php echo form_error('nomor_kartu_keluarga') ?></label>
    </div>
    <div class="form-group">
        <div for="varchar">Punya Buku Nasab <?php echo form_error('punya_buku_nasab') ?></div>
        <!-- Material inline 1 -->
        <div class="form-check form-check-inline">
            <input required <?php echo set_radio('punya_buku_nasab', 'punya', $radio_punya_buku_nasab = ($punya_buku_nasab == 'punya') ? TRUE : FALSE); ?> value="punya" name="punya_buku_nasab" type="radio" class="form-check-input" id="id_punya_buku_nasab_1" name="punya_buku_nasab">
            <label class="form-check-label" for="id_punya_buku_nasab_1">Punya</label>
        </div>
        <!-- Material inline 2 -->
        <div class="form-check form-check-inline">
            <input <?php echo set_radio('punya_buku_nasab', 'tidak punya', $radio_punya_buku_nasab = ($punya_buku_nasab == 'tidak punya') ? TRUE : FALSE); ?> value="tidak punya" name="punya_buku_nasab" type="radio" class="form-check-input" id="id_punya_buku_nasab_2" name="punya_buku_nasab">
            <label class="form-check-label" for="id_punya_buku_nasab_2">Tidak Punya</label>
        </div>
    </div>
    <div class="form-group md-form">
        <input required type="text" class="form-control" name="nama_ayah" id="id_nama_ayah" placeholder="Masukan Nama Ayah Santri" value="<?php echo $nama_ayah; ?>" />
        <label for="varchar">Nama Ayah <?php echo form_error('nama_ayah') ?></label>
    </div>
    <div class="form-group md-form">
        <input required type="text" class="form-control" name="nama_ibu" id="id_nama_ibu" placeholder="Masukan Nama Ibu Santri" value="<?php echo $nama_ibu; ?>" />
        <label for="varchar">Nama Ibu <?php echo form_error('nama_ibu') ?></label>
    </div>

    <div class="alert alert-primary" role="alert">
        <p class="">
            Mohon Persiapkan Dokumen dalam format foto <br>
        </p>
        <ul>
            <li class="info-pas-foto">Pas Foto</li>
            <li class="info-kartu-keluarga">Kartu Keluarga</li>
            <li style="display:none;" class="info-buku-nasab">Buku Nasab</li>
            <li style="display:none;" class="info-ijasah-terakhir">Ijasah Terakhir dan Transkrip</li>
        </ul>
        <p> Ukuran File setiap Dokumen tidak lebih dari 10 MB (Megabyte)</p>
    </div>
    <div class="info-pas-foto"><?php echo form_error('upload_pas_foto') ?>
        <input data-name="pas_foto" file-upload="upload_pas_foto" accept="image/*,application/pdf" data-allowed-file-types='["image"]' data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini<br>Format didukung : image" data-drop-zone-title="UPLOAD PAS FOTO" class="file-input" type="file" name="upload_pas_foto" id="input-pas-foto" />
    </div>
    <div class="info-kartu-keluarga"><?php echo form_error('upload_kartu_keluarga') ?>
        <input data-name="kartu_keluarga" file-upload="upload_kartu_keluarga" accept="image/*,application/pdf" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini<br>Format didukung : image & pdf" data-drop-zone-title="UPLOAD KARTU KELUARGA" class="file-input" type="file" name="upload_kartu_keluarga" id="input-kartu-keluarga" />
    </div>
    <div class="info-buku-nasab border border-danger p-3 m-3" style="display:none;" class="form-group"><?php echo form_error('upload_nasab') ?>
        <input data-name="nasab" file-upload="upload_nasab" accept="image/*,application/pdf" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini<br>Format didukung : image & pdf" data-drop-zone-title="UPLOAD NASAB" class="file-input" type="file" name="upload_nasab" id="input-nasab" />
    </div>
    <div class="info-ijasah-terakhir"><?php echo form_error('upload_ijasah') ?>
        <input data-name="ijasah" file-upload="upload_ijasah" accept="image/*,application/pdf" data-msg-placeholder="Select {files} for upload..." data-drop-zone-click-title="<br>Klik disini<br>Format didukung : image & pdf" data-drop-zone-title="UPLOAD IJAZAH" class="file-input" type="file" name="upload_ijasah" id="input-ijasah" />
    </div>
</div>
<button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">SUBMIT</button>
<?= form_close() ?>

<script>
    $(function() {
        <?php if ($jenjang != "1") : ?>
            $('.info-ijasah-terakhir').show();
        <?php else : ?>
            $('.info-ijasah-terakhir').hide();
        <?php endif ?>
        if ($("input[name='punya_buku_nasab']:checked").val() == 'punya') {
            $('.info-buku-nasab').show();
        }
        $('input[name = "punya_buku_nasab"').change(function(e) {
            e.preventDefault();
            if ($("input[name='punya_buku_nasab']:checked").val() == 'punya') {
                $('.info-buku-nasab').show();
            } else {
                $('.info-buku-nasab').hide();
            }
        });
    });
</script>

<?php
$this->load->view('c_ppdb/t_ppdb_form_3');

?>