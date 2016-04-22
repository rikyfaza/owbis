<div class="divall form-olahdata" style='text-align:left'>
	<h4 style='border-bottom:1px solid #3B5998;'><?php print($infoview[0]['name']); ?> Dashboard</h4>
</div>

<script type="text/javascript">


$(function () {
    
	$('#container2').highcharts({
        title: {
            text: '<?php print $measurechart[0]["name"]; ?> Monitoring',
			
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%'
        },
        
        series: [{
            name: 'Actual',
            data: [<?php foreach($measurechart as $row){print $row['actual'].',';}?>]
        }, {
            name: 'Target',
            data: [<?php foreach($measurechart as $row){print $row['target'].',';}?>]
        }, {
            name: 'Actual vs Target',
            data: [<?php foreach($measurechart as $row){print $row['actualvstarget'].',';}?>]
        },
		<?php
			if(!empty($series1exists)){
		?>
		{
            name: '<?php print $series1exists[0]["name"]; ?>',
            data: [<?php foreach($measurechart as $row){print $row['series1'].',';}?>]
        },
		<?php }?>
		<?php
			if(!empty($series2exists)){
		?>
		{
            name: '<?php print $series2exists[0]["name"]; ?>',
            data: [<?php foreach($measurechart as $row){print $row['series2'].',';}?>]
        }
		<?php }?>
		]
    });
	
	
	/* chart akumulasi */
	$('#container2akumulasi').highcharts({
        title: {
            text: '<?php if(!empty($measurechartakumulasi)){print $measurechartakumulasi[0]["name"];} ?> Monitoring Accumulation',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%'
        },
        
        series: [{
            name: 'Actual',
            data: [<?php if(!empty($measurechartakumulasi)){foreach($measurechartakumulasi as $row){print $row['actual'].',';}}?>]
        }, {
            name: 'Target',
            data: [<?php if(!empty($measurechartakumulasi)){foreach($measurechartakumulasi as $row){print $row['target'].',';}}?>]
        }, {
            name: 'Actual vs Target',
            data: [<?php if(!empty($measurechartakumulasi)){foreach($measurechartakumulasi as $row){print $row['actualvstarget'].',';}}?>]
        },
		<?php
			if(!empty($series1exists)){
		?>
		{
            name: '<?php print $series1exists[0]["name"]; ?>',
            data: [<?php foreach($measurechartakumulasi as $row){print $row['series1'].',';}?>]
        },
		<?php }?>
		<?php
			if(!empty($series2exists)){
		?>
		{
            name: '<?php print $series2exists[0]["name"]; ?>',
            data: [<?php foreach($measurechartakumulasi as $row){print $row['series2'].',';}?>]
        }
		<?php }?>
		]
    });
	
	
	
	$('#container3').highcharts({
        title: {
            text: '<?php print $measurechart[0]["name"]; ?> Performance',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%'
        },
        
        series: [{
            name: 'Actual vs Target',
            data: [<?php foreach($measurechart as $row){print $row['actualvstarget'].',';}?>]
        }, {
            name: 'Actual vs Last Year',
            data: [<?php foreach($measurechart as $row){print $row['actualvslastyear'].',';}?>]
        }]
    });
	
	
	/* chart akumulasi */
	$('#container3akumulasi').highcharts({
        title: {
            text: '<?php if(!empty($measurechartakumulasi)){print $measurechartakumulasi[0]["name"];} ?> Performance Accumulation',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '%'
        },
        
        series: [{
            name: 'Actual vs Target',
            data: [<?php if(!empty($measurechartakumulasi)){foreach($measurechartakumulasi as $row){print $row['actualvstarget'].',';}}?>]
        }, {
            name: 'Actual vs Last Year',
            data: [<?php if(!empty($measurechartakumulasi)){foreach($measurechartakumulasi as $row){print $row['actualvslastyear'].',';}}?>]
        }]
    });
	
	
	////// meter gauge chart
	var chart;
	var chart2;
	var chart3;
	var arrow;
	var arrow2;
	var arrow3;
	var axis;
	var valactual = <?php if(!empty($measurechart)){print $measurechart[$num['num']]['index']; } ?>;
	var valtarget = <?php if(!empty($measurechart)){print $measurechart[$num['num']]['target']; } ?>;
	var valactuallastyear = <?php if(!empty($measurechart)){print $measurechart[$num['num']]['actuallastyear']; } ?>;
		
	AmCharts.ready(function () {
		// create angular gauge
		chart = new AmCharts.AmAngularGauge();
		chart.addTitle("Index");

		chart2 = new AmCharts.AmAngularGauge();
		chart2.addTitle("Target");
		
		chart3 = new AmCharts.AmAngularGauge();
		chart3.addTitle("Actual Last Year");
		
		// create axis
		axis = new AmCharts.GaugeAxis();
		axis.startValue = 0;
		axis.axisThickness = 1;
		axis.valueInterval = 10;
		axis.endValue = 150;
		// color bands
		var band1 = new AmCharts.GaugeBand();
		band1.startValue = 0;
		band1.endValue = 80;
		band1.color = "#ea3838";

		var band2 = new AmCharts.GaugeBand();
		band2.startValue = 80;
		band2.endValue = 120;
		band2.color = "#ffac29";

		var band3 = new AmCharts.GaugeBand();
		band3.startValue = 120;
		band3.endValue = 150;
		band3.color = "#00CC00";
		band3.innerRadius = "95%";

		axis.bands = [band1, band2, band3];

		// bottom text
		axis.bottomTextYOffset = -20;
		//axis.setBottomText("%");
		chart.addAxis(axis);
		chart2.addAxis(axis);
		chart3.addAxis(axis);

		// gauge arrow
		arrow = new AmCharts.GaugeArrow();
		arrow2 = new AmCharts.GaugeArrow();
		arrow3 = new AmCharts.GaugeArrow();
		chart.addArrow(arrow);
		chart2.addArrow(arrow2);
		chart3.addArrow(arrow3);

		chart.write("chartdivactual");
		chart2.write("chartdivtarget");
		chart3.write("chartdivlastyear");
		// change value every 2 seconds
	  //  setInterval(randomValue, 2000);
		
		arrow.setValue(parseInt(valactual));
		arrow2.setValue(parseInt(valtarget));
		arrow3.setValue(parseInt(valactuallastyear));
	});

            
});

