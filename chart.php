<?php
include 'header-data.php';
if(!isset($_SESSION['user']))
{
	echo "<script>window.location='index.php'</script>";
	exit;
}

// Step 1: Get today's date in the format 'YYYY-MM-DD'
$today = date('Y-m-d');
// Step 2: Use Medoo's select method to get records for today's date
$records = $database->select('expenses', '*', ['date' => $today]);

$dataPoints = array();
foreach ($records as $row)
{
    $dataPoints[] = array
    (
        'label' => $row['group'],      
        'y' => (float)$row['amount'],
    );
}

?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () 
{
 
var chart = new CanvasJS.Chart("chartContainer",
{
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Today's Expenses"
	},
	axisY:{
		includeZero: true
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html> 