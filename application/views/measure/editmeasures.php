<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Edit Measures</h5>
	
	<?php
		echo form_open('setup/proseseditmeasure', array('id'=>'createmeasureform','class'=>"cmxform"));
	?>
	<?php
		//print_r($listMeasures[0]['consolidationfunctions']);
	?>
	<div id="createmeasures">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='measurename' placeholder='measure name' class='input-xxlarge' value='<?php echo $listMeasures[0]['name']; ?>' />
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure description' name='measuredescription'><?php echo $listMeasures[0]['description']; ?></textarea>
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure categories' name='measurecategories'><?php echo $listMeasures[0]['categories']; ?></textarea>
			</p>
		</div>
		
		<h5>Measure Type</h5>
		<div>
			<p style='border:1px solid #000;'>
				&nbsp;&nbsp;<input type='radio' name='measuretype' id='typegroup' value='group' <?php if( $listMeasures[0]['type']=='group') { echo 'checked'; } else {} ?> > Group <br /><br />
				&nbsp;&nbsp;<input type='radio' name='measuretype' id='typedata' value='data' <?php if( $listMeasures[0]['type']=='data') { echo 'checked'; } else {} ?> > Data <br /><br />
				&nbsp;&nbsp;<input type='radio' name='measuretype' id='typeformula' value='formula' <?php if( $listMeasures[0]['type']=='formula') { echo 'checked'; } else {} ?> > Formula <br /><br />
			</p>
			<p><input type='checkbox' name='critical' value='1' <?php if( $listMeasures[0]['critical']=='1') { echo 'checked'; } else {} ?> > Critical</p>
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

			<?php if( $listMeasures[0]['type']=='group') { } else { ?>
			<p style='border:1px solid #000;' id='polarityshow' >
				<label class="control-label">&nbsp;&nbsp;Polarity</label>
				&nbsp;&nbsp;<input type='radio' name='measurepolarity' value='good' <?php if( $listMeasures[0]['polarity']=='good') { echo 'checked'; } else {} ?> > High values are good <br />
				&nbsp;&nbsp;<input type='radio' name='measurepolarity' value='bad' <?php if( $listMeasures[0]['polarity']=='bad') { echo 'checked'; } else {} ?> > High values are bad <br /><br />
			</p>
			<?php } ?>
			<label class="control-label">Storage Period</label>
			
			<select class='input-xxlarge' name='storageperiod'>
				<option><none></option>
				<option value='month' <?php if( $listMeasures[0]['storageperiod']=='month') { echo 'selected'; } else {} ?> >Month</option>
				<option value='quarter' <?php if( $listMeasures[0]['storageperiod']=='quarter') { echo 'selected'; } else {} ?> >Quarter</option>
				<option value='week' <?php if( $listMeasures[0]['storageperiod']=='week') { echo 'selected'; } else {} ?> >Week</option>
				<option value='year' <?php if( $listMeasures[0]['storageperiod']=='year') { echo 'selected'; } else {} ?> >Year</option>
			</select><br /><br />
			
			<?php if( $listMeasures[0]['type']=='group') { } else { ?>
			<p id='unitshow' >
			<label class="control-label">Unit Type</label>
			
			<select class='input-xxlarge' name='unittype'>
				<option><none></option>
				<?php foreach($unittype as $row){?>
					<option value='<?php echo $row['idunittype']; ?>' <?php if( $listMeasures[0]['unittype']==$row['idunittype']) { echo 'selected'; } else {} ?> ><?php echo $row['name']; ?></option>
				<?php } ?>
			</select>
			</p>
			<?php } ?>

		</div>
		<h5>Owners</h5>
		<div>
			<p>
				<label class="control-label">Default owner</label>
				<select class='input-xxlarge' name='owner'>
					<option><none></option>
					<?php foreach($users as $row){?>
						<option value='<?php echo $row['idusers']; ?>' <?php if( $listMeasures[0]['defaultowner']==$row['idusers']) { echo 'selected'; } else {} ?>><?php echo $row['name']; ?></option>
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
		
		<?php if( $listMeasures[0]['type']=='group') { } else { ?>
		<h5 id='conshead' >Consolidation Functions</h5>
		<div id='consbody' >
			<p>
				<label class="control-label">Period consolidation functions</label>
				<input type='radio' name='consf' value='sum' <?php if( $listMeasures[0]['consolidationfunctions']=='sum') { echo 'checked'; } else {} ?> /> Sum <br />
				<input type='radio' name='consf' value='ave' <?php if( $listMeasures[0]['consolidationfunctions']=='ave') { echo 'checked'; } else {} ?> /> Average <br />
				<input type='radio' name='consf' value='lastval' <?php if( $listMeasures[0]['consolidationfunctions']=='lastval') { echo 'checked'; } else {} ?> /> Take last known value
			</p>
		</div>
		<?php } ?>

		<h5>Notes</h5>
		<div>
			<p>
				<label class="control-label">Notes</label>
				<textarea rows='4' class='input-xxlarge' placeholder='measure notes' name='measurenotes'><?php echo $listMeasures[0]['notes']; ?></textarea>
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
						<option value='<?php echo $row['idlocation']; ?>' <?php if( $listMeasures[0]['location']==$row['idlocation']) { echo 'selected'; } else {} ?> ><?php echo $row['name']; ?></option>
					<?php } ?>
				</select>
			</p>
		</div>
		
		<!--
		<h5>Security</h5>
		<div>
			<p><a href="<?php print site_url().'/setup/setSecurityMeasure/'.$listMeasures[0]['idmeasure']; ?>"><i class="icon-lock"></i> Set measure security click here!</a></p>
		</div>
		-->
	</div>	
	
	<input type='hidden' name='idmeasure' value='<?php echo $listMeasures[0]['idmeasure']; ?>' />
	
	<br />
	
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit">Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>
