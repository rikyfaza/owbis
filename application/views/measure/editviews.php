<div class="divall form-olahdata" style='text-align:left'>

	<h5 style='border-bottom:1px solid #3B5998;'>Edit View</h5>
	
	<?php
		echo form_open('setup/proseseditviews', array('id'=>'createviewform','class'=>'cmxform'));
	?>
	
	<div id="createviews">
		<h5>Name</h5>
		<div>
			<p>
				<label class="control-label">Name</label>
				<input type='text' name='viewname' placeholder='view name' class='input-xxlarge' value='<?php echo $listViews[0]['name']; ?>' />
				<label class="control-label">Description</label>
				<textarea rows='4' class='input-xxlarge' placeholder='view description' name='viewdescription'><?php echo $listViews[0]['description']; ?></textarea>
				<label class="control-label">Categories</label>
				<textarea rows='4' class='input-xxlarge' placeholder='view categories' name='viewcategories'><?php echo $listViews[0]['categories']; ?></textarea>
			</p>
		</div>
		<h5>Title</h5>
		<div>
			<p>
				<label class="control-label">Title</label>
				<input type='text' name='viewtitle' placeholder='title' class='input-xxlarge' value='<?php echo $listViews[0]['title']; ?>'  />
				<label class="control-label">Subtitle</label>
				<input type='text' name='viewsubtitle' placeholder='subtitle' class='input-xxlarge' value='<?php echo $listViews[0]['subtitle']; ?>' />
			</p>
		</div>
		<h5>View</h5>
		<div>
			<p>
				<label class="control-label">Top Measure</label>
				<select class='input-xxlarge' name='topmeasure'>
					<option><none></option>
					<?php foreach($parentmeasure as $row){ ?>
						<option value='<?php echo $row['idmeasure']; ?>' <?php if( $listViews[0]['topmeasure']==$row['idmeasure']) { echo 'selected'; } else {} ?> ><?php echo $row['name']; ?></option>
					<?php } ?>
				</select>
				<label class="control-label">Top Location</label>
				<select class='input-xxlarge' name='toplocation'>
					<option><none></option>
					<?php foreach($parentlocations as $row){ ?>
						<option value='<?php echo $row['idlocation']; ?>' <?php if( $listViews[0]['toplocation']==$row['idlocation']) { echo 'selected'; } else {} ?> ><?php echo $row['name']; ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<fieldset>
					<label class="control-label">Display by</label>
					<select class='input-xxlarge' name='displayby'>
						<option value='month' <?php if( $listViews[0]['displayby']=='month') { echo 'selected'; } else {} ?> >Month</option>
						<option value='quarter' <?php if( $listViews[0]['displayby']=='quarter') { echo 'selected'; } else {} ?> >Quarter</option>
						<option value='week' <?php if( $listViews[0]['displayby']=='week') { echo 'selected'; } else {} ?> >Week</option>
						<option value='year' <?php if( $listViews[0]['displayby']=='year') { echo 'selected'; } else {} ?> >Year</option>
					</select>
				</fieldset>
			</p>
		</div>
	</div>	
	
	<input type='hidden' name='idview' value='<?php echo  $listViews[0]['idview']; ?>' />
	<br />
	
	<div class='errorm' style='display:none'><h5>Form Validation Message</h5></div><br />
	
	<button class="btn btn-primary" type="submit">Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupviews';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
	
	<?php  
		echo form_close();
	?>
	
</div>