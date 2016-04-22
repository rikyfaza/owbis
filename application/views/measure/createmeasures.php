

<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Create Measures</h5>
	
	<?php
		echo form_open('setup/savemeasure', array('id'=>'createmeasureform','class'=>"cmxform"));
	?>
	
	<div id="createmeasures">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='measurename' id='measurename' placeholder='measure name' class='input-xxlarge' />
				
				
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure description' name='measuredescription'></textarea>
				
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure categories' name='measurecategories'></textarea>
				
			</p>
		</div>
		<h5>Measure Type</h5>
		<div>
			<p style='border:1px solid #000;'>
				&nbsp;&nbsp;<input type='radio' name='measuretype' id='typegroup' value='group' checked="checked"> Group <br /><br />
				&nbsp;&nbsp;<input type='radio' name='measuretype' id='typedata' value='data'> Data <br /><br />
				&nbsp;&nbsp;<input type='radio' name='measuretype' id='typeformula' value='formula'> Formula <br /><br />
			</p>
			<p><input type='checkbox' name='critical' value='1'> Critical</p>
		</div>
		<!--
		<h5>Parent Measure</h5>
		<div>
			<p>
				<label class="control-label">Parent measure</label>
				<select class='input-xxlarge' name='parentmeasure'>
					<option value='-'>--</option>
					<?php // foreach($parentmeasure as $row){?>
					<option value='<?php //echo $row['idmeasure']; ?>'><?php echo $row['name']; ?></option>
					<?php //} ?>
				</select>
			</p>
		</div>
		-->
		<h5>Data Properties</h5>
		<div>
			
			<p style='border:1px solid #000;' id='polarityshow' >
				<label class="control-label">&nbsp;&nbsp;Polarity</label>
				&nbsp;&nbsp;<input type='radio' name='measurepolarity' value='good' checked="checked"> High values are good <br />
				&nbsp;&nbsp;<input type='radio' name='measurepolarity' value='bad'> High values are bad <br /><br />
			</p>
			
			<label class="control-label">Storage Period</label>
			<select class='input-xxlarge' name='storageperiod'>
				<option><none></option>
				<option value='month' selected="selected">Month</option>
				<option value='quarter' >Quarter</option>
				<option value='week' >Week</option>
				<option value='year' >Year</option>
			</select>
			
			<p id='unitshow' >
			<label class="control-label">Unit Type</label>
			<select class='input-xxlarge' name='unittype'>
				<option><none></option>
				<?php foreach($unittype as $row){?>
				<option value='<?php echo $row['idunittype']; ?>'><?php echo $row['name']; ?></option>
				<?php } ?>
			</select>
			</p>
			
		</div>
		<h5>Owners</h5>
		<div>
			<p>
				<label class="control-label">Default owner</label>
				<select class='input-xxlarge' name='owner'>
					<option><none></option>
					<?php foreach($users as $row){?>
					<option value='<?php echo $row['idusers']; ?>'><?php echo $row['name']; ?></option>
					<?php } ?>
				</select>
				<!--
				<label class="control-label">Owners by location</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure owner by location' name='measureownerlocation'></textarea>-->
			</p>
			<!--
			<hr />
			<p>
				<label class="control-label">Default owner's assistant</label>
				<select class='input-xxlarge'>
					<option>--</option>
					<option>--</option>
					<option>--</option>
				</select>
				<label class="control-label">Owner's assistant by location</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure owner assistant by location' name='measureownerassistantlocation'></textarea>-->
			</p>
		</div>
		
		<h5 id='conshead' >Consolidation Functions</h5>
		<div id='consbody' >
			<p>
				<label class="control-label">Period consolidation functions</label>
				<input type='radio' name='consf' value='sum' checked='checked' /> Sum <br />
				<input type='radio' name='consf' value='ave' /> Average <br />
				<input type='radio' name='consf' value='lastval' /> Take last known value
			</p>
		</div>
		
		<h5>Notes</h5>
		<div>
			<p>
				<label class="control-label">Notes</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure notes' name='measurenotes'></textarea>
			</p>
		</div>
		
		<h5>Locations</h5>
		<div>
			<p><!--
				<label class="control-label">Locations</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure locations' name='measurelocations'></textarea>-->
				
				<label class="control-label">Location</label>
				<select class='input-xxlarge' name='location' >
					<option><none></option>
					<?php foreach ( $location as $row ) { ?>
					<option value='<?php echo $row['idlocation']; ?>'><?php echo $row['name']; ?></option>
					<?php } ?>
				</select>
			</p>
		</div>
		
	</div>	
	
	<br />
	
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit" >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>

