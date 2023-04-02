<?php

use \koolreport\datagrid\DataTables;
use \koolreport\widgets\koolphp\Card;
use \koolreport\widgets\google\ColumnChart;
// use \koolreport\widgets\google\PieChart;
use \koolreport\d3\PieChart;
// use \koolreport\chartjs\PieChart;

// use \koolreport\widgets\google\BarChart;

use \koolreport\chartjs\BarChart;
use \koolreport\amazing\GaugeCard;
use \koolreport\pivot\widgets\PivotTable;
// use \koolreport\pivot\processes\Pivot;
use \koolreport\processes\Group;
use \koolreport\processes\Filter;

use \koolreport\widgets\koolphp\Table;


use \koolreport\processes\ColumnMeta;
use \koolreport\processes\Limit;
use \koolreport\processes\RemoveColumn;
use \koolreport\processes\OnlyColumn;
use \koolreport\processes\Sort;
use \koolreport\cube\processes\Cube;
use \koolreport\inputs\DateRangePicker;


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" integrity="sha512-DHNepbIus9t4e6YoMBSJLwl+nnm0tIwMBonsQQ+W9NKN6gVVVbomJs9Ii3mQ+HzGZiU5FyJLdnAz9a63ZgZvTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<h5 class="h5-responsive text-center">Report Lembur - <span class="font-weight-bold"><?= $this->params["jenis_report"] ?></span></h5>

<?php $attributes = array('autocomplete' => 'off'); ?>
<?= form_open($this->params['action'], $attributes) ?>
<div class="form-inline justify-content-center">
    <strong>Choose Start Date and End Date</strong>
    <div class="col-md-4 form-group  ">
        <?php
        DateRangePicker::create(array(
            "name" => "tanggal_lembur_digitalisasi_form_lembur",
            "minDate" => "2020/03/30", // inisiasi aplikasi
            "maxDate" => date('m/d/Y', strtotime('now')),
            "format" => "D MMM YYYY",
        ));
        ?>
    </div>
    <div class="form-group ">
        <button class="btn btn-primary " id="submit">Submit</button>
    </div>
