<?php
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyambsa.github.io ...... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/
?>
<h2 style="margin-top:0px"><?php echo $button ?> T_ppdb </h2>
<?= form_open($action) ?>
<div class="form-group md-form">
    <input type="text" class="form-control" name="no_pendaftaran" id="id_no_pendaftaran" placeholder="Masukan No Pendaftaran" value="<?php echo $no_pendaftaran; ?>" />
    <label for="varchar">No Pendaftaran <?php echo form_error('no_pendaftaran') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nik_santri" id="id_nik_santri" placeholder="Masukan Nik Santri" value="<?php echo $nik_santri; ?>" />
    <label for="varchar">Nik Santri <?php echo form_error('nik_santri') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nama_santri" id="id_nama_santri" placeholder="Masukan Nama Santri" value="<?php echo $nama_santri; ?>" />
    <label for="varchar">Nama Santri <?php echo form_error('nama_santri') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="jenis_kelamin" id="id_jenis_kelamin" placeholder="Masukan Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
    <label for="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="tempat_lahir" id="id_tempat_lahir" placeholder="Masukan Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
    <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="tanggal_lahir" id="id_tanggal_lahir" placeholder="Masukan Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
    <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
</div>
<div class="form-group md-form">
    <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
    <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="jenjang" id="id_jenjang" placeholder="Masukan Jenjang" value="<?php echo $jenjang; ?>" />
    <label for="enum">Jenjang <?php echo form_error('jenjang') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nama_ayah" id="id_nama_ayah" placeholder="Masukan Nama Ayah" value="<?php echo $nama_ayah; ?>" />
    <label for="varchar">Nama Ayah <?php echo form_error('nama_ayah') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nama_ibu" id="id_nama_ibu" placeholder="Masukan Nama Ibu" value="<?php echo $nama_ibu; ?>" />
    <label for="varchar">Nama Ibu <?php echo form_error('nama_ibu') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="golongan_darah" id="id_golongan_darah" placeholder="Masukan Golongan Darah" value="<?php echo $golongan_darah; ?>" />
    <label for="enum">Golongan Darah <?php echo form_error('golongan_darah') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="status" id="id_status" placeholder="Masukan Status" value="<?php echo $status; ?>" />
    <label for="enum">Status <?php echo form_error('status') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="timestamp" id="id_timestamp" placeholder="Masukan Timestamp" value="<?php echo $timestamp; ?>" />
    <label for="timestamp">Timestamp <?php echo form_error('timestamp') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="create_by" id="id_create_by" placeholder="Masukan Create By" value="<?php echo $create_by; ?>" />
    <label for="varchar">Create By <?php echo form_error('create_by') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="modify" id="id_modify" placeholder="Masukan Modify" value="<?php echo $modify; ?>" />
    <label for="timestamp">Modify <?php echo form_error('modify') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="modify_by" id="id_modify_by" placeholder="Masukan Modify By" value="<?php echo $modify_by; ?>" />
    <label for="varchar">Modify By <?php echo form_error('modify_by') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="delete_at" id="id_delete_at" placeholder="Masukan Delete At" value="<?php echo $delete_at; ?>" />
    <label for="int">Delete At <?php echo form_error('delete_at') ?></label>
</div>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<button type="submit" class="btn btn-primary btn-rounded"><?php echo $button ?></button>
<a href="<?php echo site_url('c_ppdb') ?>" class="btn btn-danger btn-rounded">Batal</a>
<?= form_close() ?>