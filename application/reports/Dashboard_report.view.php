<?php

use \koolreport\datagrid\DataTables;
use \koolreport\widgets\koolphp\Card;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\PieChart;
// use \koolreport\widgets\google\BarChart;

use \koolreport\chartjs\BarChart;
use \koolreport\amazing\GaugeCard;
use \koolreport\pivot\widgets\PivotTable;
// use \koolreport\pivot\processes\Pivot;
use \koolreport\processes\Group;
use \koolreport\processes\Filter;


use \koolreport\processes\ColumnMeta;
use \koolreport\processes\Limit;
use \koolreport\processes\RemoveColumn;
use \koolreport\processes\OnlyColumn;
use \koolreport\processes\Sort;
use \koolreport\cube\processes\Cube;
use \koolreport\inputs\DateRangePicker;

?>
<?php
?>
<?php if ($this->dataStore("query_all_absensi")->count() > 0) { ?>
    <?php
    $join = $this->dataStore('query_all_users')->leftJoin($this->dataStore('query_all_absensi'), array(
        "first_name" => "nama_absensi"
    ))->sort(array(
        "first_name" => "asc",
    ));

    ?>
    <div class="row py-3">
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'WFH')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'WFH')->count(),
                    "title" => "WFH",
                    "cssClass" => array(
                        "card" => "bg-success",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'WFO')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'WFO')->count(),
                    "title" => "WFO",
                    "cssClass" => array(
                        "card" => "bg-primary",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Perjalanan Dinas')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Perjalanan Dinas')->count(),
                    "title" => "PD",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Lapangan')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Lapangan')->count(),
                    "title" => "Lapangan",
                    "cssClass" => array(
                        "card" => "bg-info",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Ijin Kerja')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Ijin Kerja')->count(),
                    "title" => "Izin",
                    "cssClass" => array(
                        "card" => "deep-purple",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Cuti')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Cuti')->count(),
                    "title" => "Cuti",
                    "cssClass" => array(
                        "card" => "indigo",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Hari Libur/Libur Shift')->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_absensi")->where("mode_kerja_absensi", 'Hari Libur/Libur Shift')->count(),
                    "title" => "Libur",
                    "cssClass" => array(
                        "card" => "bg-danger",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
        <?php if ($join->where("mode_kerja_absensi", null)->isNotEmpty()) : ?>
            <div class="col-4 col-sm-3 col-md-3">
                <?php
                Card::create(array(
                    "value" => $join->where("mode_kerja_absensi", null)->count(),
                    "title" => "Belum Scan",
                    "cssClass" => array(
                        "card" => "danger-color-dark",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        <?php endif ?>
    </div>


    <div class="row">
        <div class="col">
            <?php
            DataTables::create(array(
                "title" => "Last Absensi",
                "dataSource" => $join,
                // "serverSide"=>true,
                "method" => 'post', //default method = 'get'
                "options" => array(
                    "paging" => true,
                    "searching" => true
                ),
                // "searchOnEnter" => true,
                "searchMode" => "or",
                "fastRender" => true,
                "columns" => [
                    "first_name" => array(
                        "label" => "Nama",
                        // "type" => "date",
                        // "format" => "Y-m-d",
                        // "displayFormat" => "d M Y"
                    ),
                    "mode_kerja_absensi" => array(
                        "label" => "Mode Kerja",
                    ),
                    "created_at_absensi" => array(
                        "label" => "SCAN",
                        "type" => "datetime",
                        "format" => "Y-m-d H:i:s",
                        "displayFormat" => "H:i:s"
                    ),
                ],
            ));
            ?>
        </div>
    </div>
    <!-- Accordion wrapper -->


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hisyambsa/assets_cdn@v.2.4/user/dataTable.min.css">
    <style>
        .koolphp-card {
            padding-bottom: 0;
        }
    </style>
<?php } else { ?>
    <h4 class="text-center text-danger font-weight-bold h4-responsive my-4 ">BELUM ADA YANG SCAN</h4>
<?php } ?>