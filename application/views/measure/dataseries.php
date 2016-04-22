<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Custom Data Series</h4>
	
	<div class='row' >
		
		<div class='span8' style='margin-bottom:10px;'>
			<h5>Measure : <?php if( !empty($listmeasure) ){print $listmeasure[0]['name'];} else {} ?>
			</h5>
		</div>
		
		
				
		<div class='span9' style='margin-bottom:10px;'>
			<a href='<?php echo site_url().'/setup/createseries/'.$listmeasure[0]['idmeasure'];?>' class="btn btn-primary" >Add Data Series</a>&nbsp;&nbsp;&nbsp;<br /><br />
			<?php
				if ($this->session->flashdata('Error'))
				{
					echo "<div class='alert alert-error'>";
					echo $this->session->flashdata('Error');
					echo "</div>";
				}
			?>
			<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th class="my_th">Name</th>
						<th class="my_th">Storage Period</th>
						<th class="my_th">Unit Type</th>
						<th class="my_th">Description</th>		
						<th class="my_th">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if( !empty($listdataseries) ){
						foreach($listdataseries as $row) { ?>
					<tr>
						<td><?php print $row['name']; ?></td>
						<td><?php print $row['storageperiod']; ?></td>
						<td><?php print $row['unitname']; ?></td>
						<td><?php print $row['desc']; ?></td>
						
						<td>	
							
							<a href='<?php echo site_url().'/setup/editDataSeries/'.$row['iddataseries'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> 
							Edit</a> | 
							
							<a href='<?php echo site_url().'/setup/deleteDataSeries/'.$row['iddataseries'].'/'.$row['idmeasure'];?>' class='btn btn-link' onclick="return confirm('Are you sure you want to delete this data?');" ><img src="<?php echo base_url().'/libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud' > Delete</a>
						</td>
			
					</tr>
					<?php }} ?>
				</tbody>	
			</table>
			
			
			<a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" class="btn btn-primary" >Back</a>
		</div>
		
		<div class='span8'>
			
		</div>
		
	</div>
</div>