<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Create Report</h5>
	
	<?php
		echo form_open('setup/savereport', array('id'=>'createmeasureform','class'=>"cmxform"));
	?>
	
	<p>
		<label class="control-label">Name</label>
		<input type='text' name='reportname' id='reportname' placeholder='report name' class='input-xxlarge' />
		
		
		<label class="control-label">Description</label>
		<textarea rows='4' class='input-xxlarge' placeholder='report description' name='reportdescription'></textarea>
		
		<label class="control-label">Month</label>
		<select name='month' >
			<option ><none></option>
			<option value='jan'>January</option>
			<option value='feb'>February</option>
			<option value='mar'>March</option>
			<option value='apr'>April</option>
			<option value='mei'>May</option>
			<option value='jun'>June</option>
			<option value='jul'>July</option>
			<option value='aug'>August</option>
			<option value='sep'>September</option>
			<option value='okt'>October</option>
			<option value='nop'>November</option>
			<option value='des'>December</option>
		</select>
		
		<label class="control-label">Year</label>
		<input type='text' name='year' id='year' placeholder='year' class='input-small' />
		
	</p>
	<button class='btn btn-primary' type='submit' >Save</button>
	&nbsp;&nbsp;<a href="<?php echo site_url().'/maincontroller/setupreport';?>" class="btn btn-primary" >Back</a>
</div>

