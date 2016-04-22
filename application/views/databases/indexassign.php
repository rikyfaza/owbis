<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Assign Users to Database : <?php print $dbname[0]['dbname']; ?></h5>

	<form class="form-search form-searchx">
		User Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="user name">&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	</form>

	<br /><br />
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">User Name</th>
			<th class="my_th" width="30%">Description</th>
			<th class="my_th">Email</th>
			<th class="my_th">Status</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$iddb = $this->uri->segment(3);
			foreach ($daftarusers as $row) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php if($row['status']=='signed'){echo 'Registered';}else{echo 'Not Registered';} ?></td>
			<td>
				<?php if($row['status']=='signed'){ ?>
					<a href='<?php echo site_url().'/setup/removefromuserdb/'.$row['idusers'].'/'.$iddb; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Remove-Male-User-icon.png';?>" class='iconimgcrud'> Unassign from DB</a>
					<?php }else{ ?>
					
					<a href='<?php echo site_url().'/setup/savetouserdb/'.$row['idusers'].'/'.$iddb; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Male-user-add-icon.png';?>" class='iconimgcrud'> Assign to DB</a>
				<?php } ?>
				
				<?php if($row['status']=='signed'){ ?>
					| 
					<?php if($row['accesssetup']=='signed') { ?>
						<a href='<?php echo site_url().'/setup/remaccesssetup/'.$row['idusers'].'/'.$iddb; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Remove-Male-User-icon.png';?>" class='iconimgcrud'> Unassign from Setup</a>
						<?php }else{ ?>
						
						<a href='<?php echo site_url().'/setup/accesssetup/'.$row['idusers'].'/'.$iddb; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Male-user-add-icon.png';?>" class='iconimgcrud'> Assign to Setup</a>
					<?php }  ?>
					
				<?php } else {} ?>
				
			</td>
		</tr>
		<?php } ?>
	</tbody>	
	</table>

	<a href="<?php echo site_url().'/maincontroller/setupdatabase';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
</div>