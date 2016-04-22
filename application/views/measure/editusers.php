<style>
.iconpass{
	max-width:40px;
	min-width:40px;
	max-height: 40px;
	min-height: 40px;
}
</style>
<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Edit Users</h5>
	
	<?php
		echo form_open('setup/proseseditusers', array('id'=>'createuserform','class'=>'cmxform'));
	?>
	
	<div id="createusers">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='username' placeholder='user name' class='input-xxlarge' value='<?php echo $listUsers[0]['name']; ?>' />
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='user description' name='userdescription'><?php echo $listUsers[0]['description']; ?></textarea>
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='user categories' name='usercategories'><?php echo $listUsers[0]['categories']; ?></textarea>
			</p>
		</div>

		<h5>Login Information</h5>
		<div>
			<p>
				<label class="control-label">Login Name</label>
				<input type='text' name='loginname' id='loginname' placeholder='login name' class='input-xxlarge' value='<?php echo $listUsers[0]['loginname']; ?>' /><div id='warn' style='display:none;color:red;'>login name exists</div><br /><br />
				<label class="control-label">Change Password</label>
				<a href='#' id='<?php echo $listUsers[0]['idusers']; ?>' class='btn btn-link openpasswd'><img src="<?php echo base_url().'/libs/img/secrecy-icon.png';?>" class='iconpass'></a>
				
			</p>
		</div>

		<h5>Email Address</h5>
		<div>
			<p>
				<label class="control-label">Email Address</label>
				<input type='text' name='emailaddress' placeholder='email address' class='input-xxlarge' value='<?php echo $listUsers[0]['email']; ?>' />
			</p>
		</div>
	</div>	
	
	<input type='hidden' name='idusers' value='<?php echo $listUsers[0]['idusers']; ?>' />
	
	<br />
	
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit" id='submitform' >Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupusers';?>" class="btn btn-primary"  >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>

<div id="changepass" title="Change Password" style='display:none;font-size:10px;'>
	<p>
		<table class="table table-striped table-hover table-condensed">
			<tr>
				<td>New Password</td>
				<td> : </td>
				<td><input type='password' name='newpass' id='newpass' placeholder="new password" style='width:120px'></td>
			</tr>
			<input type='hidden' id='idusercp' name='idusercp' />
		</table>
	</p>			

	<p style='border-top:1px solid #000;text-align:left;'><br />
		<button type='button' class='btn btn-danger' id='closecp'>Close</button>&nbsp;&nbsp;&nbsp;
		<button type='submit' class='btn btn-primary' id='savesp' >Save</button>
	</p>

</div>






