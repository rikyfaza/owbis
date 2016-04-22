<!DOCTYPE html>

<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap -->
		<link href="<?= base_url();?>libs/css/reset.css" rel="stylesheet"/>
		<link href="<?= base_url();?>libs/css/bootstrap.css" rel="stylesheet"/>
		<link href="<?= base_url();?>libs/css/bootstrap-responsive.min.css" rel="stylesheet"/>
		<link href="<?= base_url();?>libs/css/smoothness/jquery.ui.all.css" rel="stylesheet"/>
		
		<link rel="shortcut icon" href="<?php print base_url();?>/libs/img/Actions-office-chart-pie-icon.png" type="image/x-icon" />
		
		<link href="<?= base_url();?>libs/css/base.css" rel="stylesheet"/>
		<link href="<?= base_url();?>libs/css/Spacetree.css" rel="stylesheet"/>
		<link href="<?= base_url();?>libs/css/main.css" rel="stylesheet"/>
		<link href="<?= base_url();?>libs/css/colorpicker.css" rel="stylesheet"/>
			
		<script src="<?php echo base_url();?>libs/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>libs/js/highcharts.js"></script>
		<script src="<?php echo base_url();?>libs/js/amcharts.js"></script>
		<script src="<?php echo base_url();?>libs/js/gauge.js"></script>
		
		<title>Performance Information System</title>
		
	</head>
	
<body class="fbIndex" onload="init();">

	<?php $this->load->view('headernav'); ?>
	
	<div class="row">
		<div style="margin: 70px 40px 0px;">
			<?php $this->load->view($content);?>
		</div>
	</div>
	
	</div><br /><br /><br /><br /><br />
	
	<div class="row footer">
		<?php $this->load->view('footer'); ?>
	</div>
	
	<script> var pilihan='hirarkikpi2'; </script>
	
		<!-- javascript library -->		
		<script src="<?php echo base_url();?>libs/js/jquery.validate.js"></script>
		<script src="<?php echo base_url();?>libs/js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="<?php echo base_url();?>libs/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>libs/js/exporting.js"></script>
		<script src="<?php echo base_url();?>libs/js/FusionCharts.js"></script>
		<script src="<?php echo base_url();?>libs/js/colorpicker.js"></script>
		<script src="<?php echo base_url();?>libs/js/main.js"></script>
		<script src="<?php echo base_url();?>libs/js/jit.js"></script>
		<script src="<?php echo base_url();?>libs/js/xcanvas.compiled.js"></script>
		
	<!-- for online
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
		-->
	<!--
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.js"></script>
	<script src="//cdn.jsdelivr.net/bootstrap/2.3.1/js/bootstrap.min.js"></script>
	-->
	
</body>
</html>
