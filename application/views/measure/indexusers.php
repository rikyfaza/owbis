<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Users</h4>
	<br />
	<?php if($_SESSION['userlevel'] == 'admin'){ ?>
	<form class="form-search form-searchx">
		User Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="user name">&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	</form>
	
	
	&nbsp;&nbsp;<a href='<?php echo site_url().'/setup/createusers';?>' class="btn btn-primary" >Add New User</a>
	<br /><br />
	<?php } else {} ?>
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Name</th>
			<th class="my_th">Description</th>
			<th class="my_th">Categories</th>
			<th class="my_th">Login Name</th>
			<th class="my_th">Email</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($listUsers as $row){
		?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['categories']; ?></td>
			<td><?php echo $row['loginname']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td>
				<a href='<?php echo site_url().'/setup/editusers/'.$row['idusers'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> Edit</a>

				<!-- | 
				
				<a href='#' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud'> Delete</a>
				-->
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>	
	</table>
	
</div>
