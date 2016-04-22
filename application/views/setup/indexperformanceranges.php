<script src="<?php echo base_url();?>libs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>libs/js/colorpicker.js"></script>
<script>
$().ready(function() {
	$('#colorSelector5').css('backgroundColor', '<?php if(isset($dataranges[0]["colors5"])) echo $dataranges[0]["colors5"]; ?>');
	$('#colorSelector4').css('backgroundColor', '<?php if(isset($dataranges[0]["colors4"])) echo $dataranges[0]["colors4"]; ?>');
	$('#colorSelector3').css('backgroundColor', '<?php if(isset($dataranges[0]["colors3"])) echo $dataranges[0]["colors3"]; ?>');
	$('#colorSelector2').css('backgroundColor', '<?php if(isset($dataranges[0]["colors2"])) echo $dataranges[0]["colors2"]; ?>');
	$('#colorSelector1').css('backgroundColor', '<?php if(isset($dataranges[0]["colors1"])) echo $dataranges[0]["colors1"]; ?>');

	$('input#colorSelector5').ColorPicker({
		//color: '#0dff00',
		color: '<?php  if(isset($dataranges[0]["colors5"])) echo $dataranges[0]["colors5"]; ?>',
		onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;},
		onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;},
		onChange: function (hsb, hex, rgb) {$('#colorSelector5').css('backgroundColor', '#' + hex);$('#warna5').val('#' + hex);}
	});
	
	$('input#colorSelector4').ColorPicker({
		//color: '#0000ff',
		color: '<?php  if(isset($dataranges[0]["colors4"])) echo $dataranges[0]["colors4"]; ?>',
		onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;},
		onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;},
		onChange: function (hsb, hex, rgb) {$('#colorSelector4').css('backgroundColor', '#' + hex);$('#warna4').val('#' + hex);}
	});

	$('input#colorSelector3').ColorPicker({
		//color: '#0000ff',
		color: '<?php  if(isset($dataranges[0]["colors3"])) echo $dataranges[0]["colors3"]; ?>',
		onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;},
		onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;},
		onChange: function (hsb, hex, rgb) {$('#colorSelector3').css('backgroundColor', '#' + hex);$('#warna3').val('#' + hex);}
	});

	$('input#colorSelector2').ColorPicker({
		//color: '#0000ff',
		color: '<?php  if(isset($dataranges[0]["colors2"])) echo $dataranges[0]["colors2"]; ?>',
		onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;},
		onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;},
		onChange: function (hsb, hex, rgb) {$('#colorSelector2').css('backgroundColor', '#' + hex);$('#warna2').val('#' + hex);}
	});

	$('input#colorSelector1').ColorPicker({
		//color: '#0000ff',
		color: '<?php  if(isset($dataranges[0]["colors1"])) echo $dataranges[0]["colors1"]; ?>',
		onShow: function (colpkr) {$(colpkr).fadeIn(500);return false;},
		onHide: function (colpkr) {$(colpkr).fadeOut(500);return false;},
		onChange: function (hsb, hex, rgb) {$('#colorSelector1').css('backgroundColor', '#' + hex);$('#warna1').val('#' + hex);}
	});
});
</script>


