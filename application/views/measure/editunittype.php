<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Edit Unit Type</h5>
	
	<?php
		echo form_open('setup/proseseditunittype', array('id'=>'unittypeform', 'class'=>'cmxform'));
	?>
	
	<div id="createunittype">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='unitname' placeholder='unit name' class='input-xxlarge' value='<?php echo $listUnitType[0]['name']; ?>' />
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='unit description' name='unitdescription' ><?php echo $listUnitType[0]['description']; ?></textarea>
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='unit categories' name='unitcategories'><?php echo $listUnitType[0]['categories']; ?></textarea>
			</p>
		</div>
		<h5>Format</h5>
		<div>
			<p>
				<label class="control-label">Prefix</label>
				<input type='text' name='unitprefix' placeholder='prefix' class='input-xxlarge' value='<?php echo $listUnitType[0]['prefix']; ?>' />
				<label class="control-label">Suffix</label>
				<input type='text' name='unitsuffix' placeholder='suffix' class='input-xxlarge' value='<?php echo $listUnitType[0]['suffix']; ?>'  />
				<label class="control-label">Total number of digits</label>
				<input type='text' name='numberdigits' placeholder='number digits' class='input-xxlarge' value='<?php echo $listUnitType[0]['numberdigit']; ?>' />
				<label class="control-label">Number of decimal places</label>
				<input type='text' name='decimalplaces' placeholder='decimal places' class='input-xxlarge' value='<?php echo $listUnitType[0]['decimalplace']; ?>' />
			</p>
		</div>
		
	</div>	
	
	<input type='hidden' name='idunittype' value='<?php echo $listUnitType[0]['idunittype']; ?>' />
	
	<br />
	
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button type="submit" class="btn btn-primary" >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupunittype';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;

	<?php  
		echo form_close();
	?>
	
</div>
