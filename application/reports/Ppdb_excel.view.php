<?php

use \koolreport\excel\Table;
use \koolreport\excel\PivotTable;
use \koolreport\excel\BarChart;
use \koolreport\excel\LineChart;

$sheet1 = "PPDB Report";
?>
<meta charset="UTF-8">
<meta name="description" content="Generate PPDB Report by Rabithah Alawiyah">
<meta name="keywords" content="Excel,HTML,CSS,XML,JavaScript">
<meta name="creator" content="@hisyambsa">
<meta name="subject" content="PPDB Report">
<meta name="title" content="PPDB Report">

<div sheet-name="<?php echo $sheet1; ?>">
    <div>
        <?php
        Table::create(array(
            "dataSource" => 'query_all',
            "columns" => array(
                // "id",
                "timestamp" => array(
                    "label" => "Timestamp"
                ),
                "no_pendaftaran" => array(
                    "label" => "No Pendaftaran"
                ),
                "nik_santri" => array(
                    "label" => "NIK",
                    "type" => "string"
                ),
                "nama_santri" => array(
                    "label" => "Nama"
                ),
                "sesuai_ktp" => array(
                    "label" => "Sesuai KTP"
                ),
                "tempat_lahir" => array(
                    "label" => "Tempat Lahir"
                ),
                "tanggal_lahir" => array(
                    "label" => "Tanggal Lahir"
                ),
                "jenis_kelamin" => array(
                    "label" => "Jenis Kelamin"
                ),
                "Provinsi" => array(
                    "label" => "province_name"
                ),
                "Kota/Kab" => array(
                    "label" => "regency_name"
                ),
                "Kecamatan" => array(
                    "label" => "district_name"
                ),
                "Kelurahan" => array(
                    "label" => "village_name"
                ),
                "Alamat" => array(
                    "label" => "alamat"
                ),
                "jenjang" => array(
                    "label" => "Jenjang"
                ),
                "email" => array(
                    "label" => "E-mail"
                ),
                "no_hp" => array(
                    "label" => "No. Hp"
                ),
                "nomor_kartu_keluarga" => array(
                    "label" => "No KK"
                ),
                "punya_buku_nasab" => array(
                    "label" => "Punya Buku Nasab"
                ),
                "nama_ayah" => array(
                    "label" => "Nama Ayah"
                ),
                "nama_ibu" => array(
                    "label" => "Nama Ibu"
                ),
                "upload_pas_foto" => array(
                    "label" => "File Foto"
                ),
                "upload_kartu_keluaga" => array(
                    "label" => "File KK"
                ),
                "upload_nasab" => array(
                    "label" => "File Nasab"
                ),
                "status" => array(
                    "label" => "Status"
                ),
                "detail_lulus" => array(
                    "label" => "Status Lulus"
                ),
            )
        ));
        ?>
    </div>

</div>