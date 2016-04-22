	<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Assign Users to View : <?php print $viewname[0]['name']; ?></h5>

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
			<th class="my_th">Description</th>
			<th class="my_th">Email</th>
			<th class="my_th">Status</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			//print_r($idviewx);exit;
			$iddb = $this->uri->segment(3);
			$idview = $this->uri->segment(4);
			foreach ($daftaruserview as $row) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php if($row['status']=='signed'){echo 'Registered';}else{echo 'Not Registered';} ?></td>
			<td>
				<?php if($row['status']=='signed'){ ?>
					<a href='<?php echo site_url().'/setup/removefromuserview/'.$row['idusers'].'/'.$iddb.'/'.$idview; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Remove-Male-User-icon.png';?>" class='iconimgcrud'> Unassign user from view</a>
				<?php }else { ?>
					<a href='<?php echo site_url().'/setup/savetouserview/'.$row['idusers'].'/'.$iddb.'/'.$idview; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Male-user-add-icon.png';?>" class='iconimgcrud'> Assign user to view</a>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>	
	</table>

	<a href="<?php echo site_url().'/maincontroller/listviews/'.$_SESSION['dbuserlogged'];?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
</div>