<div class="divall form-olahdata" style='text-align:left'>

	<h4 style='border-bottom:1px solid #3B5998;'>Performance Ranges</h4>
	
	<?php
		echo form_open('setup/saveranges', array('id'=>'createmeasureform','class'=>"cmxform"));
	?>
	<h5>Index Ranges</h5>
	<br />
		<table>
			<tr>
				<td colspan='4'><strong>Index range 5</strong></td>
			</tr>
			<tr>
				<td>Begins at <input type='text' name='begins5' id='begins5' class='input-small' value='<?php if(isset($dataranges[0]['valuebottom5'])) echo $dataranges[0]['valuebottom5']; ?>' />&nbsp;&nbsp;</td>
				<td>Ends at <input type='text' name='ends5' id='ends5' class='input-small' value='<?php if(isset($dataranges[0]['valuetop5'])) echo $dataranges[0]['valuetop5']; ?>' />&nbsp;&nbsp;</td>
				<td>Color <input type='text' id='colorSelector5' size='3' maxlength='3' style='width:35px;'>&nbsp;&nbsp;<input type='hidden' id='warna5'  style='width:55px;' name='colors5' value='<?php if(isset($dataranges[0]['colors5'])) echo $dataranges[0]['colors5']; ?>' />&nbsp;&nbsp;</td>
				<td>Identifier <input type='text' name='identifier5' class='input-medium' value='<?php if(isset($dataranges[0]['namerange5'])) echo $dataranges[0]['namerange5']; ?>' />&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td colspan='4'>&nbsp;</td>
			</tr>

			<tr>
				<td colspan='4'><strong>Index range 4</strong></td>
			</tr>
			<tr>
				<td>Begins at <input type='text' name='begins4' id='begins4' class='input-small' value='<?php if(isset($dataranges[0]['valuebottom4'])) echo $dataranges[0]['valuebottom4']; ?>' />&nbsp;&nbsp;</td>
				<td>Ends at <input type='text' name='ends4' id='ends4' class='input-small' value='<?php if(isset($dataranges[0]['valuetop4'])) echo $dataranges[0]['valuetop4']; ?>' readonly />&nbsp;&nbsp;</td>
				<td>Color <input type='text' id='colorSelector4' size='3' maxlength='3' style='width:35px;'>&nbsp;&nbsp;<input type='hidden' id='warna4'  style='width:55px;' name='colors4' value='<?php if(isset($dataranges[0]['colors4'])) echo $dataranges[0]['colors4']; ?>' />&nbsp;&nbsp;</td>
				<td>Identifier <input type='text' name='identifier4' class='input-medium' value='<?php if(isset($dataranges[0]['namerange4'])) echo $dataranges[0]['namerange4']; ?>' />&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td colspan='4'>&nbsp;</td>
			</tr>

			<tr>
				<td colspan='4'><strong>Index range 3</strong></td>
			</tr>
			<tr>
				<td>Begins at <input type='text' name='begins3' id='begins3' class='input-small' value='<?php if(isset($dataranges[0]['valuebottom3'])) echo $dataranges[0]['valuebottom3']; ?>' />&nbsp;&nbsp;</td>
				<td>Ends at <input type='text' name='ends3' id='ends3' class='input-small' value='<?php if(isset($dataranges[0]['valuetop3'])) echo $dataranges[0]['valuetop3']; ?>' readonly />&nbsp;&nbsp;</td>
				<td>Color <input type='text' id='colorSelector3' size='3' maxlength='3' style='width:35px;'>&nbsp;&nbsp;<input type='hidden' id='warna3'  style='width:55px;' name='colors3' value='<?php if(isset($dataranges[0]['colors3'])) echo $dataranges[0]['colors3']; ?>' />&nbsp;&nbsp;</td>
				<td>Identifier <input type='text' name='identifier3' class='input-medium' value='<?php if(isset($dataranges[0]['namerange3'])) echo $dataranges[0]['namerange3']; ?>'>&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td colspan='4'>&nbsp;</td>
			</tr>

			<tr>
				<td colspan='4'><strong>Index range 2</strong></td>
			</tr>
			<tr>
				<td>Begins at <input type='text' name='begins2' id='begins2' class='input-small' value='<?php if(isset($dataranges[0]['valuebottom2'])) echo $dataranges[0]['valuebottom2']; ?>' />&nbsp;&nbsp;</td>
				<td>Ends at <input type='text' name='ends2' id='ends2' class='input-small' value='<?php if(isset($dataranges[0]['valuetop2'])) echo $dataranges[0]['valuetop2']; ?>' readonly />&nbsp;&nbsp;</td>
				<td>Color <input type='text' id='colorSelector2' size='3' maxlength='3' style='width:35px;'>&nbsp;&nbsp;<input type='hidden' id='warna2'  style='width:55px;' name='colors2' value='<?php if(isset($dataranges[0]['colors2'])) echo $dataranges[0]['colors2']; ?>' />&nbsp;&nbsp;</td>
				<td>Identifier <input type='text' name='identifier2' class='input-medium' value='<?php if(isset($dataranges[0]['namerange2'])) echo $dataranges[0]['namerange2']; ?>' />&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td colspan='4'>&nbsp;</td>
			</tr>

			<tr>
				<td colspan='4'><strong>Index range 1</strong></td>
			</tr>
			<tr>
				<td>Begins at <input type='text' name='begins1' id='begins1' class='input-small' value='<?php if(isset($dataranges[0]['valuebottom1'])) echo $dataranges[0]['valuebottom1']; ?>' />&nbsp;&nbsp;</td>
				<td>Ends at <input type='text' name='ends1' id='ends1' class='input-small' value='<?php if(isset($dataranges[0]['valuetop1'])) echo $dataranges[0]['valuetop1']; ?>' readonly />&nbsp;&nbsp;</td>
				<td>Color <input type='text' id='colorSelector1' size='3' maxlength='3' style='width:35px;'>&nbsp;&nbsp;<input type='hidden' id='warna1'  style='width:55px;' name='colors1' value='<?php if(isset($dataranges[0]['colors1'])) echo $dataranges[0]['colors1']; ?>' />&nbsp;&nbsp;</td>
				<td>Identifier <input type='text' name='identifier1' class='input-medium' value='<?php if(isset($dataranges[0]['namerange1'])) echo $dataranges[0]['namerange1']; ?>' />&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td colspan='4'>&nbsp;</td>
			</tr>
		</table>
	
		<button class="btn btn-primary" type="submit">Save</button>

	<?php  
		echo form_close();
	?>
	
</div>
