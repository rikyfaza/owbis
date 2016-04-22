<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Create Database</h5>
	
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
		echo form_open('setup/createdatabase', array('id'=>'createdatabaseform','class'=>"cmxform"));
	?>
	 
		<p>
			<label class="control-label">Database Name</label>
			<input type='text' name='databasename' id='databasename' placeholder='database name' class='input-xxlarge' />
		</p>

		<p>
			<label class="control-label">Start Year</label>
			<input type='text' name='startyear' id='startyear' placeholder='start year' class='input-small' />
		</p>

		<p>
			<label class="control-label">End Year</label>
			<input type='text' name='endyear' id='endtyear' placeholder='end year' class='input-small' />
		</p>

		<p>
			<label class="control-label">Year Start On First Day Of</label>
			<select class='input-small' name='yearstart'>
				<option><none></option>
				<option value='January' >January</option>
				<option value='February' >February</option>
				<option value='March' >March</option>
				<option value='April' >April</option>
				<option value='May' >May</option>
				<option value='Jun' >June</option>
				<option value='July' >July</option>
				<option value='August' >August</option>
				<option value='September' >September</option>
				<option value='October' >October</option>
				<option value='November' >November</option>
				<option value='December' >December</option>
			</select>
		</p>

	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit" >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupdatabase';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>
