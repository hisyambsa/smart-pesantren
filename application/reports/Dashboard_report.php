<?php

use \koolreport\pivot\processes\Pivot;
use \koolreport\cleandata\DropNull;
use \koolreport\cleandata\FillNull;
use \koolreport\processes\CalculatedColumn;
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Join;
use \koolreport\processes\Filter;
use \koolreport\processes\ColumnMeta;
use \koolreport\pivot\processes\PivotExtract;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Custom;
use \koolreport\processes\NumberRange;
use \koolreport\processes\AggregatedColumn;

class Dashboard_report extends \koolreport\KoolReport
{
    use \koolreport\inputs\Bindable;
    use \koolreport\inputs\POSTBinding;
    use \koolreport\codeigniter\Friendship; // All you need to do is to claim this friendship
    use \koolreport\cache\FileCache;

    function cacheSettings()
    {
        return array(
            "ttl" => 60,
        );
    }
    protected function settings()
    {

        $whitelist = array(
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            // not valid
            return array(
                "assets" => array(
                    "path" => $_SERVER['DOCUMENT_ROOT'] . "/assets/koolreport_assets",
                    "url" => "/assets/koolreport_assets"
                )
            );
        } else {
            return array(
                "assets" => array(
                    "path" => $_SERVER['DOCUMENT_ROOT'] . "/smart-pesantren/assets/koolreport_assets",
                    "url" => "/smart-pesantren/assets/koolreport_assets"
                )
            );
        }
    }
    function setup()
    {
        $root_ppdb = $this->src("default");
        $root_ppdb
            ->query("select * from t_ppdb")
            ->saveTo($root_ppdb);
        $root_ppdb->pipe($this->dataStore("query_all_ppdb"));

        $root_ppdb
            ->pipe(new CalculatedColumn(array(
                "usia" => function ($row) {
                    $age = date_diff(date_create($row["tanggal_lahir"]), date_create('now'))->y;
                    return $age;
                }
            )))
            ->pipe(new NumberRange(array(
                "usia" => array(

                    "Usia < 11" => array(NULL, 10),
                    "Usia 11-14" => array(11, 20),
                    "Usia 15-18" => array(15, 18),
                    "Usia 19-21" => array(19, 21),
                    "Usia 21 < " => array(22, NULL),
                )
            )))
            ->pipe(new Group(array(
                "by" => "usia",
                "count" => "usia_id",
            )))
            ->pipe($this->dataStore("query_usia"));

        $root_ppdb->pipe(new Group(array(
            "by" => "jenis_kelamin",
            "count" => "jenis_kelamin_id",
        )))
            ->pipe($this->dataStore("query_jenis_kelamin"));

        $root_ppdb->pipe(new Group(array(
            "by" => "status",
            "count" => "status_id",
        )))
            ->pipe($this->dataStore("query_all_group_by_count_status"));

        $root_ppdb->pipe(new Group(array(
            "by" => array("status"),
            "count" => array("status_id"),
        )))
            ->pipe(new AggregatedColumn(array(
                "jenis_kelamin" => array("count", "status"),
            )))
            ->pipe($this->dataStore("query_all_group_by_count_status_jenis_kelamin"));

        $root_ppdb->pipe(new Group(array(
            "by" => "jenjang",
            "count" => "jenjang_id",
        )))
            ->pipe($this->dataStore("query_all_group_by_count_jenjang"));

        $root_ppdb->pipe(new Group(array(
            "by" => array("jenjang"),
            "count" => array("jenjang_id"),
        )))
            ->pipe(new AggregatedColumn(array(
                "jenis_kelamin" => array("count", "jenjang"),
            )))
            ->pipe($this->dataStore("query_all_group_by_count_jenjang_jenis_kelamin"));


        $root_santri = $this->src("default");
        $root_santri
            ->query("select * from t_santri")
            ->saveTo($root_santri);
        $root_santri->pipe($this->dataStore("query_all_santri"));

        $root_pengajar = $this->src("default");
        $root_pengajar
            ->query("select * from t_pengajar")
            ->saveTo($root_pengajar);
        $root_pengajar->pipe($this->dataStore("query_all_pengajar"));

        $root_pegawai = $this->src("default");
        $root_pegawai
            ->query("select * from t_pegawai")
            ->saveTo($root_pegawai);
        $root_pegawai->pipe($this->dataStore("query_all_pegawai"));

        $root_kurikulum = $this->src("default");
        $root_kurikulum
            ->query("select * from kurikulum")
            ->saveTo($root_kurikulum);
        $root_kurikulum->pipe($this->dataStore("query_all_kurikulum"));

        $root_nilai = $this->src("default");
        $root_nilai
            ->query("select * from nilai")
            ->saveTo($root_nilai);
        $root_nilai->pipe($this->dataStore("query_all_nilai"));

        $root_catatan_akademik = $this->src("default");
        $root_catatan_akademik
            ->query("select * from catatan_akademik")
            ->saveTo($root_catatan_akademik);
        $root_catatan_akademik->pipe($this->dataStore("query_all_catatan_akademik"));

        $root_asrama = $this->src("default");
        $root_asrama
            ->query("select * from asrama")
            ->saveTo($root_asrama);
        $root_asrama->pipe($this->dataStore("query_all_asrama"));
    }
}
