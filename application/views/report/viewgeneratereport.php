
<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>View Report</h4>
	
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
		
	?>
	
	<h5 style='margin-left:10px;'><?php print $inforeport[0]['namereport']; ?><br />This Year To Date<br />
	<?php print $months.' '.$inforeport[0]['year']; ?>
	</h5>
	
	
	<div class='row'>
	
	<div class='span9'>
	<br />
	<table class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr >
			<th style='text-align:center;vertical-align: middle;' rowspan='2'>Measure</th>
			<th>Actual</th>
			<th>Target</th>
			<th>Last Year</th>
		</tr>
		<tr>
			
			<th>Data</th>
			<th>Data</th>
			<th>Data</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $detailreport as $row ) { ?>
		<tr>
			<td><?php print $row['name']; ?></td>
			<td><?php print $row['actual']; ?></td>
			<td><?php print $row['target']; ?></td>
			<td><?php print $row['actuallastyear']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	</div>
	
	</div>
	<a href='<?php echo site_url().'/setup/generatePDF/'.$inforeport[0]['idreport'];?>' class='btn btn-link' ><img src="<?php echo base_url().'/libs/img/PDF-icon.png';?>" style='max-width:40px;max-height:40px;' > Export to PDF</a>
	
	&nbsp;&nbsp;<a href="<?php echo site_url().'/maincontroller/setupreport';?>" class="btn btn-primary" >Back</a>
</div>

