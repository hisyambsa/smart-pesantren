<?php
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyam.ismul.com ......... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/
?>
<h2 class="h2-responsive"><?php echo 'Edit / Update' ?> </h2>
<?php $attributes = array('autocomplete' => 'off'); ?>
<?= form_open($action, $attributes) ?>
<div class="form-group md-form">
    <label for="varchar">Username Login <?php echo form_error('username') ?></label>
    <input length=100 minlength="8" required type="text" class="form-control" name="username" id="id_username" placeholder="Masukan Username" value="<?php echo $username; ?>" />
</div>

<div class="form-group md-form">
    <label for="varchar">Email untuk Apps <?php echo form_error('email') ?></label>
    <input required type="email" class="form-control" name="email" id="id_email" placeholder="Masukan Email" value="<?php echo $email; ?>" />
</div>
<div class="form-group md-form">
    <label for="varchar">Nama Apps <?php echo form_error('last_name') ?></label>
    <input length=20 type="text" class="form-control" name="last_name" id="id_last_name" placeholder="Masukan Last Name" value="<?php echo $last_name; ?>" />
</div>
<div class="input-group md-form mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text md-addon" id="material-addon1">62</span>
    </div>
    <label for="varchar">Nomor Hp Whatsapp <?php echo form_error('phone') ?></label>
    <input length=16 type="number" class="form-control" name="phone" id="id_phone" placeholder="Masukan Phone" value="<?php echo $phone; ?>" />
</div>
<div class="form-group md-form">
    <label for="date">Tanggal Lahir untuk Verifikasi <?php echo form_error('tanggal_lahir') ?></label>
    <input <?= $tanggal_lahir = ($tanggal_lahir) ? 'data-value=' . $tanggal_lahir : '' ?> type="text" class="form-control datepicker_tanggal_lahir" name="tanggal_lahir" id="id_tanggal_lahir" placeholder="Masukan Tanggal Lahir" />
</div>
<div class="form-group md-form">
    <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
    <input type="text" class="form-control" name="alamat" id="id_alamat" placeholder="Masukan Alamat" value="<?php echo $alamat; ?>" />
</div>
<button type="submit" class="btn btn-primary btn-rounded"><?php echo $button ?></button>
<a href="<?php echo site_url('auth/read_user') ?>" class="btn btn-danger btn-rounded">Batal</a>
</form>

<script>
    $(document).ready(function() {
        $('.datepicker_tanggal_lahir').pickadate({
            selectMonths: 12,
            selectYears: 100,
            formatSubmit: 'yyyy-mm-dd',
            // Buttons
            today: 'TODAY',
            clear: '',
            close: '',
            max: true,
        });
    });
</script>