<div class="border d-flex align-items-center" style="height: 80vh;">
    <div class="container">
        <div class="border d-flex align-items-center justify-content-center">
            <?= form_open($action, $attributes, $hidden) ?>
            <div class="form-group">
                <label for="varchar">Detail kelulusan <?php echo form_error('detail_lulus') ?></label>
                <select data-placeholder="Pilih Jenis Kelamin" name="detail_lulus" id="id_detail_lulus" class="form-control chosen-select selectNikReadonly">
                    <option value="">Pilih</option>
                    <option <?php echo set_select('detail_lulus', 'Mandiri', $select_detail_lulus = ($detail_lulus == 'Mandiri') ? TRUE : FALSE) ?> value="Mandiri">Mandiri</option>
                    <option <?php echo set_select('detail_lulus', 'Beasiswa Alawiyin', $select_detail_lulus = ($detail_lulus == 'Beasiswa Alawiyin') ? TRUE : FALSE) ?> value="Beasiswa Alawiyin">Beasiswa Alawiyin</option>
                    <option <?php echo set_select('detail_lulus', 'Beasiswa Tidak Mampu', $select_detail_lulus = ($detail_lulus == 'Beasiswa Tidak Mampu') ? TRUE : FALSE) ?> value="Beasiswa Tidak Mampu">Beasiswa Tidak Mampu</option>
                    <option <?php echo set_select('detail_lulus', 'Beasiswa Nilai', $select_detail_lulus = ($detail_lulus == 'Beasiswa Nilai') ? TRUE : FALSE) ?> value="Beasiswa Nilai">Beasiswa Nilai</option>
                </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-secondary btn-block btn-rounded mt-3">SUBMIT</button>
            <?= form_close() ?>
        </div>
    </div>
</div>