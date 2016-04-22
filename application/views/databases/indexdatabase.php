<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Databases</h4>
 
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
	
	<form class="form-search form-searchx">
		Database Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="database name">&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	</form>
	
	&nbsp;&nbsp;<a href='<?php echo site_url().'/maincontroller/createdatabase';?>' class="btn btn-primary" >Add New Database</a>
	<br /><br />

	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Database Name</th>
			<th class="my_th">Start Year</th>
			<th class="my_th">End Year</th>
			<th class="my_th">First Day</th>
			<th class="my_th">Assign Users</th>
			<th class="my_th">Registered Views</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		
		<?php foreach ($listdatabases as $row) { ?>
		<tr>
			<td><?php echo $row['dbname']; ?></td>
			<td><?php echo $row['startyear']; ?></td>
			<td><?php echo $row['endyear']; ?></td>
			<td><?php echo $row['yearfirstday']; ?></td>
			<td>
				<a href='<?php echo site_url().'/maincontroller/assignusersdb/'.$row['iddb']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/User-Clients-icon.png';?>" class='iconimgcrud'> Assign Users</a>
			</td>
			<td>
				<a href='<?php echo site_url().'/maincontroller/listviews/'.$row['iddb']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/organization-icon.png';?>" class='iconimgcrud'> Display Views</a>
			</td>
			<td>
				
				<a href='<?php echo site_url().'/maincontroller/sinkronisasidatabase/'.$row['iddb']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Button-Refresh-icon.png';?>" class='iconimgcrud'> 
				Synchronize</a> </a> 
				| 
				<a href='<?php echo site_url().'/maincontroller/editdatabase/'.$row['iddb']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> 
				Edit</a> 
				| 
				<a href='<?php echo site_url().'/setup/copydb/'.$row['iddb']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud' > Copy Database</a>
				<!--
				| 
				<a href='<?php echo site_url().'/setup/deldb/'.$row['iddb']; ?>' class='btn btn-link' onclick="return confirm('Apakah Anda akan menghapus data ini?');"><img src="<?php echo base_url().'/libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud' > Delete</a>
				-->
			</td>
		</tr>
		<?php } ?>		
	</tbody>	
	</table>
	
</div>








