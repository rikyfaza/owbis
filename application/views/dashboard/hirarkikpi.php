

	
<script src="<?php echo base_url();?>libs/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>libs/js/FusionCharts.js"></script>
<link href="<?= base_url();?>libs/css/smoothness/jquery.ui.all.css" rel="stylesheet"/>	


<script>
	var iddb = '<?php print($_SESSION["dbuserlogged"]); ?>'; 
	var idviewh = '<?php print($idview); ?>'; 
	var idperiodname = '';
	var yearname = '<?php echo $infomonthactive[0]['year']; ?>';
	var st;
	var json;
</script>

<script src="<?php echo base_url();?>libs/js/hirarkikpi.js"></script>	

<script>
$(function() {

	/* onload window get current period then reload st.loadJSON */
	$( window ).load(function() {
		//var d = new Date();
		//var n = d.getMonth(); 
		var pername = '<?php echo $infoview[0]['displayby']; ?>';
		var monthname = "<?php print $infomonthactive[0]['month']; ?>";
		if(monthname=='Jan'){n=0;}else if(monthname=='Feb'){n=1;}else if(monthname=='Mar'){n=2;}else if(monthname=='Apr'){n=3;}else if(monthname=='May'){n=4;}else if(monthname=='Jun'){n=5;}else if(monthname=='Jul'){n=6;}else if(monthname=='Aug'){n=7;}else if(monthname=='Sep'){n=8;}else if(monthname=='Oct'){n=9;}else if(monthname=='Nov'){n=10;}else if(monthname=='Dec'){n=11;}
		

		if((n == '0') && (pername = 'month')){ getJson('Jan', yearname); $("#periodset").val("jan"); }
		else if((n == '1') && (pername = 'month')){ getJson('Feb', yearname); $("#periodset").val("feb"); }
		else if((n == '2') && (pername = 'month')){ getJson('Mar', yearname); $("#periodset").val("mar"); }
		else if((n == '3') && (pername = 'month')){ getJson('Apr', yearname); $("#periodset").val("apr"); }
		else if((n == '4') && (pername = 'month')){ getJson('Mei', yearname); $("#periodset").val("mei"); }
		else if((n == '5') && (pername = 'month')){ getJson('Jun', yearname); $("#periodset").val("jun"); }
		else if((n == '6') && (pername = 'month')){ getJson('Jul', yearname); $("#periodset").val("jul"); }
		else if((n == '7') && (pername = 'month')){ getJson('Aug', yearname); $("#periodset").val("aug"); }
		else if((n == '8') && (pername = 'month')){ getJson('Sep', yearname); $("#periodset").val("sep"); }
		else if((n == '9') && (pername = 'month')){ getJson('Okt', yearname); $("#periodset").val("okt"); }
		else if((n == '10') && (pername = 'month')){ getJson('Nop', yearname); $("#periodset").val("nop"); }
		else if((n == '11') && (pername = 'month')){ getJson('Des', yearname); $("#periodset").val("des"); }
		
		else if( ((n == '0') || (n == '1') || (n == '2')) && (pername = 'quarter')){ getJson('Q1', yearname); $("#periodset").val("Q1"); }
		else if( ((n == '3') || (n == '4') || (n == '5')) && (pername = 'quarter')){ getJson('Q2', yearname); $("#periodset").val("Q2"); }
		else if( ((n == '6') || (n == '7') || (n == '8')) && (pername = 'quarter')){ getJson('Q3', yearname); $("#periodset").val("Q3"); }
		else if( ((n == '9') || (n == '10') || (n == '11')) && (pername = 'quarter')){ getJson('Q4', yearname); $("#periodset").val("Q4"); }
		
		/**
		if((n == '0') && (pername = 'month')){ getJson('Jan'); $("#periodnameforparent").val("jan"); }
		else if((n == '1') && (pername = 'month')){ getJson('Feb'); $("#periodnameforparent").val("feb"); }
		else if((n == '2') && (pername = 'month')){ getJson('Mar'); $("#periodnameforparent").val("mar"); }
		else if((n == '3') && (pername = 'month')){ getJson('Apr'); $("#periodnameforparent").val("apr"); }
		else if((n == '4') && (pername = 'month')){ getJson('Mei');$("#periodnameforparent").val("mei"); }
		else if((n == '5') && (pername = 'month')){ getJson('Jun'); $("#periodnameforparent").val("jun"); }
		else if((n == '6') && (pername = 'month')){ getJson('Jul'); $("#periodnameforparent").val("jul"); }
		else if((n == '7') && (pername = 'month')){ getJson('Aug'); $("#periodnameforparent").val("aug"); }
		else if((n == '8') && (pername = 'month')){ getJson('Sep'); $("#periodnameforparent").val("sep"); }
		else if((n == '9') && (pername = 'month')){ getJson('Okt'); $("#periodnameforparent").val("okt"); }
		else if((n == '10') && (pername = 'month')){ getJson('Nop'); $("#periodnameforparent").val("nop"); }
		else if((n == '11') && (pername = 'month')){ getJson('Des'); $("#periodnameforparent").val("des"); }
		*/
	});
	
	function getJson(idperiodname)
	{
		json = (function () {
			var json = null;
			$.ajax({
				'async': false,
				'global': false,
				'url': '/index.php/maincontroller/gethirarkikpi/'+idviewh+'/'+idperiodname+'/'+yearname,
				//'url': '/performance_is/index.php/maincontroller/gethirarkikpi/'+idviewh+'/'+idperiodname+'/'+yearname,
				'dataType': "json",
				'success': function (data) {
					json = data;
				}
			});
			return json;
		})(); 
		st.loadJSON(json);
		st.refresh();
	}
	
	$('#periodse').change(function() {
		
		//console.log($('#periodse').val());
		/*
		if($('#periodse').val() === 'Jan'){
			<?php $_SESSION['curperiod'] = 'Jan'; ?>
			<?php //print $_SESSION['curperiod'];  ?>
			$('#tes').val("<?php echo $_SESSION['curperiod']; ?>");
		} else if($('#periodse').val() === 'Feb'){
			
			<?php $_SESSION['curperiod'] = 'Feb';?>
			<?php //print $_SESSION['curperiod']; ?>
			$('#tes').val("<?php echo $_SESSION['curperiod']; ?>");
		}
		if($('#periodse').val() == 'Jan'){
			idperiodname = 'Jan';
			init();
		} else if($('#periodse').val() == 'Feb'){
			idperiodname = 'Feb'; 
			init();
		}
		*/
		$("#periodset").val($('#periodse').val());
		
		switch($('#periodse').val())
		{
			case 'Jan' : idperiodname = 'Jan'; getJson(idperiodname); break;
			case 'Feb' : idperiodname = 'Feb'; getJson(idperiodname); break;
			case 'Mar' : idperiodname = 'Mar'; getJson(idperiodname); break;
			case 'Apr' : idperiodname = 'Apr'; getJson(idperiodname); break;
			case 'Mei' : idperiodname = 'Mei'; getJson(idperiodname); break;
			case 'Jun' : idperiodname = 'Jun'; getJson(idperiodname); break;
			case 'Jul' : idperiodname = 'Jul'; getJson(idperiodname); break;
			case 'Aug' : idperiodname = 'Aug'; getJson(idperiodname); break;
			case 'Sep' : idperiodname = 'Sep'; getJson(idperiodname); break;
			case 'Okt' : idperiodname = 'Okt'; getJson(idperiodname); break;
			case 'Nop' : idperiodname = 'Nop'; getJson(idperiodname); break;
			case 'Des' : idperiodname = 'Des'; getJson(idperiodname); break;
			
			case 'Q1' : idperiodname = 'Q1'; getJson(idperiodname); break;
			case 'Q2' : idperiodname = 'Q2'; getJson(idperiodname); break;
			case 'Q3' : idperiodname = 'Q3'; getJson(idperiodname); break;
			case 'Q4' : idperiodname = 'Q4'; getJson(idperiodname); break;
		}
		
    });
});
</script>



