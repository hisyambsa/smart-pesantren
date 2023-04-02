<?php

use \koolreport\datagrid\DataTables;
use \koolreport\widgets\koolphp\Card;
// use \koolreport\widgets\google\ColumnChart;
// use \koolreport\widgets\google\PieChart;
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

use \koolreport\chartjs\PieChart;
use \koolreport\chartjs\ColumnChart;
?>
<?php
// var_dump($this->dataStore('query_all_group_by_count_status'));
// die;
?>
<div class="row py-3">
    <?php if ($this->dataStore("query_usia")) : ?>
        <div class="col-6 sm-6 md-6">
            <div class="card p-3 m-2">
                <?php
                ColumnChart::create(array(
                    "title" => "USIA",
                    "dataSource" => $this->dataStore('query_usia'),
                    "columns" => array(
                        "usia",
                        "usia_id" => array(
                            "label" => "PPDB berdasarkan Usia",
                            "type" => "number",
                        ),
                    ),
                    "options" => [
                        "scales" => [
                            "yAxes" => [[
                                "display" => true,
                                "ticks" => [
                                    "beginAtZero" => true,
                                    "stepSize" => 1,
                                ]
                            ]]
                        ],
                    ]

                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_usia")) : ?>
        <div class="col-6 sm-6 md-6">
            <div class="card p-3 m-2">
                <?php
                PieChart::create(array(
                    "title" => "Jenis Kelmain PPDB",
                    "dataSource" => $this->dataStore('query_jenis_kelamin'),
                    "columns" => array(
                        "jenis_kelamin",
                        "jenis_kelamin_id" => array(
                            "label" => "jumlah",
                            "type" => "number",
                        )
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>




    <?php if ($this->dataStore("query_all_group_by_count_status")) : ?>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="card p-3 m-2">
                <?php
                PieChart::create(array(
                    "title" => "Status PPDB",
                    "dataSource" => $this->dataStore('query_all_group_by_count_status'),
                    "columns" => array(
                        "status",
                        "status_id" => array(
                            "label" => "jumlah",
                            "type" => "number",
                        )
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_group_by_count_status")) : ?>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="card p-3 m-2">
                <?php
                PieChart::create(array(
                    "title" => "Jenjang",
                    "dataSource" => $this->dataStore('query_all_group_by_count_jenjang'),
                    "columns" => array(
                        "jenjang",
                        "jenjang_id" => array(
                            "label" => "jumlah",
                            "type" => "number",
                        )
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_group_by_count_status_jenis_kelamin")) : ?>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="card p-3 m-2">
                <?php
                ColumnChart::create(array(
                    "title" => "status PPDB",
                    "dataSource" => $this->dataStore('query_all_group_by_count_status_jenis_kelamin'),
                    "columns" => array(
                        "status",
                        "status_id" => array(
                            "label" => "Laki-Laki",
                            "type" => "number",
                        ),
                        "jenis_kelamin" => array(
                            "label" => "Perempuan",
                            "type" => "number",
                        ),
                    ),
                    "options" => [
                        "scales" => [
                            "yAxes" => [[
                                "display" => true,
                                "ticks" => [
                                    "beginAtZero" => true,
                                ]
                            ]]
                        ],
                    ]

                ));
                ?>
            </div>
        </div>
    <?php endif ?>


    <?php if ($this->dataStore("query_all_group_by_count_jenjang_jenis_kelamin")) : ?>
        <div class="col-12 col-sm-6 col-md-6">
            <div class="card p-3 m-2">
                <?php
                ColumnChart::create(array(
                    "title" => "Jenjang PPDB",
                    "dataSource" => $this->dataStore('query_all_group_by_count_jenjang_jenis_kelamin'),
                    "columns" => array(
                        "jenjang",
                        "jenjang_id" => array(
                            "label" => "Laki-Laki",
                            "type" => "number",
                        ),
                        "jenis_kelamin" => array(
                            "label" => "Perempuan",
                            "type" => "number",
                        ),
                    ),
                    "options" => [
                        "scales" => [
                            "yAxes" => [[
                                "display" => true,
                                "ticks" => [
                                    "beginAtZero" => true,
                                ]
                            ]]
                        ],
                    ]

                ));
                ?>
            </div>
        </div>
    <?php endif ?>


</div>
<div class="row py-3">
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Proses')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_ppdb")->where("status", 'Proses')->count(),
                    "title" => "Proses",
                    "cssClass" => array(
                        "card" => "grey",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Lulus')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_ppdb")->where("status", 'Lulus')->count(),
                    "title" => "Lulus",
                    "cssClass" => array(
                        "card" => "orange",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Diterima')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_ppdb")->where("status", 'Diterima')->count(),
                    "title" => "Diterima",
                    "cssClass" => array(
                        "card" => "blue",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Tidak Lulus')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
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
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Tidak Diterima')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_ppdb")->where("status", 'Tidak Diterima')->count(),
                    "title" => "Tidak Diterima",
                    "cssClass" => array(
                        "card" => "red",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Tidak Daftar Ulang')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_ppdb")->where("status", 'Tidak Daftar Ulang')->count(),
                    "title" => "Tidak Daftar Ulang",
                    "cssClass" => array(
                        "card" => "red",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_ppdb")->where("status", 'Daftar Ulang')) : ?>
        <div class="col-6 col-sm-4 col-md-4 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_ppdb")->where("status", 'Daftar Ulang')->count(),
                    "title" => "Daftar Ulang",
                    "cssClass" => array(
                        "card" => "green",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
</div>

<hr>

<div class="row">
    <?php if ($this->dataStore("query_all_santri")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_santri")->count(),
                    "title" => "Jumlah<br>Santri",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_pengajar")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_pengajar")->count(),
                    "title" => "Jumlah<br>Pengajar",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_pegawai")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_pegawai")->count(),
                    "title" => "Jumlah<br>Pegawai",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_kurikulum")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_kurikulum")->count(),
                    "title" => "Jumlah<br>Kurikulum",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
    <?php if ($this->dataStore("query_all_nilai")) : ?>
        <div class="offset-col-4 col-4 offset-sm-3 col-sm-3 offset-md-3 col-md-3 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_nilai")->count(),
                    "title" => "Jumlah<br>Nilai",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>

    <?php if ($this->dataStore("query_all_catatan_akademik")) : ?>
        <div class="col-4 col-sm-3 col-md-3 my-2">
            <div class="card p-3 m-2">
                <?php
                Card::create(array(
                    "value" => $this->dataStore("query_all_catatan_akademik")->count(),
                    "title" => "Jumlah<br>Catatan Akademik",
                    "cssClass" => array(
                        "card" => "teal",
                        "title" => "text-white",
                        "value" => "text-white"
                    )
                ));
                ?>
            </div>
        </div>
    <?php endif ?>
</div>