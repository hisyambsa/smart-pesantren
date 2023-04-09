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
<h2 style="margin-top:0px"><?php echo $button ?> T_santri </h2>
<?= form_open($action) ?>
<div class="form-group md-form">
    <input type="text" class="form-control" name="ppdb_id" id="id_ppdb_id" placeholder="Masukan Ppdb Id" value="<?php echo $ppdb_id; ?>" />
    <label for="int">Ppdb Id <?php echo form_error('ppdb_id') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nis" id="id_nis" placeholder="Masukan Nis" value="<?php echo $nis; ?>" />
    <label for="varchar">Nis <?php echo form_error('nis') ?></label>
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
    <input type="text" class="form-control" name="province_id" id="id_province_id" placeholder="Masukan Province Id" value="<?php echo $province_id; ?>" />
    <label for="char">Province Id <?php echo form_error('province_id') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="regency_id" id="id_regency_id" placeholder="Masukan Regency Id" value="<?php echo $regency_id; ?>" />
    <label for="char">Regency Id <?php echo form_error('regency_id') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="district_id" id="id_district_id" placeholder="Masukan District Id" value="<?php echo $district_id; ?>" />
    <label for="char">District Id <?php echo form_error('district_id') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="village_id" id="id_village_id" placeholder="Masukan Village Id" value="<?php echo $village_id; ?>" />
    <label for="char">Village Id <?php echo form_error('village_id') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="jenjang" id="id_jenjang" placeholder="Masukan Jenjang" value="<?php echo $jenjang; ?>" />
    <label for="enum">Jenjang <?php echo form_error('jenjang') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="email" id="id_email" placeholder="Masukan Email" value="<?php echo $email; ?>" />
    <label for="varchar">Email <?php echo form_error('email') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="no_hp" id="id_no_hp" placeholder="Masukan No Hp" value="<?php echo $no_hp; ?>" />
    <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nomor_kartu_keluarga" id="id_nomor_kartu_keluarga" placeholder="Masukan Nomor Kartu Keluarga" value="<?php echo $nomor_kartu_keluarga; ?>" />
    <label for="varchar">Nomor Kartu Keluarga <?php echo form_error('nomor_kartu_keluarga') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="punya_buku_nasab" id="id_punya_buku_nasab" placeholder="Masukan Punya Buku Nasab" value="<?php echo $punya_buku_nasab; ?>" />
    <label for="enum">Punya Buku Nasab <?php echo form_error('punya_buku_nasab') ?></label>
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
    <input type="text" class="form-control" name="upload_pas_foto" id="id_upload_pas_foto" placeholder="Masukan Upload Pas Foto" value="<?php echo $upload_pas_foto; ?>" />
    <label for="varchar">Upload Pas Foto <?php echo form_error('upload_pas_foto') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="upload_kartu_keluarga" id="id_upload_kartu_keluarga" placeholder="Masukan Upload Kartu Keluarga" value="<?php echo $upload_kartu_keluarga; ?>" />
    <label for="varchar">Upload Kartu Keluarga <?php echo form_error('upload_kartu_keluarga') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="upload_nasab" id="id_upload_nasab" placeholder="Masukan Upload Nasab" value="<?php echo $upload_nasab; ?>" />
    <label for="varchar">Upload Nasab <?php echo form_error('upload_nasab') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="upload_ijasah" id="id_upload_ijasah" placeholder="Masukan Upload Ijasah" value="<?php echo $upload_ijasah; ?>" />
    <label for="varchar">Upload Ijasah <?php echo form_error('upload_ijasah') ?></label>
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
<a href="<?php echo site_url('c_santri') ?>" class="btn btn-danger btn-rounded">Batal</a>
<?= form_close() ?>