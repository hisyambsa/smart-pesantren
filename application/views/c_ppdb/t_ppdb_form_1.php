<style>
    /*Select2 ReadOnly Start*/
    select[readonly].select2-hidden-accessible+.select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__arrow,
    select[readonly].select2-hidden-accessible+.select2-container .select2-selection__clear {
        display: none;
    }

    /*Select2 ReadOnly End*/
</style>
<?= form_open($action, $attributes, $hidden) ?>
<div class="form-group md-form">
    <input length="16" maxlength="16" type="text" class="form-control" name="nik_santri" id="id_nik_santri" placeholder="Masukan NIK Calon Santri/wati" value="<?php echo $nik_santri; ?>" />
    <label for="varchar">NIK Calon Santri/wati <?php echo form_error('nik_santri') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="nama_santri" id="id_nama_santri" placeholder="Masukan Nama Calon Santri/wati" value="<?php echo $nama_santri; ?>" />
    <label for="varchar">Nama Calon Santri/wati <?php echo form_error('nama_santri') ?></label>
</div>
<div class="form-group md-form">
    <input type="text" class="form-control" name="tempat_lahir" id="id_tempat_lahir" placeholder="Masukan Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
    <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
</div>
<div class="border border-primary p-3">
    <div class="switch">
        <p>Sesuai KTP</p>
        <label>
            TIDAK
            <input <?php echo set_radio('sesuai_ktp', 'on', $radio_sesuai_ktp = ($sesuai_ktp == 'on') ? TRUE : FALSE); ?> id="switch_click" type="checkbox" name="sesuai_ktp">
            <span class="lever"></span> YA
        </label>
    </div>
    <div class="form-group md-form">
        <input type="text" class="form-control datepicker selectNikdisabled" id="id_tanggal_lahir_form" placeholder="Masukan Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
        <input type="hidden" class="form-control" name="tanggal_lahir" id="id_tanggal_lahir" placeholder="Masukan Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" />
        <label for="date">Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></label>
    </div>
    <div class="form-group">
        <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
        <select data-placeholder="Pilih Jenis Kelamin" name="jenis_kelamin" id="id_jenis_kelamin" class="form-control chosen-select selectNikReadonly">
            <option value="">Pilih Jenis Kelamin</option>
            <option <?php echo set_select('jenis_kelamin', 'Laki-Laki', $select_jenis_kelamin = ($jenis_kelamin == 'Laki-Laki') ? TRUE : FALSE) ?> value="Laki-Laki">Laki-Laki</option>
            <option <?php echo set_select('jenis_kelamin', 'Perempuan', $select_jenis_kelamin = ($jenis_kelamin == 'Perempuan') ? TRUE : FALSE) ?> value="Perempuan">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="id_provinsi" class="control-label">Provinsi <?php echo form_error('province_id') ?></label>
        <div class="">
            <select data-placeholder="-- PILIH PROVINSI--" name="province_id" id="id_provinsi" class="form-control selectNikReadonly">
                <option value="">-- PILIH PROVINSI--</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="id_kota_kabupaten" class="control-label">Kota/Kabupaten <?php echo form_error('regency_id') ?></label>
        <div class="">
            <select data-placeholder="-- PILIH KOTA/KABUPATEN--" name="regency_id" id="id_kota_kabupaten" class="form-control selectNikReadonly">
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="id_kecamatan" class="control-label">Kecamatan <?php echo form_error('district_id') ?></label>
        <div class="">
            <select data-placeholder="-- PILIH KECAMATAN --" name="district_id" id="id_kecamatan" class="form-control selectNikReadonly">
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="id_kelurahan" class="control-label">Kelurahan <?php echo form_error('village_id') ?></label>
    <div class="">
        <select data-placeholder="-- PILIH KELURAHAN/DESA --" name="village_id" id="id_kelurahan" class="form-control">
        </select>
    </div>
</div>
<div class="form-group">
    <label for="alamat">Alamat Lengkap <?php echo form_error('alamat') ?></label>
    <textarea style="background-color:transparent;" class="form-control" rows="3" name="alamat" id="alamat" placeholder=""><?php echo $alamat; ?></textarea>
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
    <label for="varchar">No Handphone / WA <?php echo form_error('no_hp') ?></label>
    <input type="telp" class="form-control" name="no_hp" id="id_no_hp" placeholder="Masukan No Handphone / WA" value="<?php echo $no_hp; ?>" />
</div>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<hr>
<button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">DAFTAR SEKARANG</button>
<?= form_close() ?>

