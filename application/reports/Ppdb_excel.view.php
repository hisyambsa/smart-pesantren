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
        ));
        ?>
    </div>

</div>