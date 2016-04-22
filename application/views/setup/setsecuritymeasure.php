<?php //print_r($selecteduser); ?>
<div class='row'>
	<div class='span10'>
		<div class="divall form-olahdata" style='text-align:left'>
			<h5 style='border-bottom:1px solid #3B5998;'>Config measure permissions for '<?php print $listmeasure[0]['name']; ?>'</h5>
			<br />
			<div class='row'>
			

			
				<div class='span3'>
					&nbsp;&nbsp;<strong>Available</strong><br /><br />
					<?php echo form_open('setup/addUserSecurityMeasure'); ?>
					<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th class="my_th">Username</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($listuser as $row) {?>
						<tr>
							<input type='hidden' name='iddb' value='<?php print $listmeasure[0]['iddb']; ?>' />
							<input type='hidden' name='idmeasure' value='<?php print $listmeasure[0]['idmeasure']; ?>' />
							<td>&nbsp;&nbsp;<input type='checkbox' name='namesecuritymeasure[]' value='<?php print $row['idusers']; ?>' > &nbsp;<?php print $row['name']; ?></td>
						</tr>
						<?php } ?>
						</tr>
					</tbody>
					</table>
					&nbsp;&nbsp;<button class='btn btn-primary' type='submit' >Add ></button>
					&nbsp;&nbsp;<a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" class="btn btn-primary" >Back</a>
					<?php echo form_close(); ?>
				</div>
				
				
				
				
				
				
				<div class='span6'>
					&nbsp;&nbsp;<strong>Selected</strong><br /><br />
					<?php echo form_open('setup/grantUserSecurityMeasure'); ?>
					<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
					<thead>
						<tr>
							<th class="my_th" rowspan='2' style='vertical-align: middle; text-align: center;' >Username</th>
							<th class="my_th" colspan='3' style='vertical-align: middle; text-align: center;' >Access modifier</th>
							<th class="my_th" rowspan='2' style='vertical-align: middle; text-align: center;' >Remove</th>
						</tr>
						<tr>
							
							<td class="my_th" ><input type='checkbox' id="selecctallview" > &nbsp;Select all</td>
							<td class="my_th" ><input type='checkbox' id="selecctalledit" > &nbsp;Select all</td>
							<td class="my_th" ><input type='checkbox' id="selecctallentry" > &nbsp;Select all</td>
							
						</tr>
					</thead>
					<tbody>
						<?php if(isset($selecteduser)) { foreach($selecteduser as $row) { ?>
						<tr>
							<td><?php print $row['name']; ?></td>
							<td>
								<input type='checkbox' name='view[]' value='<?php print $row['idusers']; ?>' <?php if($row['view']=='1'){print 'checked';} else{} ?> class='checkview' > &nbsp;View &nbsp;&nbsp;
							</td>
							<td>
								<input type='checkbox' name='edit[]' value='<?php print $row['idusers']; ?>' <?php if($row['edit']=='1'){print 'checked';} else{} ?> class='checkedit' > &nbsp;Edit &nbsp;&nbsp;
							</td>
							<td>
								<input type='checkbox' name='entry[]' value='<?php print $row['idusers']; ?>' <?php if($row['entry']=='1'){print 'checked';} else{} ?> class='checkentry' > &nbsp;Entry data &nbsp;
							</td>	
								<input type='hidden' name='iddb' value='<?php print $listmeasure[0]['iddb']; ?>' />
								<input type='hidden' name='idmeasure' value='<?php print $listmeasure[0]['idmeasure']; ?>' />
							</td>	
							<td>
								<a href='#' name='<?php print $listmeasure[0]['iddb']; ?>' id='<?php print $listmeasure[0]['idmeasure']; ?>' hreflang='<?php print $row['idusers']; ?>' class='btn btn-link delsecuritymeasure' >
									<img src="<?php echo base_url().'libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud'>
								</a>
							</td>
						</tr>
						<?php } } ?>
					</tbody>
					</table>
					&nbsp;&nbsp;<button class='btn btn-success' type='submit' >Save</button>
					<?php echo form_close(); ?>
				</div>
				
				
				
				
			</div>
		</div>
	</div>
</div>

