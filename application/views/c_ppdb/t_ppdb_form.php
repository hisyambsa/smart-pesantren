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
<script src="<?= base_url('assets/user/chosen_bug_mobile.js') ?>"></script>
<script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="rgba-green-slight">
    <div class="container grey lighten-5 py-3">
        <div class="text-center">
            <h2 class="h2-responsive">P P D B </h2>
            <h3 class="h3-responsive text-monospace">Pondok Pesantren</h3>
            <h4 class="h4-responsive font-weight-bold">Darrullughah Wadda'wah Jawa Timur</h4>
        </div>
        <div class="row align">
            <div class="col-md-6 order-md-2 py-md-5">
                <img src="<?= base_url('images/form_ppdb.png') ?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="py-3 col-md-6 order-md-1">
                <?= form_open($action, $attributes, $hidden) ?>
                <div class="form-group md-form">
                    <input length="16" maxlength="16" type="text" class="form-control" name="nik_santri" id="id_nik_santri" placeholder="Masukan NIK Calon Siswa" value="<?php echo $nik_santri; ?>" />
                    <label for="varchar">NIK Calon Siswa <?php echo form_error('nik_santri') ?></label>
                </div>
                <div class="form-group md-form">
                    <input type="text" class="form-control" name="nama_santri" id="id_nama_santri" placeholder="Masukan Nama Calon Siswa" value="<?php echo $nama_santri; ?>" />
                    <label for="varchar">Nama Calon Siswa <?php echo form_error('nama_santri') ?></label>
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
                    <label for="varchar">Jenjang yang dipilih <?php echo form_error('jenjang') ?></label>
                    <select data-placeholder="Pilih Jenjang" name="jenjang" id="id_jenjang" class="form-control chosen-select">
                        <option value="">Pilih Jenjang</option>
                        <option <?php echo set_select('jenjang', "I'dadiyah", $select_jenjang = ($jenjang == "I'dadiyah") ? TRUE : FALSE) ?> value="I'dadiyah">I'dadiyah</option>
                        <option <?php echo set_select('jenjang', 'Ibtidaiyah', $select_jenjang = ($jenjang == 'Ibtidaiyah') ? TRUE : FALSE) ?> value="Ibtidaiyah">Ibtidaiyah</option>
                        <option <?php echo set_select('jenjang', 'Tsanawiyah', $select_jenjang = ($jenjang == 'Tsanawiyah') ? TRUE : FALSE) ?> value="Tsanawiyah">Tsanawiyah</option>
                        <option <?php echo set_select('jenjang', 'Aliyah', $select_jenjang = ($jenjang == 'Aliyah') ? TRUE : FALSE) ?> value="Aliyah">Aliyah</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <hr>
                <button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">DAFTAR SEKARANG</button>
                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".chosen-select").select2({
            width: "100%",
            allowClear: true,
            theme: 'bootstrap',
        });
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            autoUpdateInput: false,
            "showDropdowns": true,
            "locale": {
                "format": "D MMMM YYYY",
                "separator": " - ",
                "applyLabel": "Apply",
                "cancelLabel": "Cancel",
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "Minggu",
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jum'at",
                    "Sabtu"
                ],
                "monthNames": [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ],
                "firstDay": 1,
                "maxYear": 2023,
                "drops": "up"
            },
            function(start, end, label) {
                var years = moment().diff(start, 'years');
                alert("You are " + years + " years old!");
            }
        });
        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $('#id_tanggal_lahir_form').val(picker.startDate.format('D MMMM YYYY'));
            $('#id_tanggal_lahir').val(picker.startDate.format('YYYY-MM-DD'));
        });

        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>