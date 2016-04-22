<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Create Users</h5>
	
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
		echo form_open('setup/saveusers', array('id'=>'createuserform','class'=>'cmxform'));
	?>
	<div id="createusers">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='username' placeholder='user name' class='input-xxlarge' />
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='user description' name='userdescription'></textarea>
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='user categories' name='usercategories'></textarea>
			</p>
		</div>
		
		<h5>Login Information</h5>
		<div>
			<p>
				<label class="control-label">Login Name</label>
				<input type='text' name='loginname' id='loginname' placeholder='login name' class='input-xxlarge' /><div id='warn' style='display:none;color:red;'>login name exists</div>
				<label class="control-label">Password</label>
				<input type='password' name='password' id='password' placeholder='password' class='input-xxlarge' />
				<label class="control-label">Confirm Password</label>
				<input type='password' name='confirm_password' id='confirm_password' placeholder='confirm password' class='input-xxlarge' />
			</p>
		</div>

		<h5>Email Address</h5>
		<div>
			<p>
				<label class="control-label">Email Address</label>
				<input type='text' name='emailaddress' placeholder='email address' class='input-xxlarge' />
			</p>
		</div>
	</div>	
	
	<br />
	
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit" id='submitform' >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupusers';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>