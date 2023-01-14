<?php if (isset($css_files)) { ?>
    <?php foreach ($css_files as $file) : ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
<?php } ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" />

<style>
    .options-on-save {
        opacity: 0;
    }

    .white-skin .btn-default {
        background-color: white !important;
        color: black !important;
    }

    /* untuk multiple delete */
    [type="checkbox"]:not(:checked),
    [type="checkbox"]:checked {
        position: static;
        pointer-events: visible;
        opacity: 1;
    }

    .gc-select-row {
        position: absolute;
    }
</style>

<?php if ($link_tambah != FALSE) : ?>
    <div class="row mb-2">
        <div class="col-md-4 text-center">
            <?php
            if ($this->ion_auth->in_group($group) or $this->ion_auth->is_admin()) { ?>
                <?php echo anchor(site_url($link), $nama_link, 'class="btn btn-cyan btn-rounded btn-block"'); ?>
            <?php } ?>
        </div>
    </div>
<?php endif ?>
<div>
    <?php
    if (isset($output)) {
        echo $output;
    }
    ?>
</div>
<?php if (isset($js_files)) { ?>
    <?php foreach ($js_files as $file) : ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
<?Php } ?>