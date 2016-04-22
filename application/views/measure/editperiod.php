<div class="divall form-olahdata" style='text-align:left;'>
<div class="row" style='margin-left:20px;'>

	<h5 style='border-bottom:1px solid #3B5998;'>Edit Period</h5>
	
	<div class="span2">
	<?php
		echo form_open('setup/proseseditperiod', array('id'=>'editperiod','class'=>"cmxform"));
	?>
		<p>
			<label class="control-label"><strong>Month</strong></label>
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Jan' <?php if($activeperiod[0]['month']=='Jan'){ echo 'checked';} ?> > January <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Feb' <?php if($activeperiod[0]['month']=='Feb'){ echo 'checked';} ?>> February <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Mar' <?php if($activeperiod[0]['month']=='Mar'){ echo 'checked';} ?>> March <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Apr' <?php if($activeperiod[0]['month']=='Apr'){ echo 'checked';} ?>> April <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='May' <?php if($activeperiod[0]['month']=='May'){ echo 'checked';} ?>> May <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Jun' <?php if($activeperiod[0]['month']=='Jun'){ echo 'checked';} ?>> June <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Jul' <?php if($activeperiod[0]['month']=='Jul'){ echo 'checked';} ?>> July <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Aug' <?php if($activeperiod[0]['month']=='Aug'){ echo 'checked';} ?>> August <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Sep' <?php if($activeperiod[0]['month']=='Sep'){ echo 'checked';} ?>> September <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Oct' <?php if($activeperiod[0]['month']=='Nov'){ echo 'checked';} ?>> October <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Nov' <?php if($activeperiod[0]['month']=='Oct'){ echo 'checked';} ?>> November <br /><br />
			&nbsp;&nbsp;<input type='radio' name='monthperiod' value='Dec' <?php if($activeperiod[0]['month']=='Dec'){ echo 'checked';} ?>> December
		</p>
	</div>
	<div class="span2">
		<p>
			<label class="control-label"><strong>Year</strong></label>
			<?php 
				$start = $starttoend[0]['startyear']; 
				$end = $starttoend[0]['endyear']; 
				
				for($i=$start; $i<=$end;$i++) { ?>
				&nbsp;&nbsp;<input type='radio' name='yearperiod' value='<?=$i?>' <?php if($activeperiod[0]['year']==$i){ echo 'checked';} ?> > <?=$i?> <br /><br />
				
			<?php } ?>
		</p>
		<input type='hidden' value='<?php echo $activeperiod[0]['idperiod']; ?>' name='idperiod' />

		<br />
		
		
	
	</div>
		
</div>
<div class="row" style='margin-left:20px;'>
	<button class="btn btn-primary" type="submit">Save</button>&nbsp;&nbsp;
	<a href="<?php echo site_url().'/maincontroller/setupperiod';?>" class="btn btn-primary" >Back</a>&nbsp;&nbsp;
</div>
</div>
<?php echo form_close(); ?>		