<div class="row">

	<div class="span3">
		<div style='text-align: left;float:left;'>
			<h4><?php print($infoview[0]['name']); ?> View</h4>	
			<a href='<?php echo site_url().'/setup/SynchronizeView/'.$idview;?>' class='btn btn-link'><img src="<?php echo base_url().'libs/img/Button-Refresh-icon.png';?>" style='max-width:25px;max-height:25px;' > <strong>Synchronize</strong></a>
		</div>
	</div>
	
	
	<div class="span7"></div>
	
	<div class="span3">
		<input type="radio" id="s-normal" name="selection" checked="checked" value="normal" style="display:none;"/>
		<input type="radio" id="r-top" name="orientation" checked="checked" value="top" style="display:none;"/>
		<div style='text-align: left;float:right;'>
			<select name='periodselect' style='width:90px;' id='periodse'>
				<?php
					
					/* handle display by month and display each month */
					if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Jan')	
					{
						$month = array('Jan');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Jan') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Feb')	
					{
						$month = array('Jan','Feb');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Feb') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Mar')	
					{
						$month = array('Jan','Feb','Mar');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Mar') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Apr')	
					{
						$month = array('Jan','Feb','Mar','Apr');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Apr') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='May')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Mei') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Jun')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Jun') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Jul')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Jul') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Aug')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Aug') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Sep')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Sep') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Oct')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Okt') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Nov')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nop');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Nop') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='month' && $infomonthactive[0]['month']=='Dec')	
					{
						$month = array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nop','Des');
						foreach($month as $k => $v) { ?> <option value='<?php echo $v; ?>' <?php if($v == 'Des') echo 'selected'; ?> ><?php echo $v.' '.$infomonthactive[0]['year']; ?></option> <?php }
					}
					

					
					else if($infoview[0]['displayby']=='quarter' && ($infomonthactive[0]['month']=='Jan' || $infomonthactive[0]['month']=='Feb' || $infomonthactive[0]['month']=='Mar'))
					{
						$quarter = array('Q1');
						foreach($quarter as $k => $v){ ?> <option value='<?php echo $v; ?>' <?php if($v == 'Q1') echo 'selected'; ?> ><?php echo $infomonthactive[0]['year'].'/'.$v; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='quarter' && ($infomonthactive[0]['month']=='Apr' || $infomonthactive[0]['month']=='Mar' || $infomonthactive[0]['month']=='Jun'))
					{
						$quarter = array('Q1','Q2');
						foreach($quarter as $k => $v){ ?> <option value='<?php echo $v; ?>' <?php if($v == 'Q2') echo 'selected'; ?> ><?php echo $infomonthactive[0]['year'].'/'.$v; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='quarter' && ($infomonthactive[0]['month']=='Jul' || $infomonthactive[0]['month']=='Aug' || $infomonthactive[0]['month']=='Sep'))
					{
						$quarter = array('Q1','Q2','Q3');
						foreach($quarter as $k => $v){ ?> <option value='<?php echo $v; ?>' <?php if($v == 'Q3') echo 'selected'; ?> ><?php echo $infomonthactive[0]['year'].'/'.$v; ?></option> <?php }
					}
					else if($infoview[0]['displayby']=='quarter' && ($infomonthactive[0]['month']=='Oct' || $infomonthactive[0]['month']=='Nov' || $infomonthactive[0]['month']=='Dec'))
					{
						$quarter = array('Q1','Q2','Q3','Q4');
						foreach($quarter as $k => $v){ ?> <option value='<?php echo $v; ?>' <?php if($v == 'Q4') echo 'selected'; ?> ><?php echo $infomonthactive[0]['year'].'/'.$v; ?></option> <?php }
					}

					   
					else if($infoview[0]['displayby']=='week')
					{
						$monthz = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
						$week = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');

						foreach ($monthz as $key => $value) {
							if($value=='Jan'){
								for($i=0;$i<=3;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Feb'){
								for($i=4;$i<=7;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Mar'){
								for($i=8;$i<=12;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Apr'){
								for($i=13;$i<=16;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='May'){
								for($i=17;$i<=20;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Jun'){
								for($i=21;$i<=25;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Jul'){
								for($i=26;$i<=29;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Aug'){
								for($i=30;$i<=33;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Sep'){
								for($i=34;$i<=38;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Oct'){
								for($i=39;$i<=42;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Nov'){
								for($i=43;$i<=46;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
							else if($value=='Dec'){
								for($i=47;$i<=51;$i++){?> <option value='<?php echo $week[$i]; ?>'><?php echo $infomonthactive[0]['year'].'/'.$week[$i]; ?></option> <?php }
							}
						}

						/*
						$week = array('W01','W02','W03','W04','W05','W06','W07','W08','W09','W10','W11','W12','W13','W14','W15','W16','W17','W18','W19','W20','W21','W22','W23','W24','W25','W26','W27','W28','W29','W30','W31','W32','W33','W34','W35','W36','W37','W38','W39','W40','W41','W42','W43','W44','W45','W46','W47','W48','W49','W50','W51','W52');
						foreach($week as $k => $v)
						{
						?>
						<option value='<?php echo $v; ?>'><?php echo date('Y').'/'.$v; ?></option>
						<?php
						}
						*/
					}
				?>
			</select>
			
			
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div id="infovis" class="canvasjit" style='overflow-x:auto;overflow-y:hidden;' ></div>
	<div>
</div>
<!--
<div class="row">
	<div class="span12">
		<div style='overflow-x:auto;overflow-y:hidden' class='divpost'>
			<div id="infovis" class="canvasjit" > </div>
		<div>
	<div>
</div>
-->	
<div id="periodmonth" title="Data Entry Month" style='display:none;font-size:10px;'>
	<?php $this->load->view('dashboard/formperiodmonth'); ?>
</div>

<div id="periodquarter" title="Data Entry Quarter" style='display:none;font-size:10px;'>
	<?php $this->load->view('dashboard/formperiodquarter'); ?>
</div>

<div id="periodweek" title="Data Entry Week" style='display:none;font-size:10px;'>
	<?php $this->load->view('dashboard/formperiodweek'); ?>
</div>
