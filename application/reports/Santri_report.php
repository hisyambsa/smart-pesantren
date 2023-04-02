<?php

use \koolreport\pivot\processes\Pivot;
use \koolreport\processes\CalculatedColumn;
use \koolreport\processes\Group;
use \koolreport\processes\Filter;
use \koolreport\processes\ColumnMeta;
use \koolreport\pivot\processes\PivotExtract;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Custom;
use \koolreport\processes\NumberRange;

use \koolreport\processes\Join;

class Santri_report extends \koolreport\KoolReport
{
    use \koolreport\inputs\Bindable;
    use \koolreport\inputs\POSTBinding;
    use \koolreport\codeigniter\Friendship; // All you need to do is to claim this friendship

    use \koolreport\export\Exportable;
    use \koolreport\excel\ExcelExportable;
    use \koolreport\excel\BigSpreadsheetExportable;



    // protected function defaultParamValues()
    // {
    //     if (isset($_SESSION['tanggal_range_0']) and (isset($_SESSION['tanggal_range_1']))) {
    //         return array(
    //             "tanggal_lembur_digitalisasi_form_lembur" => array(
    //                 $_SESSION['tanggal_range_0'],
    //                 $_SESSION['tanggal_range_1']
    //             ),
    //         );
    //     } else {
    //         return array(
    //             "tanggal_lembur_digitalisasi_form_lembur" => array(date("Y-m-d", strtotime(1583020800)), date("Y-m-d", strtotime('now'))),
    //         );
    //     }
    // }
    // protected function bindParamsToInputs()
    // {
    //     return array(
    //         "tanggal_lembur_digitalisasi_form_lembur",
    //     );
    // }

    function setup()
    {
        $root = $this->src("default");

        $root
            ->query("select * from t_santri")
            ->saveTo($root);


        $root->pipeTree(
            function ($node) {
                $node->pipe($this->dataStore("query_all"));
            },
        );
    }
}