</script>	
<br />

<div class="row"  style="width:100%; margin:0 auto;text-align:left">
	
	<div class='' style='padding-left:30px'> 
		<?php echo form_open('chart/refreshData', array('id'=>'refreshmeaure')); ?>
			<label><strong>Please select measure name</strong></label>
			<select class='input-xxlarge' name='listmeasure' onchange='this.form.submit()' >
			<option><none></option>
			<?php foreach($listmeasure as $row) { ?>
				<option value='<?php print $row['idmeasure']; ?>' ><?php print $row['name']; ?></option>
			<?php } ?>
			</select>
			<input type='hidden' name='idview' value='<?php print $this->uri->segment(3); ?>' />
		<?php echo form_close(); ?>
		
		<input type='checkbox' name='akumulasi' id='akumulasi' /> <strong>Based on accumulations</strong> <br /><br />
		
	</div>
	
	<div class="span4" id='con11'>
		<div style='border:1px solid #3b5998;padding:5px;'>
			<div id="container2" style="max-width: 100%; height: 250px; margin: 0 auto;"></div>
		
		</div><br />
		
		<!--
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer2' >
			<tr>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actual']; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Target</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['target']; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual Last Year</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actuallastyear']; ?>
				</td>
				<?php } ?>
			</tr>
			<?php
				if(!empty($series1exists)){
			?>
			<tr>
				<td><?php print $series1exists[0]['name']; ?></td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['series1']; ?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php
				if(!empty($series2exists)){
			?>
			<tr>
				<td><?php print $series2exists[0]['name']; ?></td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['series2']; ?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
		-->		
	</div>
	
	
	
	<div class="span4" id='con12' style='display:none'>
		<div style='border:1px solid #3b5998;padding:5px;'>
		
			<div id="container2akumulasi" style="width: 350px; height: 250px; margin: 0 auto;"></div>
		</div><br />
		
		<!--
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer2akumulasi' >
			<tr>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actual']; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Target</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['target']; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual Last Year</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actuallastyear']; ?>
				</td>
				<?php } ?>
			</tr>
		</table>
		-->
	</div>
	
	
	
	
	<div class="span4" id='con21'>
		<div style='border:1px solid #3b5998;padding:5px;'>
			<div id="container3" style="max-width: 100%; height: 250px; margin: 0 auto"></div>
			
		</div><br />

		<!--
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer3' >
			<tr>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual vs Target</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actualvstarget'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual vs Last Year</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actualvslastyear'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			
		</table>
		-->
	</div>
	
	
	<div class="span4" id='con22' style='display:none'>
		<div style='border:1px solid #3b5998;padding:5px;'>
			<div id="container3akumulasi" style="width: 350px; height: 250px; margin: 0 auto;"></div>
		</div><br />
				
		<!--
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer3akumulasi' >
			<tr>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual vs Target</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actualvstarget'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual vs Last Year</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actualvslastyear'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			
		</table>
		-->
	</div>
	
	<div class="span4" id='con15' >
		<div style='border:1px solid #3b5998;padding:5px;height: 250px;width:300px;'>
			<div id="chartdivactual" class="span3" style="width:270px; height:250px;"></div>
			<!--
			<div id="chartdivtarget" class="span3" style="width:300px; height:280px;"></div>
			<div id="chartdivlastyear" class="span3" style="width:300px; height:280px;"></div>
			-->
		</div><br /><br />
	</div>
	
	
	
	
	<div class="span12" id='con111'>
		
		<strong>
		<?php 
			if(!empty($measurechart)){
				print $measurechart[0]["name"]; 
			}
		?> Monitoring<br/><br/>
		</strong>
		
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer2' >
			<tr style='font-weight:bold;'>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print number_format($row['actual']); ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Target</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print number_format($row['target']); ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual vs Target</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actualvstarget'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			<?php
				if(!empty($series1exists)){
			?>
			<tr>
				<td><?php print $series1exists[0]['name']; ?></td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['series1']; ?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
			<?php
				if(!empty($series2exists)){
			?>
			<tr>
				<td><?php print $series2exists[0]['name']; ?></td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['series2']; ?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
				
	</div>

	
	<div class="span12" id='con122' style='display:none'>
		
		<strong>
		<?php if(!empty($measurechartakumulasi)){print $measurechartakumulasi[0]["name"];} ?> Monitoring Accumulation <br/><br/>
		</strong>
		
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer2akumulasi' >
			<tr style='font-weight:bold;'>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print number_format($row['actual']); ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Target</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print number_format($row['target']); ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual vs Target</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actualvstarget'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
		</table>
		
	</div>
	
	
	
	<div class="span12" id='con211'>
		
		<strong>
		<?php 
			if(!empty($measurechart)){
				print $measurechart[0]["name"]; 
			}
		?> Performance<br/><br/>
		</strong>
		
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer3' >
			<tr style='font-weight:bold;'>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual vs Target</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actualvstarget'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual vs Last Year</td>
				<?php foreach($measurechart as $row){ ?>
				<td>
					<?php print $row['actualvslastyear'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			
		</table>
		
	</div>
	
	
	<div class="span12" id='con222' style='display:none'>
		
		<strong>
		<?php if(!empty($measurechartakumulasi)){print $measurechartakumulasi[0]["name"];} ?> Performance Accumulation <br/><br/>
		</strong>
		
		<table class="table table-condensed table-bordered" style='font-size:.7em;background-color:#fff;color:#000;margin-left:0px;' id='tablecontainer3akumulasi' >
			<tr style='font-weight:bold;'>
				<td>&nbsp;</td><td>Jan</td><td>Feb</td><td>Mar</td><td>Apr</td><td>May</td><td>Jun</td><td>Jul</td><td>Aug</td><td>Sep</td><td>Oct</td><td>Nop</td><td>Dec</td>
			</tr>
			<tr>
				<td>Actual vs Target</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actualvstarget'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Actual vs Last Year</td>
				<?php foreach($measurechartakumulasi as $row){ ?>
				<td>
					<?php print $row['actualvslastyear'].'%'; ?>
				</td>
				<?php } ?>
			</tr>
			
		</table>
		
	</div>
	
</div>
	
