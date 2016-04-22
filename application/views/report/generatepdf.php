<!DOCTYPE html>
<html>
<head>


<style type="text/css">

body {
  
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 8px;
  margin-left:50px;
  margin-right:30px;
  color: #333333;
  background-color: #ffffff;
}

h4 {
  font-size: 17.5px;
}

h5 {
  font-size: 14px;
}


table {
  max-width: 75%;
  background-color: transparent;
  border-collapse: collapse;
  border-spacing: 0;
  border: 1px solid #444;
}
.table {
  width: 100%;
  
}
.table td {
  border-top: 1px solid #444;
  border-left: 1px solid #444;
}

.table th,
.table td {
  padding: 2px;
  
  text-align: left;
  vertical-align: top;
  border-top: 1px solid #444;
  border-left: 1px solid #444;
  
}

.table th {
  font-weight: bold;
  background-color: #dddddd;
}

.table thead th {
  vertical-align: center;
  
}

.table {
  background-color: #ffffff;
}

.table-bordered {
  
  border-collapse: separate;
  *border-collapse: collapse;
  border-left: 0;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
}

.table-bordered th,
.table-bordered td {
  
}


.table-condensed th,
.table-condensed td {
  padding: 2px 2px;
}
</style>
		
</head>
<body>
		
<div class="divall form-olahdata" style='text-align:left'>


	<?php 
		switch( $inforeport[0]['periodname'] ){
			case 'jan':$months='January';break;
			case 'feb':$months='February';break; 
			case 'mar':$months='March';break;
			case 'apr':$months='April';break;
			case 'mei':$months='May';break;
			case 'jun':$months='June';break;
			case 'jul':$months='July';break;
			case 'aug':$months='August';break;
			case 'sep':$months='September';break;
			case 'okt':$months='October';break;
			case 'nop':$months='November';break;
			case 'des':$months='December';break;
		}
		//print $months.' '.$inforeport[0]['year']; 
	?>
	
	<h5 style='margin-left:10px;'><?php print $inforeport[0]['namereport']; ?><br />This Year To Date<br />
	<?php print $months.' '.$inforeport[0]['year']; ?>
	</h5>
	
	<div class='row'>
	
	<div class='span11'>

	<table class="table table-condensed table-bordered">
	<thead>
		<tr  style='border: 1px solid #444;'>
			<th style='text-align:center;vertical-align: middle;' rowspan='2'>Measure</th>
			<th>Actual</th>
			<th>Target</th>
			<th>Last Year</th>
		</tr>
		<tr style='border: 1px solid #444;'>
			
			<th>Data</th>
			<th>Data</th>
			<th>Data</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $detailreport as $row ) { ?>
		<tr >
			<td style='background-color: #dddddd;'><?php print $row['name']; ?></td>
			<td ><?php print $row['actual']; ?></td>
			<td ><?php print $row['target']; ?></td>
			<td ><?php print $row['actuallastyear']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	</div>
	</div>
	
	
	
</div>




</body>
</html>