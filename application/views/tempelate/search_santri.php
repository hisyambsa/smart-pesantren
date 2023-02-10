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
                <option <?php echo set_select('jenjang', "I'dadiyah", $select_jenjang = ($jenjang == "I'dadiyah") ? TRUE : FALSE) ?> value="I'dadiyah">I'dadiyah</option>
                <option <?php echo set_select('jenjang', 'Ibtidaiyah', $select_jenjang = ($jenjang == 'Ibtidaiyah') ? TRUE : FALSE) ?> value="Ibtidaiyah">Ibtidaiyah</option>
                <option <?php echo set_select('jenjang', 'Tsanawiyah', $select_jenjang = ($jenjang == 'Tsanawiyah') ? TRUE : FALSE) ?> value="Tsanawiyah">Tsanawiyah</option>
                <option <?php echo set_select('jenjang', 'Aliyah', $select_jenjang = ($jenjang == 'Aliyah') ? TRUE : FALSE) ?> value="Aliyah">Aliyah</option>
            </select>
        </div>

        <div class="col-lg">
            <button type="submit" class="form-control green white-text"><?= $button ?></button>
            <?php if (isset($_GET['search'])) : ?>
                <a href="<?= $_SERVER['PHP_SELF'] ?>"> <button type="button" class="form-control red white-text">RESET</button></a>
            <?php endif ?>
        </div>
    </div>
    <?= form_close() ?>
</div>