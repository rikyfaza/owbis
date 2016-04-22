
	<script>
	$().ready(function() {
		$('#searchmeasure').autocomplete({
			source: "<?php print site_url().'/maincontroller/searchMeasure' ?>",			
			minLength: 2,
			dataType: "json"
		}); 
	});
	</script>

	
<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Measures</h4>

	<?php echo form_open('maincontroller/setupmeasure', array('id'=>'createmeasureform','class'=>"form-search form-searchx",'style'=>'text-align:left')); ?>
		Measure Name : &nbsp; 
		<input type="text" class="input-large search-query" placeholder="measure name" name='searchmeasure' id='searchmeasure' />&nbsp;&nbsp;
		<button type="submit" class="btn btn-warning">Search</button>
	
	<?php echo form_close(); ?>

	
	&nbsp;&nbsp;
	<a href='<?php echo site_url().'/setup/createmeasures';?>' class="btn btn-primary" >Add New Measure</a>
	<br /><br />

	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Name</th>
			<th class="my_th">Type</th>
			<!-- <th class="my_th">Polarity</th> -->
			
			
			<th class="my_th">Submeasure</th>
			<th class="my_th">Permissions</th>
			<th class="my_th">Data Series</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($listMeasures as $row) {
		?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['type']; ?></td>
			<!-- <td><?php //echo $row['polarity']; ?></td> 
			<td><?php echo $row['storageperiod']; ?></td>
			-->
			
			
			<td>
				<?php if($row['edit']=='1'){ ?>
					<?php if($row['type']=='group' || $row['type']=='formula') {?>
					<a href='<?php echo site_url().'/maincontroller/submeasures/'.$row['idmeasure'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Actions-list-add-icon.png';?>" class='iconimgcrud'> Submeasure</a>
					<?php } else {} ?>
				<?php } else { } ?>
			</td>
			
			<td>
				<?php if($row['edit']=='1'){ ?>
				<a href='<?php echo site_url().'/setup/setSecurityMeasure/'.$row['idmeasure']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Lock-Lock-icon.png';?>" class='iconimgcrud'> 
					Set permissions</a>
				<?php } else { } ?>
			</td>
			
			<td>
				<?php if($row['edit']=='1'){ ?>
				<a href='<?php echo site_url().'/setup/customSeries/'.$row['idmeasure']; ?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/data-add-icon.png';?>" class='iconimgcrud'> 
					Custom Data Series</a>
				<?php } else { } ?>
			</td>
			
			<td>	
				<?php if($row['edit']=='1'){ ?>
				<a href='<?php echo site_url().'/setup/editmeasure/'.$row['idmeasure'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> 
				Edit</a> | 
				
				<a href='<?php echo site_url().'/setup/deletemeasure/'.$row['idmeasure'];?>' class='btn btn-link' onclick="return confirm('Apakah Anda akan menghapus data ini?');" ><img src="<?php echo base_url().'/libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud' > Delete</a> | 
				
				<a href='<?php echo site_url().'/setup/duplicatemeasure/'.$row['idmeasure'];?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> Duplicate</a>
				<?php } else {  } ?>
			</td>
			
		</tr>
		<?php
			}
		?>
		
	</tbody>	
	</table>
</div>

