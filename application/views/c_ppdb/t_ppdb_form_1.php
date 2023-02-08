<?= form_open($action, $attributes, $hidden) ?>
<div class="form-group md-form">
    <input length="16" maxlength="16" type="text" class="form-control" name="nik_santri" id="id_nik_santri" placeholder="Masukan NIK Calon Santri/wati" value="<?php echo $nik_santri; ?>" />
    <label for="varchar">NIK Calon Santri/wati <?php echo form_error('nik_santri') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nama_santri" id="id_nama_santri" placeholder="Masukan Nama Calon Santri/wati" value="<?php echo $nama_santri; ?>" />
    <label for="varchar">Nama Calon Santri/wati <?php echo form_error('nama_santri') ?></label>
</div>
<div class="form-group">
    <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
    <select data-placeholder="Pilih Jenis Kelamin" name="jenis_kelamin" id="id_jenis_kelamin" class="form-control chosen-select">
        <option value="">Pilih Jenis Kelamin</option>
        <option <?php echo set_select('jenis_kelamin', 'Laki-Laki', $select_jenis_kelamin = ($jenis_kelamin == 'Laki-Laki') ? TRUE : FALSE) ?> value="Laki-Laki">Laki-Laki</option>
        <option <?php echo set_select('jenis_kelamin', 'Perempuan', $select_jenis_kelamin = ($jenis_kelamin == 'Perempuan') ? TRUE : FALSE) ?> value="Perempuan">Perempuan</option>
    </select>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="tempat_lahir" id="id_tempat_lahir" placeholder="Masukan Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
    <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control datepicker" id="id_tanggal_lahir_form" placeholder="Masukan Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
    <input type="hidden" class="form-control" name="tanggal_lahir" id="id_tanggal_lahir" placeholder="Masukan Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
    <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
</div>
<div class="form-group md-form">
    <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
    <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
</div>
<div class="form-group">
    <label for="id_provinsi" class="control-label">Provinsi</label>
    <div class="">
        <select data-placeholder="-- PILIH PROVINSI--" name="province_id" id="id_provinsi" class="form-control">
            <option>-- PILIH PROVINSI--</option>
            <?php
            $this->db->select('id,UPPER(name) as name');
            $data_db = $this->db->get('provinces')->result();
            foreach ($data_db as $key) : ?>

                <option value="<?= $key->id ?>"><?= $key->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="id_kota_kabupaten" class="control-label">Kota/Kabupaten</label>
    <div class="">
        <select data-placeholder="-- PILIH KOTA/KABUPATEN--" name="regency_id" id="id_kota_kabupaten" class="form-control">
        </select>
    </div>
</div>
<div class="form-group">
    <label for="id_kecamatan" class="control-label">Kecamatan</label>
    <div class="">
        <select data-placeholder="-- PILIH KECAMATAN --" name="district_id" id="id_kecamatan" class="form-control">
        </select>
    </div>
</div>
<div class="form-group">
    <label for="id_kelurahan" class="control-label">Kelurahan</label>
    <div class="">
        <select data-placeholder="-- PILIH KELURAHAN/DESA --" name="village_id" id="id_kelurahan" class="form-control">
        </select>
    </div>
</div>
<div class="form-group my-3">
    <label for="varchar">Jenjang yang dipilih <?php echo form_error('jenjang') ?></label>
    <select data-placeholder="Pilih Jenjang" name="jenjang" id="id_jenjang" class="form-control chosen-select">
        <option value="">Pilih Jenjang</option>
        <option <?php echo set_select('jenjang', "I'dadiyah", $select_jenjang = ($jenjang == "I'dadiyah") ? TRUE : FALSE) ?> value="I'dadiyah">I'dadiyah</option>
        <option <?php echo set_select('jenjang', 'Ibtidaiyah', $select_jenjang = ($jenjang == 'Ibtidaiyah') ? TRUE : FALSE) ?> value="Ibtidaiyah">Ibtidaiyah</option>
        <option <?php echo set_select('jenjang', 'Tsanawiyah', $select_jenjang = ($jenjang == 'Tsanawiyah') ? TRUE : FALSE) ?> value="Tsanawiyah">Tsanawiyah</option>
        <option <?php echo set_select('jenjang', 'Aliyah', $select_jenjang = ($jenjang == 'Aliyah') ? TRUE : FALSE) ?> value="Aliyah">Aliyah</option>
    </select>
</div>
<div class="form-group md-form">
    <input type="email" class="form-control" name="email" id="id_email" placeholder="Masukan Alamat Email" value="<?php echo $email; ?>" />
    <label for="varchar">Alamat Email <?php echo form_error('email') ?></label>
</div>
<div class="form-group">
    <label for="varchar">No Handphone <?php echo form_error('no_hp') ?></label>
    <input type="telp" class="form-control" name="no_hp" id="id_no_hp" placeholder="Masukan No Handphone" value="<?php echo $no_hp; ?>" />
</div>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<hr>
<button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">DAFTAR SEKARANG</button>
<?= form_close() ?>