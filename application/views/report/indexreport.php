<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Report</h4>
	
	<?php echo form_open('maincontroller/setupmeasure', array('id'=>'createmeasureform','class'=>"form-search form-searchx",'style'=>'text-align:left')); ?>
		&nbsp;&nbsp;Report Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="report name" name='searchmeasure' id='searchmeasure' />&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	
	<?php echo form_close(); ?>
	
	<div style='float:right;padding:2px;padding-bottom:5px;'><a href='<?php echo site_url().'/setup/SynchronizeReport/';?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Button-Refresh-icon.png';?>" style='max-width:25px;max-height:25px;' > <strong>Synchronize Report</strong></a>
	</div>
	
	&nbsp;
	<a href='<?php echo site_url().'/setup/createreport';?>' class="btn btn-primary" >Create New Report</a>
	<br /><br />
	
	<table class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th>Report Name</th>
			<th>Description</th>
			<th>Period</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	
		<?php foreach($listreport as $row) {?>
		<tr>
			<td><?php print $row['namereport']; ?></td>
			<td><?php print $row['descreport']; ?></td>
			<td>
				<?php
					switch($row['periodname']){
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
			<?php print $months.' '.$row['year']; ?></td>
			<td>
			
			<a href='<?php echo site_url().'/setup/addmeasuresreport/'.$row['idreport'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Actions-list-add-icon.png';?>" class='iconimgcrud'> Add Measures</a> | 
			<a href='<?php echo site_url().'/setup/viewgeneratereport/'.$row['idreport'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Preview-icon.png';?>" class='iconimgcrud'> View Report</a> | 
			<a href='<?php echo site_url().'/setup/editreport/'.$row['idreport'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> Edit</a> | 
			<a href='<?php echo site_url().'/setup/deletereport/'.$row['idreport'];?>' class='btn btn-link' onclick="return confirm('Apakah Anda akan menghapus data ini?');" ><img src="<?php echo base_url().'/libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud' > Delete</a>
			
			</td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	
	
	
</div>
