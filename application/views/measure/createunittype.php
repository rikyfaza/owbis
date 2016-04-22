<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Create Unit Type</h5>
	
	<?php
		echo form_open('setup/saveunittype', array('id'=>'unittypeform', 'class'=>'cmxform'));
	?>
	<div id="createunittype">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='unitname' placeholder='unit name' class='input-xxlarge' />
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='unit description' name='unitdescription'></textarea>
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='unit categories' name='unitcategories'></textarea>
			</p>
		</div>
		<h5>Format</h5>
		<div>
			<p>
				<label class="control-label">Prefix</label>
				<input type='text' name='unitprefix' placeholder='prefix' class='input-xxlarge' />
				<label class="control-label">Suffix</label>
				<input type='text' name='unitsuffix' placeholder='suffix' class='input-xxlarge' />
				<label class="control-label">Total number of digits</label>
				<input type='text' name='numberdigits' placeholder='number digits' class='input-xxlarge' />
				<label class="control-label">Number of decimal places</label>
				<input type='text' name='decimalplaces' placeholder='decimal places' class='input-xxlarge' />
			</p>
		</div>
		
	</div>	
	
	<br />
	 
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
		
	<button type="submit" class="btn btn-primary" >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupunittype';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;

	<?php  
		echo form_close();
	?>
	
</div>
