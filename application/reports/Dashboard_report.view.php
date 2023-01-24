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
<div class="row py-3">
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Proses')) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_ppdb")->where("status", 'Proses')->count(),
                "title" => "Proses",
                "cssClass" => array(
                    "card" => "purple",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Lulus')) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_ppdb")->where("status", 'Lulus')->count(),
                "title" => "Lulus",
                "cssClass" => array(
                    "card" => "blue",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Tidak Lulus')) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_ppdb")->where("status", 'Tidak Lulus')->count(),
                "title" => "Tidak Lulus",
                "cssClass" => array(
                    "card" => "red",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Diterima')) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_ppdb")->where("status", 'Diterima')->count(),
                "title" => "Diterima",
                "cssClass" => array(
                    "card" => "green",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Tidak Daftar Ulang')) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_ppdb")->where("status", 'Tidak Daftar Ulang')->count(),
                "title" => "Tidak Daftar Ulang",
                "cssClass" => array(
                    "card" => "orange",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
</div>

<hr>

<div class="row">
    <?php if ($this->dataStore("query_all_santri")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_santri")->count(),
                "title" => "Jumlah Santri",
                "cssClass" => array(
                    "card" => "teal",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_pengajar")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_pengajar")->count(),
                "title" => "Jumlah Pengajar",
                "cssClass" => array(
                    "card" => "teal",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_pegawai")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_pegawai")->count(),
                "title" => "Jumlah Pegawai",
                "cssClass" => array(
                    "card" => "teal",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_kurikulum")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_kurikulum")->count(),
                "title" => "Jumlah Kurikulum",
                "cssClass" => array(
                    "card" => "teal",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_nilai")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_nilai")->count(),
                "title" => "Jumlah Nilai",
                "cssClass" => array(
                    "card" => "teal",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_catatan_akademik")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <?php
            Card::create(array(
                "value" => $this->dataStore("query_all_catatan_akademik")->count(),
                "title" => "Jumlah Catatan Akademik",
                "cssClass" => array(
                    "card" => "teal",
                    "title" => "text-white",
                    "value" => "text-white"
                )
            ));
            ?>
        </div>
    <?php endif ?>
</div>