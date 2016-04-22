<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Synchronizing Database</h4>
	<br /><br />
	
	<table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
	<thead>
		<tr>
			<th class="my_th">Synchronize</th>
			<th class="my_th">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php echo form_open('setup/savesinkronisasi'); ?>
		<tr>
			<td>From &nbsp;<input type='text' name='awal' class='input-small' placeholder='start year' />&nbsp; to &nbsp;<input type='text' name='akhir' class='input-small' placeholder='end year' />&nbsp;</td>
			<td>&nbsp;&nbsp;<button class="btn btn-primary" type="submit" >Synchronize</button>&nbsp;&nbsp;</td>
		</tr>
		<?php echo form_close(); ?>
	</tbody>
	</table>
</div>