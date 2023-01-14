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

    // kodeproyek0-> no_surat tugas
    protected function defaultParamValues()
    {
        if (isset($this->params['tanggal_absensi'])) {
            return array(
                "tanggal_absensi" => $this->params['tanggal_absensi'],
            );
        } else {
            return array(
                "tanggal_absensi" => array(date("Y-m-d"), date("Y-m-d")),
            );
        }
    }
    protected function bindParamsToInputs()
    {
        return array(
            "tanggal_absensi",
        );
    }

    function setup()
    {
        $root_absensi = $this->src("default");
        $root_users = $this->src("default");



        if (isset($this->params['unit_kerja_absensi'])) {
            $root_absensi
                ->query("select * from absensi where tanggal_absensi >= '" . $this->params['tanggal_absensi'][0] . "' and tanggal_absensi <= '" . $this->params['tanggal_absensi'][1] . "' and delete_at_absensi is NULL and unit_kerja_absensi ='" . $this->params['unit_kerja_absensi'] . "'")


                ->saveTo($root_absensi);
        } elseif (isset($this->params['nama_absensi'])) {
            $root_absensi
                ->query("select * from absensi where tanggal_absensi >= '" . $this->params['tanggal_absensi'][0] . "' and tanggal_absensi <= '" . $this->params['tanggal_absensi'][1] . "' and delete_at_absensi is NULL and nama_absensi ='" . $this->params['nama_absensi'] . "'")

                ->saveTo($root_absensi);
        } else {
            $root_absensi
                ->query("select * from absensi where tanggal_absensi >= '" . $this->params['tanggal_absensi'][0] . "' and tanggal_absensi <= '" . $this->params['tanggal_absensi'][1] . "' and delete_at_absensi is NULL")

                ->saveTo($root_absensi);
        }

        $root_absensi->pipe($this->dataStore("query_all_absensi"));




        if (isset($this->params['unit_kerja_absensi'])) {
            $root_users
                ->query("select * from users where unit_kerja ='" . $this->params['unit_kerja_absensi'] . "'")


                ->saveTo($root_users);
        } elseif (isset($this->params['nama_absensi'])) {
            $root_users
                ->query("select * from users where first_name ='" . $this->params['nama_absensi'] . "'")

                ->saveTo($root_users);
        } else {
            $root_users
                ->query("select * from users")

                ->saveTo($root_users);
        }

        $root_users
            ->pipe(new DropNull(array(
                "targetColumns" => array("organ_perusahaan")
            )))
            ->pipe(new Filter(array(
                array("organ_perusahaan", "!=", "Dewan Direksi"),
                array("active", "=", 1)
            )))
            ->saveTo($root_users);

        $root_users->pipe($this->dataStore("query_all_users"));
    }
}
