<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Update Database</h5>
	
	<?php
    if ($this->session->flashdata('error'))
    {
      echo "<div class='alert alert-error'>";
      echo "<div class='message'>";
      echo $this->session->flashdata('error');
      echo "</div>";
      echo "</div>";
    }
    ?>
	
	<?php
		echo form_open('setup/editdatabase', array('id'=>'createdatabaseform','class'=>"cmxform"));
	?>
	 
		<p>
			<label class="control-label">Database Name</label>
			<input type='text' name='databasename' id='databasename' placeholder='database name' class='input-xxlarge' value='<?php echo $database[0]['dbname']; ?>' />
		</p>

		<p>
			<label class="control-label">Start Year</label>
			<input type='text' name='startyear' id='startyear' placeholder='start year' class='input-small' value='<?php echo $database[0]['startyear']; ?>' />
		</p>

		<p>
			<label class="control-label">End Year</label>
			<input type='text' name='endyear' id='endtyear' placeholder='end year' class='input-small' value='<?php echo $database[0]['endyear']; ?>' />
		</p>

		<p>
			<label class="control-label">Year Start On First Day Of</label>
			<select class='input-small' name='yearstart'>
				<option><none></option>
				<option value='January' <?php if($database[0]['yearfirstday']=='January') echo 'selected'; ?> >January</option>
				<option value='February'  <?php if($database[0]['yearfirstday']=='February') echo 'selected'; ?> >February</option>
				<option value='March'  <?php if($database[0]['yearfirstday']=='March') echo 'selected'; ?> >March</option>
				<option value='April'  <?php if($database[0]['yearfirstday']=='April') echo 'selected'; ?> >April</option>
				<option value='May'  <?php if($database[0]['yearfirstday']=='May') echo 'selected'; ?> >May</option>
				<option value='June'  <?php if($database[0]['yearfirstday']=='June') echo 'selected'; ?> >June</option>
				<option value='July'  <?php if($database[0]['yearfirstday']=='July') echo 'selected'; ?> >July</option>
				<option value='August'  <?php if($database[0]['yearfirstday']=='August') echo 'selected'; ?> >August</option>
				<option value='September'  <?php if($database[0]['yearfirstday']=='September') echo 'selected'; ?> >September</option>
				<option value='October'  <?php if($database[0]['yearfirstday']=='October') echo 'selected'; ?> >October</option>
				<option value='November'  <?php if($database[0]['yearfirstday']=='November') echo 'selected'; ?> >November</option>
				<option value='December'  <?php if($database[0]['yearfirstday']=='December') echo 'selected'; ?> >December</option>
			</select>
		</p>

	<input type='hidden' name='iddb' value='<?php echo $database[0]['iddb']; ?>' />
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit" >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupdatabase';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>
