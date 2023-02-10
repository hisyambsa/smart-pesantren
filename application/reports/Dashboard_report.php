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

class Dashboard_report extends \koolreport\KoolReport
{
    use \koolreport\inputs\Bindable;
    use \koolreport\inputs\POSTBinding;
    use \koolreport\codeigniter\Friendship; // All you need to do is to claim this friendship


    function setup()
    {
        $root_ppdb = $this->src("default");
        $root_ppdb
            ->query("select * from t_ppdb")
            ->saveTo($root_ppdb);
        $root_ppdb->pipe($this->dataStore("query_all_ppdb"));

        $root_ppdb->pipe(new Group(array(
            "by" => "status",
            "count" => "status_id",
        )))
            ->pipe($this->dataStore("query_all_group_by_count_status"));

        $root_ppdb->pipe(new Group(array(
            "by" => "jenjang",
            "count" => "jenjang_id",
        )))
            ->pipe($this->dataStore("query_all_group_by_count_jenjang"));

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