<script>
    $(document).ready(function() {
        var select2Options = {
            width: 'resolve'
        };
        $('select').select2(select2Options);

        $.ajax({
            type: "get",
            url: "<?= base_url('ajax_wilayah/getProvinceSelect2/') ?>",
            data: {
                id: 1,
            },
            dataType: "json",
            success: function(response) {
                var data = response;
                response.forEach(element => {
                    var newOption = new Option(element.text, element.id, false, false);
                    $('#id_provinsi').append(newOption);
                });
            }
        });
        <?php if ($_POST) : ?>
            $.ajax({
                type: "get",
                url: "<?= base_url('ajax_wilayah/getProvinceSelect2/') ?>",
                data: {
                    id: 1,
                },
                dataType: "json",
                success: function(response) {
                    var data = response;
                    response.forEach(element => {
                        var newOption = new Option(element.text, element.id, false, false);
                        $('#id_provinsi').append(newOption);
                    });
                }
            });
            setTimeout(() => {
                var dataNik = $('#id_nik_santri').val();

                let provinsiNik = dataNik.substr(0, 2);
                let kotaKabNik = dataNik.substr(0, 4);
                let kecNik = dataNik.substr(0, 6);
                let jenisKelamin = dataNik.substr(6, 2);

                let tanggalLahir = dataNik.substr(6, 2);
                let bulanLahir = dataNik.substr(8, 2);
                let tahunLahir = dataNik.substr(10, 2);

                var apiUrl = '<?= base_url('ajax_wilayah/getKabSelect2/:parentId:') ?>';
                var cascadLoading = new Select2Cascade($('#id_provinsi'), $('#id_kota_kabupaten'), apiUrl, select2Options, 'PILIH KOTA/KABUPATEN');

                var apiUrl = '<?= base_url('ajax_wilayah/getDistrictsSelect2/:parentId:') ?>';
                var cascadLoading = new Select2Cascade($('#id_kota_kabupaten'), $('#id_kecamatan'), apiUrl, select2Options, 'PILIH KECAMATAN');

                var apiUrl = '<?= base_url('ajax_wilayah/getVillagesSelect2/:parentId:') ?>';
                var cascadLoading = new Select2Cascade($('#id_kecamatan'), $('#id_kelurahan'), apiUrl, select2Options, 'PILIH KELURAHAN/DESA');

                $('#id_tanggal_lahir_form').val(moment('<?= $tanggal_lahir ?>').format('D MMMM YYYY'));


                <?php if ($this->input->post('sesuai_ktp') == 'on') { ?>
                    $('.selectNikReadonly').attr('readonly', true);
                    $('.selectNikdisabled').attr('disabled', true);
                <?php } ?>

                $("#id_provinsi").val(provinsiNik).trigger('change');
                setTimeout(() => {
                    $("#id_kota_kabupaten").val(kotaKabNik).trigger('change');
                    callback_kecamatan(kecNik);
                }, 1000);
            }, 1000);
        <?php else : ?>
            var apiUrl = '<?= base_url('ajax_wilayah/getKabSelect2/:parentId:') ?>';
            var cascadLoading = new Select2Cascade($('#id_provinsi'), $('#id_kota_kabupaten'), apiUrl, select2Options, 'PILIH KOTA/KABUPATEN');

            var apiUrl = '<?= base_url('ajax_wilayah/getDistrictsSelect2/:parentId:') ?>';
            var cascadLoading = new Select2Cascade($('#id_kota_kabupaten'), $('#id_kecamatan'), apiUrl, select2Options, 'PILIH KECAMATAN');

            var apiUrl = '<?= base_url('ajax_wilayah/getVillagesSelect2/:parentId:') ?>';
            var cascadLoading = new Select2Cascade($('#id_kecamatan'), $('#id_kelurahan'), apiUrl, select2Options, 'PILIH KELURAHAN/DESA');
        <?php endif; ?>



        $('#switch_click').click(function(e) {
            $('.lever').block({
                message: null,
                onBlock: function() {
                    if ($('#switch_click').is(':checked')) {
                        $('.selectNikReadonly').attr('readonly', true);
                        $('.selectNikdisabled').attr('disabled', true);
                    } else {
                        $('.selectNikReadonly').attr('readonly', false);
                        $('.selectNikdisabled').attr('disabled', false);

                        var select2Options = {
                            width: 'resolve'
                        };

                        $.ajax({
                            type: "get",
                            url: "<?= base_url('ajax_wilayah/getProvinceSelect2/') ?>",
                            data: {
                                id: 1,
                            },
                            dataType: "json",
                            success: function(response) {
                                var data = response;
                                response.forEach(element => {
                                    var newOption = new Option(element.text, element.id, false, false);
                                    $('#id_provinsi').append(newOption);

                                    var apiUrl = '<?= base_url('ajax_wilayah/getKabSelect2/:parentId:') ?>';
                                    var cascadLoading = new Select2Cascade($('#id_provinsi'), $('#id_kota_kabupaten'), apiUrl, select2Options, 'PILIH KOTA/KABUPATEN');

                                    var apiUrl = '<?= base_url('ajax_wilayah/getDistrictsSelect2/:parentId:') ?>';
                                    var cascadLoading = new Select2Cascade($('#id_kota_kabupaten'), $('#id_kecamatan'), apiUrl, select2Options, 'PILIH KECAMATAN');

                                    var apiUrl = '<?= base_url('ajax_wilayah/getVillagesSelect2/:parentId:') ?>';
                                    var cascadLoading = new Select2Cascade($('#id_kecamatan'), $('#id_kelurahan'), apiUrl, select2Options, 'PILIH KELURAHAN/DESA');

                                });
                            }
                        });
                    }
                    $('.lever').unblock();
                }
            });
        });

        $('#id_nik_santri').change(function(e) {
            $('#switch_click').attr('checked', true);
            $('.selectNikReadonly').attr('readonly', true);
            $('.selectNikdisabled').attr('disabled', true);


            var dataNik = $(this).val();

            let provinsiNik = dataNik.substr(0, 2);
            let kotaKabNik = dataNik.substr(0, 4);
            let kecNik = dataNik.substr(0, 6);
            let jenisKelamin = dataNik.substr(6, 2);

            let tanggalLahir = dataNik.substr(6, 2);
            let bulanLahir = dataNik.substr(8, 2);
            let tahunLahir = dataNik.substr(10, 2);

            if (jenisKelamin < 40) {
                $('#id_jenis_kelamin').val('Laki-Laki').trigger('change');
            } else {
                $('#id_jenis_kelamin').val('Perempuan').trigger('change');
            }

            $.ajax({
                type: "get",
                url: "<?= base_url('ajax_wilayah/getIdProvinceSelect2/') ?>",
                data: {
                    id: provinsiNik,
                },
                dataType: "json",
                success: function(response) {
                    var data = response;
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#id_provinsi').append(newOption).trigger('change');
                }
            });
            $.ajax({
                type: "get",
                url: "<?= base_url('ajax_wilayah/getIdRegencySelect2/') ?>",
                data: {
                    id: kotaKabNik,
                },
                dataType: "json",
                success: function(response) {
                    var data = response;
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#id_kota_kabupaten').append(newOption).trigger('change');
                }
            });
            $.ajax({
                type: "get",
                url: "<?= base_url('ajax_wilayah/getIdDistrictSelect2/') ?>",
                data: {
                    id: kecNik,
                },
                dataType: "json",
                success: function(response) {
                    var data = response;
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#id_kecamatan').append(newOption).trigger('change');
                }
            });

            var apiUrl = '<?= base_url('ajax_wilayah/getKabSelect2/:parentId:') ?>';
            var cascadLoading = new Select2Cascade($('#id_provinsi'), $('#id_kota_kabupaten'), apiUrl, select2Options, 'PILIH KOTA/KABUPATEN');

            var apiUrl = '<?= base_url('ajax_wilayah/getDistrictsSelect2/:parentId:') ?>';
            var cascadLoading = new Select2Cascade($('#id_kota_kabupaten'), $('#id_kecamatan'), apiUrl, select2Options, 'PILIH KECAMATAN');

            var apiUrl = '<?= base_url('ajax_wilayah/getVillagesSelect2/:parentId:') ?>';
            var cascadLoading = new Select2Cascade($('#id_kecamatan'), $('#id_kelurahan'), apiUrl, select2Options, 'PILIH KELURAHAN/DESA');

            $("#id_provinsi").val(provinsiNik).trigger('change');
            setTimeout(() => {
                $("#id_kota_kabupaten").val(kotaKabNik).trigger('change');
                callback_kecamatan(kecNik);
            }, 1000);



            if (tanggalLahir < 40) {
                tanggalLahir = tanggalLahir;
            } else {
                tanggalLahir = tanggalLahir - 40;
            }
            if (tahunLahir < 50) {
                tahunLahir = 20 + tahunLahir;
            } else {
                tahunLahir = 19 + tahunLahir;
            }
            var date1 = new Date(tahunLahir, bulanLahir - 1, tanggalLahir);

            $('#id_tanggal_lahir_form').val(moment(date1).format('D MMMM YYYY'));
            $('#id_tanggal_lahir_form').data('daterangepicker').setStartDate(moment(date1).format('D MMMM YYYY'));
            $('#id_tanggal_lahir_form').data('daterangepicker').setEndDate(moment(date1).format('D MMMM YYYY'));
            $("#id_tanggal_lahir_form").data().daterangepicker.updateCalendars();

            $('#id_tanggal_lahir').val(moment(date1).format('YYYY-MM-DD'));

        });


        function callback_kecamatan(kecNik) {
            setTimeout(() => {
                $("#id_kecamatan").val(kecNik).trigger('change');
            }, 1000);
        }
    });
</script>