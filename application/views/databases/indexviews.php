<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>List Views</h5>

	<form class="form-search form-searchx">
		View Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="view name">&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	</form>

	<br /><br />
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">View Name</th>
			<th class="my_th">Description</th>
			<th class="my_th">Top Measure</th>
			<th class="my_th">Display By</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$iddb = $this->uri->segment(3);
			foreach ($daftarview as $row) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['topmeasure']; ?></td>
			<td><?php echo $row['displayby']; ?></td>
			<td>
				<a href='<?php echo site_url().'/maincontroller/assignusersview/'.$iddb.'/'.$row['idview']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/User-Clients-icon.png';?>" class='iconimgcrud'> Assign Users</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>	
	</table>

	<a href="<?php echo site_url().'/maincontroller/setupdatabase';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
</div>