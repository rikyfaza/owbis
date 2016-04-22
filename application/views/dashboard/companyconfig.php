<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Setup Company</h4>
	
	
	
	<div style='margin-left:20px;'>
	
		<?php
			echo form_open('setup/companyConfig', array('id'=>'companyprofileform','class'=>"cmxform"));
		?>
	
		<label class="control-label">Max Database Records</label>
		<input type='text' name='dbmax' id='dbmax' placeholder='max database record' class='input-small' value='<?php if(!empty($companyConfig)){ print $companyConfig[0]['maxdb']; } ?>' />
		
		<br /><br />
		<label class="control-label">Max Users Records</label>
		<input type='text' name='usermax' id='usermax' placeholder='max user record' class='input-small' value='<?php if(!empty($companyConfig)){ print $companyConfig[0]['maxuser']; } ?>' />
		
		<input type='hidden' name='idcompany' id='idcompany' value="<?php print $profile[0]['idcompany']; ?>" />
		<br /><br />
		<button class="btn btn-primary" type="submit" >Save</button>
	
		<?php  
			echo form_close();
		?>
	
	</div>
	
</div>

