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
<script>
    /**
     * A Javascript module to loadeding/refreshing options of a select2 list box using ajax based on selection of another select2 list box.
     * 
     * @url : https://gist.github.com/ajaxray/187e7c9a00666a7ffff52a8a69b8bf31
     * @auther : Anis Uddin Ahmad <anis.programmer@gmail.com>
     * 
     * Live demo - https://codepen.io/ajaxray/full/oBPbQe/
     * w: http://ajaxray.com | t: @ajaxray
     */
    var Select2Cascade = (function(window, $) {

        function Select2Cascade(parent, child, url, select2Options, placeholder = 'PILIH') {
            var afterActions = [];
            var options = select2Options || {};

            // Register functions to be called after cascading data loading done
            this.then = function(callback) {
                afterActions.push(callback);
                return this;
            };

            parent.select2(select2Options).on("change", function(e) {

                child.prop("disabled", true);
                var _this = this;

                $.getJSON(url.replace(':parentId:', $(this).val()), function(items) {
                    var newOptions = '<option value="">-- ' + placeholder + ' --</option>';
                    for (var id in items) {
                        newOptions += '<option value="' + id + '">' + items[id] + '</option>';
                    }

                    child.select2('destroy').html(newOptions).prop("disabled", false)
                        .select2(options);

                    afterActions.forEach(function(callback) {
                        callback(parent, child, items);
                    });
                });
            });
        }

        return Select2Cascade;

    })(window, $);
</script>
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
        <h4 class="h4-responsive text-center"><?= $bagian ?></h4>
        <div class="row align">
            <div class="col-md-6 order-md-2 py-md-5">
                <img src="<?= base_url('images/form_ppdb.png') ?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="py-3 col-md-6 order-md-1">
                <?= $form ?>
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


        var apiUrl = '<?= base_url('ajax_wilayah/getProvSelect2/') ?>';
        var select2Options = {
            width: 'resolve'
        };
        $('select').select2(select2Options);

        var apiUrl = '<?= base_url('ajax_wilayah/getKabSelect2/:parentId:') ?>';
        var cascadLoading = new Select2Cascade($('#id_provinsi'), $('#id_kota_kabupaten'), apiUrl, select2Options, 'PILIH KOTA/KABUPATEN');

        var apiUrl = '<?= base_url('ajax_wilayah/getDistrictsSelect2/:parentId:') ?>';
        var cascadLoading = new Select2Cascade($('#id_kota_kabupaten'), $('#id_kecamatan'), apiUrl, select2Options, 'PILIH KECAMATAN');

        var apiUrl = '<?= base_url('ajax_wilayah/getVillagesSelect2/:parentId:') ?>';
        var cascadLoading = new Select2Cascade($('#id_kecamatan'), $('#id_kelurahan'), apiUrl, select2Options, 'PILIH KELURAHAN/DESA');

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