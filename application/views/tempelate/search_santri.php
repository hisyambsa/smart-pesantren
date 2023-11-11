<div class="my-2">
    <?= form_open($action, $attributes, $hidden) ?>
    <div class="form-row align-itemsdd-center">
        <div class="col-lg">
            <input type="text" name="nama_santri" class="form-control" placeholder="Nama Santri" value="<?= $nama_santri ?>">
        </div>
        <div class="col-lg">
            <input type="text" name="nis" class="form-control" placeholder="NIS" value="<?= $nis ?>">
        </div>
        <div class="col-lg">
            <select name="jenis_kelamin" class="browser-default custom-select">
                <option value="" selected>Jenis Kelamin</option>
                <option <?php echo set_select('jenis_kelamin', 'Laki-laki', $select_jenis_kelamin = ($jenis_kelamin == 'Laki-laki') ? TRUE : FALSE) ?> value="Laki-laki">Laki-laki</option>
                <option <?php echo set_select('jenis_kelamin', 'Perempuan', $select_jenis_kelamin = ($jenis_kelamin == 'Perempuan') ? TRUE : FALSE) ?> value="Perempuan">Perempuan</option>

            </select>
        </div>

        <div class="col-lg">
            <select name="jenjang" class="browser-default custom-select">
                <option value="" selected>Jenjang</option>
                <option <?php echo set_select('jenjang', "1", $select_jenjang = ($jenjang == "1") ? TRUE : FALSE) ?> value="1">I'dadiyah</option>
                <option <?php echo set_select('jenjang', '2', $select_jenjang = ($jenjang == '2') ? TRUE : FALSE) ?> value="2">Ibtidaiyah</option>
                <option <?php echo set_select('jenjang', '3', $select_jenjang = ($jenjang == '3') ? TRUE : FALSE) ?> value="3">Tsanawiyah</option>
                <option <?php echo set_select('jenjang', '4', $select_jenjang = ($jenjang == '4') ? TRUE : FALSE) ?> value="4">Aliyah</option>
            </select>
        </div>

        <div class="col-lg">
            <button type="submit" class="form-control blue white-text"><?= $button ?></button>
            <?php if (isset($_GET['search'])) : ?>
                <a href="<?= $_SERVER['PHP_SELF'] ?>"> <button type="button" class="form-control red white-text">RESET</button></a>
            <?php endif ?>
        </div>
    </div>
    <?= form_close() ?>
</div>