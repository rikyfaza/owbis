<div class="divall form-olahdata" style='text-align:left'>
	
	<h4 style='border-bottom:1px solid #3B5998;'>Period</h4>
	
	<h5>Current Active Period</h5><br />
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Month</th>
			<th class="my_th">Year</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($activeperiod as $row) { ?>
		<tr>
			<td><?php 
				switch ($row['month']) {
					case 'Jan':
						echo 'January';
						break;
					case 'Feb':
						echo 'February';
						break;
					case 'Mar':
						echo 'March'; 
						break;
					case 'Apr':
						echo 'April';
						break;
					case 'May':
						echo 'May';
						break;
					case 'Jun':
						echo 'June';
						break;
					case 'Jul':
						echo 'July';
						break;
					case 'Aug':
						echo 'August';
						break;
					case 'Sep':
						echo 'September';
						break;
					case 'Oct':
						echo 'October';
						break;
					case 'Nov':
						echo 'November';
						break;
					case 'Dec':
						echo 'December';
						break;
					default:
						# code...
						break;
				}
			?></td>
			<td><?php echo $row['year']; ?></td>
			<td>	
				<a href='<?php echo site_url().'/setup/editperiod/';?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/pencil-icon.png';?>" class='iconimgcrud'> Edit</a>
		</tr>
		<?php } ?>
	</tbody>	
	</table>
	
</div>
