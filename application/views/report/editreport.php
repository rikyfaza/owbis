<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Edit Report</h5>
	
	<?php
		echo form_open('setup/updatereport', array('id'=>'createmeasureform','class'=>"cmxform"));
	?>
	
	<p>
		<label class="control-label">Name</label>
		<input type='text' name='reportname' id='reportname' placeholder='report name' class='input-xxlarge' value='<?php print $detailreport[0]['namereport']; ?>'/>
		
		
		<label class="control-label">Description</label>
		<textarea rows='4' class='input-xxlarge' placeholder='report description' name='reportdescription'><?php print $detailreport[0]['descreport']; ?></textarea>
		
		<label class="control-label">Month</label>
		
			
		<select name='month' >
			<option ><none></option>
			<option value='jan' <?php if( $detailreport[0]['periodname']=='jan') { echo 'selected'; } else {} ?>>January</option>
			<option value='feb' <?php if( $detailreport[0]['periodname']=='feb') { echo 'selected'; } else {} ?>>February</option>
			<option value='mar' <?php if( $detailreport[0]['periodname']=='mar') { echo 'selected'; } else {} ?>>March</option>
			<option value='apr' <?php if( $detailreport[0]['periodname']=='apr') { echo 'selected'; } else {} ?>>April</option>
			<option value='mei' <?php if( $detailreport[0]['periodname']=='mei') { echo 'selected'; } else {} ?>>May</option>
			<option value='jun' <?php if( $detailreport[0]['periodname']=='jun') { echo 'selected'; } else {} ?>>June</option>
			<option value='jul' <?php if( $detailreport[0]['periodname']=='jul') { echo 'selected'; } else {} ?>>July</option>
			<option value='aug' <?php if( $detailreport[0]['periodname']=='aug') { echo 'selected'; } else {} ?>>August</option>
			<option value='sep' <?php if( $detailreport[0]['periodname']=='sep') { echo 'selected'; } else {} ?>>September</option>
			<option value='okt' <?php if( $detailreport[0]['periodname']=='okt') { echo 'selected'; } else {} ?>>October</option>
			<option value='nop' <?php if( $detailreport[0]['periodname']=='nop') { echo 'selected'; } else {} ?>>November</option>
			<option value='des' <?php if( $detailreport[0]['periodname']=='des') { echo 'selected'; } else {} ?>>December</option>
		</select>
		
		<label class="control-label">Year</label>
		<input type='text' name='year' id='year' placeholder='year' class='input-small' value='<?php print $detailreport[0]['year']; ?>' />
		<input type='hidden' name='idreport' value='<?php print $detailreport[0]['idreport']; ?>' />
	</p>
	<button class='btn btn-primary' type='submit' >Update</button>
	&nbsp;&nbsp;<a href="<?php echo site_url().'/maincontroller/setupreport';?>" class="btn btn-primary" >Back</a>
</div>

