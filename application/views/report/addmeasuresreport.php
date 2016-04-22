<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Add Measures to Report</h5>
	
	<br />
	<p>
		
		<div class='row'>
			
			<div class='span3'>
				
				<?php echo form_open('setup/addSelectedMeasureReport'); ?>
				<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th class="my_th">Available Measures</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($listmeasure as $row) {?>
					<tr>
						<input type='hidden' name='idreport' value='<?php print $this->uri->segment(3); ?>' />
						<input type='hidden' name='idmeasure' value='<?php print $row['idmeasure']; ?>' />
						<td>&nbsp;&nbsp;<input type='checkbox' name='measurereport[]' value='<?php print $row['idmeasure']; ?>' > &nbsp;<?php print $row['name']; ?></td>
					</tr>
					<?php } ?>
					
				</tbody>
				</table>
				&nbsp;&nbsp;<button class='btn btn-primary' type='submit' >Add ></button>
				
				<?php echo form_close(); ?>
			</div>
			
			
			<div class='span3'>
				<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th class="my_th" colspan='2'>Selected Measures</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($selectedmeasure as $row) {?>
					<tr>
						<input type='hidden' name='iddb' />
						<input type='hidden' name='idmeasure' value='<?php print $row['idmeasure']; ?>' />
						<td>&nbsp; <?php print $row['name'];?></td>
						<td>&nbsp; 
						<a href='#' name='<?php print $row['idreport']; ?>' id='<?php print $row['idmeasure']; ?>' class='btn btn-link delmeasurereport' onclick="return confirm('Apakah Anda akan menghapus data ini?');" ><img src="<?php echo base_url().'/libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud' > Delete</a></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
				
		</div>
	</p>
	
	&nbsp;&nbsp;<a href="<?php echo site_url().'/maincontroller/setupreport';?>" class="btn btn-primary" >Back</a>
</div>

