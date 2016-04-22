
<div class="divall form-olahdata" style='text-align:left'>
	
	<h5 style='border-bottom:1px solid #3B5998;'>Update Data Series</h5>
	<div class='row'>
		<div class='span8'>
			
			<?php echo form_open('setup/updateSataSeries', array('id'=>'createmeasureform','class'=>"cmxform")); ?>
			<label class="control-label">Name</label>
			<input type='text' name='seriesname' id='seriesname' placeholder='series name' class='input-xxlarge' value='<?php print $inserteddataseries[0]['name']; ?>' />
			
			<label class="control-label">Description</label>
			<textarea rows='4' class='input-xxlarge' placeholder='series description' name='descriptionseries'><?php print $inserteddataseries[0]['desc']; ?></textarea>
			
			<br /><br />
			<button class="btn btn-primary" type="submit" >Save</button>&nbsp;&nbsp;
			<a href="<?php echo site_url().'/setup/customSeries/'.$this->uri->segment(3);?>" class="btn btn-primary" >Back</a>
			
			<input type='hidden' name='idmeasure' value='<?php print $inserteddataseries[0]['idmeasure']; ?>' />
			<input type='hidden' name='iddb' value='<?php print $inserteddataseries[0]['iddb']; ?>' />
			<input type='hidden' name='iddataseries' value='<?php print $inserteddataseries[0]['iddataseries']; ?>' />
			
			<?php echo form_close(); ?>
			
		</div>
		
	</div>
	
</div>