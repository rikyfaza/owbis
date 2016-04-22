<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Locations</h4>

	<form class="form-search form-searchx">
		Location : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="location">&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	</form>
	
	&nbsp;&nbsp;<a href='<?php echo site_url().'/setup/createlocations';?>' class="btn btn-primary" >Add New Location</a>
	<br /><br />
	
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Name</th>
			<th class="my_th">Description</th>
			<th class="my_th">Categories</th>
			<th class="my_th">Parent Location</th>
			<th class="my_th">Owner</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($listLocations as $row){
		?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['categories']; ?></td>
			<td>
			<?php 
				$sql = mysql_query('select name from tbllocation where idlocation = "'.$row['parentlocation'].'"');
				$rows = mysql_fetch_assoc($sql);
				echo $rows['name'];
			?>
			</td>
			<td>
			<?php 
				$sql2 = mysql_query('select name from tblusers where idusers = "'.$row['locationowner'].'"');
				$rows2 = mysql_fetch_assoc($sql2);
				echo $rows2['name'];
			?>
			</td> 
			<td>
				<a href='<?php echo site_url().'/setup/editlocations/'.$row['idlocation'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> Edit</a>
				
				<!--  | 
				<a href='<?php echo site_url().'/setup/deletelocations/'.$row['idlocation'];?>' class='btn btn-link' onclick="return confirm('Apakah Anda akan menghapus data ini?');"><img src="<?php echo base_url().'libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud'> Delete</a></td>
				-->
			</td>	
		</tr>
		<?php
			}
		?>
	</tbody>	
	</table>
	
</div>
