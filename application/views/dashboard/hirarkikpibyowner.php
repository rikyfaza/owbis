<script src="<?php echo base_url();?>libs/js/hirarkibyowner.js"></script>

<input type="radio" id="s-normal" name="selection" checked="checked" value="normal" style="display:none;"/>
<input type="radio" id="r-top" name="orientation" checked="checked" value="top" style="display:none;"/>

<div style='text-align: left;border-bottom: 1px solid #ddd;'>
	<h4>Hirarki KPI by Owner</h4>
</div>

<div id="infovisowner" class="canvasjit">
 	<div id="infovisowner-canvaswidget" style="position:relative;">
 	<canvas id="infovisowner-canvas" width=900 height=600
		style="position:fixed; top:-200px; left:0; width:900px; height:600px;" />
 	
 	</div>
 </div>
