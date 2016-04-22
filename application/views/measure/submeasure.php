<?php $i = 1; ?>
<script src="<?php echo base_url();?>libs/js/jquery.min.js"></script>

<div class="divall form-olahdata" style='text-align:left'>

	<?php 
		if($terdaftardiview[0]['jmlmeasure'] < 1)
		{ ?>
			<h6><?php print($measurename[0]['name'])?> has not been registered to any views.</h6>
			<a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" class="btn btn-primary" type="button">Back</a>
		<?php
			exit;
		}
	?>
	
	<h4 style='border-bottom:1px solid #3B5998;'>Submeasures from "<?php print($measurename[0]['name'])?>"</h4>
	<div class="row divleft">
	
		<?php
			echo form_open('setup/savesubmeasure');
		?>
			
			<?php if ($jmllistview[0]['jml'] > 0) { ?>
				<div class="span12 availableview">
					<h6><?php print($measurename[0]['name'])?> is available at this/these views. Please select one!</h6>
					<?php foreach($listview as $row) { ?>
						<input type='radio' name='listview' value='<?php echo $row['idview']; ?>'> <?php echo $row['name']; ?> &nbsp;
					<?php } ?>
				</div>
			<?php } ?>
			
			<div class="span4 contentsubmeasure">
				<h6 style='border-bottom:1px solid #000;width:90%'>Available</h6>
				<?php foreach($listmeasure as $row){ ?>
					<input type='checkbox' name='checksubmeasure[]' value='<?php echo $row['idmeasure']; ?>'> &nbsp;<?php echo $row['name']; ?><br />
				<?php } ?>
				<input type='hidden' name='parentmeasure' value='<?php print($parentmeasure); ?>' />
				<input type='hidden' name='idviewparent' value='<?php print($idview[0]['idview']); ?>' />
				
				<br /><br />
				<button class="btn btn-primary" type="submit">Add</button>&nbsp;&nbsp;
			</div>
		
		<?php  
			echo form_close();
		?>
		
		<div class="span4 contentsubmeasure">
		<h6 style='border-bottom:1px solid #000;width:90%'>Selected</h6>
			
			<?php
				echo form_open('setup/savesubmeasureweight');
				
				if ($this->session->flashdata('Error'))
				{
					echo "<div class='alert alert-error'>";
					echo $this->session->flashdata('Error');
					echo "</div>";
				}
			?>
					
				<table>
					<?php 
					
					//print (count($submeasurediweight));
					foreach($submeasurediweight as $datasub){?>
						<tr>
							<td><?php echo $datasub['name']; ?></td>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<input type='text' name='<?=$i;?>' style='width:40px' placeholder='null' value='<?php echo $datasub['weight']; ?>' id='w<?=$i;?>'/> % 
								<input type='hidden' name='measureweight[]' value='<?php echo $datasub['idmeasure']; ?>' />
							</td>
							
							<td>&nbsp;
							
							<a href='#' name='<?php print($idview[0]['idview']); ?>' id='<?php echo $datasub['idmeasure']; ?>' rel='<?php print($parentmeasure); ?>' class='btn btn-link delsubmeasure' ><img src="<?php echo base_url().'libs/img/Actions-edit-delete-icon.png';?>" class='iconimgcrud'></a>
						
							</td>
						</tr>
					<?php $i++; } ?>
					
					<br /><br />
				</table>
				
				<br />
				Sum of weight : <input type='text' id='jmlw' style='width:35px' disabled/>%
				<br /><label id='ketr' style='font-weight:bold;color:red'></label><br />
				
				<input type='hidden' name='parentmeasure' value='<?php print($parentmeasure); ?>' />
				<button class="btn btn-primary" id='distribute' >Distribute</button>&nbsp;&nbsp;
				
				<button class="btn btn-primary" type="submit" id='idsave' >Save</button>&nbsp;&nbsp;
				
			<?php  
				echo form_close();
			?>
			
		</div>
		
		</button>&nbsp;&nbsp;
		
		<script>
		$(function() {
			var ii = <?php echo $i; ?>;
			
			$("#idsave").click(function(){
				var jml = 0;
				
				for (var x = 1; x < ii; x++) {
					if( $("#w"+x).val().length == 0  ) {
						$("#w"+x).val("");
					} else {
						jml += parseInt($("#w"+x).val());
					}
				}
				
				$("#jmlw").val(jml);
				
				if(jml < 100 || jml > 100) {
					$("#jmlw").val(jml);
					$("#ketr").text("Sum of weight shall be 100%");
				//	$("#namaRangkaianKegiatan").val("Identifikasi");
					//alert("Sum of weight shall be 100%");
					return false;
				}
			});
			
			
			/* handle distribute weight sama rata */
			$("#distribute").click(function(){	
				var jmlrecord = <?php print (count($submeasurediweight)); ?>;
				var weighteach = 100 / parseInt(jmlrecord)	;
				for (var x = 1; x < ii; x++) {
					$("#w"+x).val(weighteach);
				}
			});
		});
		</script>

	</div>
	
	<br /><br />
	<a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" class="btn btn-primary" type="button">Back</a>
	
</div>
