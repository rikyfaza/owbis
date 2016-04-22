<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Company Profile</h4>
	
	<?php
		echo form_open('setup/companyprofile', array('id'=>'companyprofileform','class'=>"cmxform"));
	?>
	
	<div style='margin-left:20px;'>
	
	<p>
		<br />
		<label class="control-label">Nama Perusahaan</label>
		<input type='text' name='companyname' id='companyname' placeholder='nama perusahaan' class='input-xlarge' value='<?php echo $profile[0]['namecompany']; ?>' />
		<br /><br />
		<label class="control-label">Alamat Perusahaan</label>
		<textarea rows='4' class='input-xlarge' placeholder='alamat perusahaan' name='companyaddress'><?php echo $profile[0]['addresscompany']; ?></textarea>
		<br /><br />
		<label class="control-label">Telp</label>
		<input type='text' name='companytelp' id='companytelp' placeholder='telepon' class='input-xlarge' value='<?php echo $profile[0]['telpcompany']; ?>' />
		<br /><br />
		<label class="control-label">Fax</label>
		<input type='text' name='companyfax' id='companyfax' placeholder='faximile' class='input-xlarge' value='<?php echo $profile[0]['faxcompany']; ?>' />
		<br /><br />
		<label class="control-label">Email</label>
		<input type='text' name='companyemail' id='companyemail' placeholder='email' class='input-xlarge' value='<?php echo $profile[0]['emailcompany']; ?>' />
		<br /><br />
		<label class="control-label">Homepage</label>
		<input type='text' name='companyhomepage' id='companyhomepage' placeholder='homepage' class='input-xlarge' value='<?php echo $profile[0]['homepagecompany']; ?>' />
		<br /><br />
		<button class="btn btn-primary" type="submit" >Save</button>&nbsp;&nbsp;
	</p>
	
	</div>
	
	<?php  
		echo form_close();
	?>
	
</div>