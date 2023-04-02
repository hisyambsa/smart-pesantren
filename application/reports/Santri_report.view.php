<?php

use \koolreport\excel\Table;
use \koolreport\excel\PivotTable;
use \koolreport\excel\BarChart;
use \koolreport\excel\LineChart;

$sheet1 = "Santri Report";
?>
<meta charset="UTF-8">
<meta name="description" content="Generate Santri Report by Rabithah Alawiyah">
<meta name="keywords" content="Excel,HTML,CSS,XML,JavaScript">
<meta name="creator" content="@hisyambsa">
<meta name="subject" content="Santri Report">
<meta name="title" content="Santri Report">

<div sheet-name="<?php echo $sheet1; ?>">
    <div>
        <?php
        Table::create(array(
            "dataSource" => 'query_all',
        ));
        ?>
    </div>

</div>