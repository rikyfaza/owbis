<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>View</h4>

	<form class="form-search form-searchx">
		View Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="view name">&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	</form>
	
	
	&nbsp;&nbsp;<a href='<?php echo site_url().'/setup/createviews';?>' class="btn btn-primary" >Add New View</a>
	<br /><br />
	
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Name</th>
			<th class="my_th">Description</th>
			<th class="my_th">Categories</th>
			<th class="my_th">Title</th>
			<th class="my_th">Top Measure</th>
			<th class="my_th">Top Location</th>
			<th class="my_th">Display by</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
    
	<tbody>
    	<?php foreach($listViews as $row) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['categories']; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['topmeeasures']; ?></td>
			<td><?php echo $row['toplocations']; ?></td>
			<td><?php echo $row['displayby']; ?></td>
			<td> 
			
				<a href='<?php echo site_url().'/setup/editviews/'.$row['idview'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> Edit</a> | 
				
				<a href='<?php echo site_url().'/setup/deleteviews/'.$row['idview'];?>' class='btn btn-link' onclick="return confirm('Apakah Anda akan menghapus data ini?');"><img src="<?php echo base_url().'libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud'> Delete</a></td>
		</tr>
        <?php } ?>

	</tbody>	
	</table>
	
</div>
