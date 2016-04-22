
<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Create Data Series</h5>
	<div class='row'>
		<div class='span8'>
			
			<?php echo form_open('setup/savedataseries', array('id'=>'createmeasureform','class'=>"cmxform")); ?>
			<label class="control-label">Name</label>
			<input type='text' name='seriesname' id='seriesname' placeholder='series name' class='input-xxlarge' />
			
			<label class="control-label">Description</label>
			<textarea rows='4' class='input-xxlarge' placeholder='series description' name='descriptionseries'></textarea>
			
			<br /><br />
			<button class="btn btn-primary" type="submit" >Save</button>&nbsp;&nbsp;
			<a href="<?php echo site_url().'/setup/customSeries/'.$this->uri->segment(3);?>" class="btn btn-primary" >Back</a>
			
			<input type='hidden' name='idmeasure' value='<?php print $listmeasure[0]['idmeasure']; ?>' />
			<input type='hidden' name='iddb' value='<?php print $listmeasure[0]['iddb']; ?>' />
			<input type='hidden' name='storageperiod' value='<?php print $listmeasure[0]['storageperiod']; ?>' />
			<input type='hidden' name='unittype' value='<?php print $listmeasure[0]['unittype']; ?>' />
			<?php echo form_close(); ?>
			
		</div>
		
	</div>
	
</div>