</div>
<?= form_close() ?>
<?php if ($this->params['engine'] == 'Admin') : ?>
    <div class="col-md-6">
        <!--Accordion wrapper-->
        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header" role="tab" id="headingOne2">
                    <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                        <h5 class="mb-0">
                            View List Divisi <i class="fas fa-angle-up rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <!-- Card body -->
                <div id="collapseOne2" class="collapse" role="tabpanel" aria-labelledby="headingOne2" data-parent="#accordionEx">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($this->params["query_unit_kerja"] as $key) { ?>
                                <li class="list-group-item"><a href="<?= base_url('lembur/report_divisi/' . base64_encode($key->unit_kerja_digitalisasi_form_lembur)) ?>"><?= $key->unit_kerja_digitalisasi_form_lembur ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Accordion card -->
        </div>
    </div>
<?php endif ?>

<?php if ($this->dataStore("query_all")->count() > 0) { ?>
    <h5 class="h5-responsive text-center font-weight-bold py-3">Status Lembur </h5>
    <div class="row">
        <div class="col-6 col-sm-3 col-md-3">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all")->count(),
                "title" => "Total",
                "cssClass" => array(
                    "card" => "bg-default",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
        <div class="col-6 col-sm-3 col-md-3">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all")->where("status_digitalisasi_form_lembur", 'selesai')->count(),
                "title" => "Selesai",
                "cssClass" => array(
                    "card" => "bg-success",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
        <div class="col-6 col-sm-3 col-md-3">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all")->where("status_digitalisasi_form_lembur", 'proses')->count(),
                "title" => "Proses",
                "cssClass" => array(
                    "card" => "bg-warning",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
        <div class="col-6 col-sm-3 col-md-3">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all")->where("status_digitalisasi_form_lembur", 'batal')->count(),
                "title" => "Batal",
                "cssClass" => array(
                    "card" => "bg-danger",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    </div>
    <?php if ($this->params['engine'] == 'Admin') : ?>
        <!-- Accordion wrapper -->
        <h5 class="h5-responsive text-center font-weight-bold py-3">All Lembur Divisi</h5>
        <div class="row py-2">
            <div class="col-md-6">
                <?php
                BarChart::create(array(
                    "title" => "Divisi",
                    "dataSource" => $this->dataStore("query_all_by_unit_kerja_digitalisasi_form_lembur")->toArray(),
                    "columns" => array(
                        "unit_kerja_digitalisasi_form_lembur",
                        "id" => array("label" => "Jumlah", "type" => "number"),
                    ),
                    "options" => array(
                        "scales" => array(
                            "xAxes" => array(
                                array(
                                    "ticks" => array(
                                        "suggestedMin" => 0,
                                        "stepSize" => 1,
                                    )
                                )
                            )
                        )
                    )
                ));
                ?>
            </div>
            <div class="col-md-6">
                <?php
                PieChart::create(array(
                    "title" => "Divisi",
                    "dataSource" => $this->dataStore("query_all_by_unit_kerja_digitalisasi_form_lembur")->toArray(),
                    "columns" => array(
                        "unit_kerja_digitalisasi_form_lembur",
                        "id" => array("label" => "Jumlah", "type" => "number"),
                    ),
                ));
                ?>
            </div>

            <div class="col-md-6">

            </div>


            <div class="col-md-6">
            </div>

        </div>
        <hr>
    <?php endif ?>
    <?php if ($this->dataStore("total_jam_lembur")->filter('unit_kerja_digitalisasi_form_lembur', '!=', 'Divisi Operasi dan Pemeliharaan Jaringan')->count() > 0) { ?>
        <h5 class="h5-responsive text-center pt-3">Lembur Divisi</h5>
        <?php
        DataTables::create(array(
            "dataSource" => $this->dataStore('total_jam_lembur')->filter('unit_kerja_digitalisasi_form_lembur', '!=', 'Divisi Operasi dan Pemeliharaan Jaringan'),
            "fastRender" => true,
            "options" => array(
                "searching" => true,
                "paging" => true,
                "pageLength" => 10,
                "columnDefs" => array(
                    array(
                        "targets" => array(1),
                        "searchable" => false,
                    ),
                    array(
                        "targets" => array(2),
                        "orderable" => false,
                        "searchable" => false,
                    ),
                )
            ),
            "columns" => array(
                "nama_digitalisasi_form_lembur" => array(
                    "label" => "Nama",
                    'formatValue' => function ($value, $row, $cKey) {
                        return $value;
                    }
                ),
                "total_menit" => array(
                    "label" => "Total Menit",
                    'formatValue' => function ($value, $row, $cKey) {
                        return $row['total_jam_digitalisasi_form_lembur'];
                    }
                ),
                "total_jam_digitalisasi_form_lembur" => array(
                    "label" => "Total Jam",
                    'formatValue' => function ($value, $row, $cKey) {
                        $element = $value;

                        $h = intval($element / 3600);

                        $element = $element - ($h * 3600);

                        // Minutes is obtained by dividing
                        // remaining total time with 60
                        $m = intval($element / 60);

                        // Remaining value is seconds
                        $s = $element - ($m * 60);

                        $row = "$h Jam $m Menit";
                        // $row["tanggal_pengajuan_digitalisasi_form_lembur"] = "$h:$m:$s";
                        return $row;
                    }
                ),
            ),
        ));
        ?>
    <?php } ?>
    <hr>
    <?php if ($this->dataStore("total_jam_lembur")->filter('unit_kerja_digitalisasi_form_lembur', '=', 'Divisi Operasi dan Pemeliharaan Jaringan')->count() > 0) { ?>
        <h5 class="h5-responsive text-center">Lembur OPJ</h5>
        <?php
        DataTables::create(array(
            "dataSource" => $this->dataStore('total_jam_lembur')->filter('unit_kerja_digitalisasi_form_lembur', '=', 'Divisi Operasi dan Pemeliharaan Jaringan'),
            "fastRender" => true,
            "options" => array(
                "searching" => true,
                "paging" => true,
                "pageLength" => 10,
                "columnDefs" => array(
                    array(
                        "targets" => array(1),
                        "searchable" => false,
                    ),
                    array(
                        "targets" => array(2),
                        "orderable" => false,
                        "searchable" => false,
                    ),
                )
            ),
            "columns" => array(
                "nama_digitalisasi_form_lembur" => array(
                    "label" => "Nama",
                    'formatValue' => function ($value, $row, $cKey) {
                        return $value;
                    }
                ),
                "total_menit" => array(
                    "label" => "Total Menit",
                    'formatValue' => function ($value, $row, $cKey) {
                        return $row['total_jam_digitalisasi_form_lembur'];
                    }
                ),
                "total_jam_digitalisasi_form_lembur" => array(
                    "label" => "Total Jam",
                    'formatValue' => function ($value, $row, $cKey) {
                        $element = $value;

                        $h = intval($element / 3600);

                        $element = $element - ($h * 3600);

                        // Minutes is obtained by dividing
                        // remaining total time with 60
                        $m = intval($element / 60);

                        // Remaining value is seconds
                        $s = $element - ($m * 60);

                        $row = "$h Jam $m Menit";
                        // $row["tanggal_pengajuan_digitalisasi_form_lembur"] = "$h:$m:$s";
                        return $row;
                    }
                ),
            ),
        ));
        ?>
        <hr>
    <?php } ?>
    <?php
    PivotTable::create(array(
        "dataStore" => $this->dataStore("pivot_lembur"),
        'rowCollapseLevels' => array(0),
        'columnCollapseLevels' => array(0),
        'map' => array(
            'dataField' => function ($dataField, $fieldInfo) {
                $v = $dataField;
                return 'PIVOT LEMBUR';
            },
        ),
    ));
    ?>
    <?php if ($this->params['engine'] == 'Divisi' or $this->params['engine'] == 'Admin') : ?>
        <a class="btn btn-sm btn-success" href="<?= base_url('lembur/' . $this->params['jenis_report_excel'] . '?type=excel&name=' . base64_encode($this->params['jenis_report'])) ?>" target="_blank" rel="noopener noreferrer">DOWNLOAD EXCEL</a>
    <?php endif ?>
    <?php
    PivotTable::create(array(
        "dataStore" => $this->dataStore("pivot_biaya_lembur"),
        'rowCollapseLevels' => array(0),
        'columnCollapseLevels' => array(0),
        'hideSubTotalRows' => true,
        'hideSubTotalColumns' => true,
        'map' => array(
            'dataField' => function ($dataField, $fieldInfo) {
                $v = $dataField;
                return 'PIVOT BIAYA LEMBUR';
            },
        ),
    ));
    ?>

    <?php if ($this->params['engine'] == 'View') : ?>

    <?php endif ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hisyambsa/assets_cdn@v.2.4/user/dataTable.min.css">
    <style>
        .koolphp-card {
            padding-bottom: 0;
        }
    </style>
    <script>
        $(function() {
            $('.min-chart').easyPieChart({
                barColor: "#4caf50",
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        });
    </script>
<?php } else { ?>
    <h4 class="text-center text-danger font-weight-bold h4-responsive my-4 ">DATA KOSONG</h4>
<?php } ?>