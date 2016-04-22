
<style>
tr, th, td, .series1label, .series1labelvariance, .series2label, .series2labelvariance{
	font-size:1em;
}
</style>
<p>

<div id="tabs" >
	
	<ul>
		<li><a href="#tabs-1">Data</a></li>
		<li><a href="#tabs-2">Chart XY</a></li>
		<li><a href="#tabs-3">Action Plan</a></li>
	</ul>
	
	
	<div id="tabs-1" >
		<style>
			table{
			font-size:11px;
			line-height:20px;
		
			}
			input[type=text]{
				height: 20px;
			}
		</style>
		<?php
			echo form_open('setup/saveperiodmonth');
		?>
		
		<input type='hidden' style='width:50px;height:15px' id='idmeasure' name='idmeasure' />
		<input type='hidden' style='width:50px;height:15px' id='idview' name='idview' />
		<input type='hidden' style='width:50px;height:15px' id='periodset' name='periodset' />
		
		<br />
		
		<table class="table table-striped table-hover table-condensed ">
			
			<!-- JANUARY -->
			<tr><th  id='janhead'  colspan='4' >January</th></tr>
			<tr style="height:30px">
				<td style='display:none;' id='jantitle1' >Actual</td>
				<td style='display:none;' id='janheadtd1' ><input type='text' style='width:50px;height:15px' name='janact' id='janact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1jan' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1jantd1' ><input type='text' style='width:50px;height:15px' name='series1janact' id='series1janact' placeholder='NULL' ></td> 
				
			</tr>	
			<tr>
				<td style='display:none;' id='jantitle2' >Target</td>
				<td style='display:none;' id='janheadtd2' ><input type='text' style='width:50px;height:15px' name='jantar' id='jantar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1janvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1janvartd1' ><input type='text' style='width:50px;height:15px' name='series1janvaract' id='series1janvaract' placeholder='NULL' readonly ></td> 
				
			</tr>	
			<tr>
				<td style='display:none;' id='jantitle3' >Index</td>
				<td style='display:none;' id='janheadtd3' ><input type='text' style='width:50px;height:15px' name='janidx' id='janidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2jan' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2jantd1' ><input type='text' style='width:50px;height:15px' name='series2janact' id='series2janact' placeholder='NULL' ></td> 
				
			</tr>

			<tr>
				<td style='display:none;' id='jantargetvar' >Target Variance</td>
				<td style='display:none;' id='jantargetvartd3' ><input type='text' style='width:50px;height:15px' name='jantargetvaridx' id='jantargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2janvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2janvartd1' ><input type='text' style='width:50px;height:15px' name='series2janvarct' id='series2janvaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
			<!-- FEBRUARY -->
			<tr><th style='display:none;' id='febhead'  colspan='4'>February</th></tr>
			<tr>
				<td style='display:none;' id='febtitle1' >Actual</td>
				<td style='display:none;' id='febheadtd1' ><input type='text' style='width:50px;height:15px' name='febact' id='febact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1feb' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1febtd1' ><input type='text' style='width:50px;height:15px' name='series1febact' id='series1febact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='febtitle2' >Target</td>
				<td style='display:none;' id='febheadtd2' ><input type='text' style='width:50px;height:15px' name='febtar' id='febtar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1febvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1febvartd1' ><input type='text' style='width:50px;height:15px' name='series1febvaract' id='series1febvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='febtitle3' >Index</td>
				<td style='display:none;' id='febheadtd3' ><input type='text' style='width:50px;height:15px' name='febidx' id='febidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2feb' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2febtd1' ><input type='text' style='width:50px;height:15px' name='series2febact' id='series2febact' placeholder='NULL' ></td> 
			</tr>

			<tr>
				<td style='display:none;' id='febtargetvar' >Target Variance</td>
				<td style='display:none;' id='febtargetvartd3' ><input type='text' style='width:50px;height:15px' name='febtargetvaridx' id='febtargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2febvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2febvartd1' ><input type='text' style='width:50px;height:15px' name='series2febvarct' id='series2febvaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
			<!-- MARET -->
			<tr><th style='display:none;' id='marhead' colspan='4' >March</th></tr>
			<tr>
				<td style='display:none;' id='martitle1' >Actual</td>
				<td style='display:none;' id='marheadtd1' ><input type='text' style='width:50px;height:15px' name='maract' id='maract' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1mar' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1martd1' ><input type='text' style='width:50px;height:15px' name='series1maract' id='series1maract' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='martitle2' >Target</td>
				<td style='display:none;' id='marheadtd2' ><input type='text' style='width:50px;height:15px' name='martar' id='martar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1marvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1marvartd1' ><input type='text' style='width:50px;height:15px' name='series1marvaract' id='series1marvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='martitle3' >Index</td>
				<td style='display:none;' id='marheadtd3' ><input type='text' style='width:50px;height:15px' name='maridx' id='maridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2mar' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2martd1' ><input type='text' style='width:50px;height:15px' name='series2maract' id='series2maract' placeholder='NULL' ></td> 
			</tr>

			<tr>
				<td style='display:none;' id='martargetvar' >Target Variance</td>
				<td style='display:none;' id='martargetvartd3' ><input type='text' style='width:50px;height:15px' name='martargetvaridx' id='martargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2marvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2marvartd1' ><input type='text' style='width:50px;height:15px' name='series2marvarct' id='series2marvaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
			<!-- APRIL -->
			<tr><th style='display:none;' id='aprhead' colspan='4' >April</th></tr>
			<tr>
				<td style='display:none;' id='aprtitle1' >Actual</td>
				<td style='display:none;' id='aprheadtd1' ><input type='text' style='width:50px;height:15px' name='apract' id='apract' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1apr' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1aprtd1' ><input type='text' style='width:50px;height:15px' name='series1apract' id='series1apract' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='aprtitle2' >Target</td>
				<td style='display:none;' id='aprheadtd2' ><input type='text' style='width:50px;height:15px' name='aprtar' id='aprtar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1aprvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1aprvartd1' ><input type='text' style='width:50px;height:15px' name='series1aprvaract' id='series1aprvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='aprtitle3' >Index</td>
				<td style='display:none;' id='aprheadtd3' ><input type='text' style='width:50px;height:15px' name='apridx' id='apridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2apr' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2aprtd1' ><input type='text' style='width:50px;height:15px' name='series2apract' id='series2apract' placeholder='NULL' ></td> 
			</tr>
			
			<tr>
				<td style='display:none;' id='aprtargetvar' >Target Variance</td>
				<td style='display:none;' id='aprtargetvartd3' ><input type='text' style='width:50px;height:15px' name='aprtargetvaridx' id='aprtargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2aprvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2aprvartd1' ><input type='text' style='width:50px;height:15px' name='series2aprvarct' id='series2aprvaract' placeholder='NULL' readonly></td> 
				
			</tr>

			<!-- MEI -->
			<tr><th style='display:none;' id='meihead' colspan='4' >May</th></tr>
			<tr>
				<td style='display:none;' id='meititle1' >Actual</td>
				<td style='display:none;' id='meiheadtd1' ><input type='text' style='width:50px;height:15px' name='meiact' id='meiact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1mei' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1meitd1' ><input type='text' style='width:50px;height:15px' name='series1meiact' id='series1meiact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='meititle2' >Target</td>
				<td style='display:none;' id='meiheadtd2' ><input type='text' style='width:50px;height:15px' name='meitar' id='meitar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1meivar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1meivartd1' ><input type='text' style='width:50px;height:15px' name='series1meivaract' id='series1meivaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='meititle3' >Index</td>
				<td style='display:none;' id='meiheadtd3' ><input type='text' style='width:50px;height:15px' name='meiidx' id='meiidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2mei' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2meitd1' ><input type='text' style='width:50px;height:15px' name='series2meiact' id='series2meiact' placeholder='NULL' ></td> 
			</tr>	

			<tr>
				<td style='display:none;' id='meitargetvar' >Target Variance</td>
				<td style='display:none;' id='meitargetvartd3' ><input type='text' style='width:50px;height:15px' name='meitargetvaridx' id='meitargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2meivar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2meivartd1' ><input type='text' style='width:50px;height:15px' name='series2meivarct' id='series2meivaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
			<!-- JUNI -->
			<tr><th style='display:none;' id='junhead' colspan='4' >June</th></tr>
			<tr>
				<td style='display:none;' id='juntitle1' >Actual</td>
				<td style='display:none;' id='junheadtd1' ><input type='text' style='width:50px;height:15px' name='junact' id='junact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1jun' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1juntd1' ><input type='text' style='width:50px;height:15px' name='series1junact' id='series1junact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='juntitle2' >Target</td>
				<td style='display:none;' id='junheadtd2' ><input type='text' style='width:50px;height:15px' name='juntar' id='juntar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1junvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1junvartd1' ><input type='text' style='width:50px;height:15px' name='series1junvaract' id='series1junvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='juntitle3' >Index</td>
				<td style='display:none;' id='junheadtd3' ><input type='text' style='width:50px;height:15px' name='junidx' id='junidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2jun' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2juntd1' ><input type='text' style='width:50px;height:15px' name='series2junact' id='series2junact' placeholder='NULL' ></td> 
			</tr>
			
			<tr>
				<td style='display:none;' id='juntargetvar' >Target Variance</td>
				<td style='display:none;' id='juntargetvartd3' ><input type='text' style='width:50px;height:15px' name='juntargetvaridx' id='juntargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2junvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2junvartd1' ><input type='text' style='width:50px;height:15px' name='series2junvarct' id='series2junvaract' placeholder='NULL' readonly></td> 
				
			</tr>

			<!-- JULI -->
			<tr><th style='display:none;' id='julhead' colspan='4' >July</th></tr>
			<tr>
				<td style='display:none;' id='jultitle1' >Actual</td>
				<td style='display:none;' id='julheadtd1' ><input type='text' style='width:50px;height:15px' name='julact' id='julact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1jul' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1jultd1' ><input type='text' style='width:50px;height:15px' name='series1julact' id='series1julact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='jultitle2' >Target</td>
				<td style='display:none;' id='julheadtd2' ><input type='text' style='width:50px;height:15px' name='jultar' id='jultar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1julvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1julvartd1' ><input type='text' style='width:50px;height:15px' name='series1julvaract' id='series1julvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='jultitle3' >Index</td>
				<td style='display:none;' id='julheadtd3' ><input type='text' style='width:50px;height:15px' name='julidx' id='julidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2jul' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2jultd1' ><input type='text' style='width:50px;height:15px' name='series2julact' id='series2julact' placeholder='NULL' ></td> 
			</tr>

			<tr>
				<td style='display:none;' id='jultargetvar' >Target Variance</td>
				<td style='display:none;' id='jultargetvartd3' ><input type='text' style='width:50px;height:15px' name='jultargetvaridx' id='jultargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2julvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2julvartd1' ><input type='text' style='width:50px;height:15px' name='series2julvarct' id='series2julvaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
			<!-- AGUSTUS -->
			<tr><th style='display:none;' id='aughead' colspan='4'>August</th></tr>
			<tr>
				<td style='display:none;' id='augtitle1' >Actual</td>
				<td style='display:none;' id='augheadtd1' ><input type='text' style='width:50px;height:15px' name='augact' id='augact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1aug' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1augtd1' ><input type='text' style='width:50px;height:15px' name='series1augact' id='series1augact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='augtitle2' >Target</td>
				<td style='display:none;' id='augheadtd2' ><input type='text' style='width:50px;height:15px' name='augtar' id='augtar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1augvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1augvartd1' ><input type='text' style='width:50px;height:15px' name='series1augvaract' id='series1augvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='augtitle3' >Index</td>
				<td style='display:none;' id='augheadtd3' ><input type='text' style='width:50px;height:15px' name='augidx' id='augidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2aug' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2augtd1' ><input type='text' style='width:50px;height:15px' name='series2augact' id='series2augact' placeholder='NULL' ></td> 
			</tr>
			
			<tr>
				<td style='display:none;' id='augtargetvar' >Target Variance</td>
				<td style='display:none;' id='augtargetvartd3' ><input type='text' style='width:50px;height:15px' name='augtargetvaridx' id='augtargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2augvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2augvartd1' ><input type='text' style='width:50px;height:15px' name='series2augvarct' id='series2augvaract' placeholder='NULL' readonly></td> 
				
			</tr>

			<!-- SEPTEMBER -->
			<tr><th style='display:none;' id='sephead' colspan='4' >September</th></tr>
			<tr>
				<td style='display:none;' id='septitle1' >Actual</td>
				<td style='display:none;' id='sepheadtd1' ><input type='text' style='width:50px;height:15px' name='sepact' id='sepact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1sep' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1septd1' ><input type='text' style='width:50px;height:15px' name='series1sepact' id='series1sepact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='septitle2' >Target</td>
				<td style='display:none;' id='sepheadtd2' ><input type='text' style='width:50px;height:15px' name='septar' id='septar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1sepvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1sepvartd1' ><input type='text' style='width:50px;height:15px' name='series1sepvaract' id='series1sepvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='septitle3' >Index</td>
				<td style='display:none;' id='sepheadtd3' ><input type='text' style='width:50px;height:15px' name='sepidx' id='sepidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2sep' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2septd1' ><input type='text' style='width:50px;height:15px' name='series2sepact' id='series2sepact' placeholder='NULL' ></td> 
			</tr>

			<tr>
				<td style='display:none;' id='septargetvar' >Target Variance</td>
				<td style='display:none;' id='septargetvartd3' ><input type='text' style='width:50px;height:15px' name='septargetvaridx' id='septargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2sepvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2sepvartd1' ><input type='text' style='width:50px;height:15px' name='series2sepvarct' id='series2sepvaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
			<!-- OKTOBER -->
			<tr><th style='display:none;' id='okthead' colspan='4' >October</th></tr>
			<tr>
				<td style='display:none;' id='okttitle1' >Actual</td>
				<td style='display:none;' id='oktheadtd1' ><input type='text' style='width:50px;height:15px' name='oktact' id='oktact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1okt' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1okttd1' ><input type='text' style='width:50px;height:15px' name='series1oktact' id='series1oktact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='okttitle2' >Target</td>
				<td style='display:none;' id='oktheadtd2' ><input type='text' style='width:50px;height:15px' name='okttar' id='okttar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1oktvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1oktvartd1' ><input type='text' style='width:50px;height:15px' name='series1oktvaract' id='series1oktvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='okttitle3' >Index</td>
				<td style='display:none;' id='oktheadtd3' ><input type='text' style='width:50px;height:15px' name='oktidx' id='oktidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2okt' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2okttd1' ><input type='text' style='width:50px;height:15px' name='series2oktact' id='series2oktact' placeholder='NULL' ></td> 
			</tr>
			
			<tr>
				<td style='display:none;' id='okttargetvar' >Target Variance</td>
				<td style='display:none;' id='okttargetvartd3' ><input type='text' style='width:50px;height:15px' name='okttargetvaridx' id='okttargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2oktvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2oktvartd1' ><input type='text' style='width:50px;height:15px' name='series2oktvarct' id='series2oktvaract' placeholder='NULL' readonly></td> 
				
			</tr>

			<!-- NOPEMBER -->
			<tr><th style='display:none;' id='nophead' colspan='4' >November</th></tr>
			<tr>
				<td style='display:none;' id='noptitle1' >Actual</td>
				<td style='display:none;' id='nopheadtd1' ><input type='text' style='width:50px;height:15px' name='nopact' id='nopact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1nop' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1noptd1' ><input type='text' style='width:50px;height:15px' name='series1nopact' id='series1nopact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='noptitle2' >Target</td>
				<td style='display:none;' id='nopheadtd2' ><input type='text' style='width:50px;height:15px' name='noptar' id='noptar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1nopvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1nopvartd1' ><input type='text' style='width:50px;height:15px' name='series1nopvaract' id='series1nopvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='noptitle3' >Index</td>
				<td style='display:none;' id='nopheadtd3' ><input type='text' style='width:50px;height:15px' name='nopidx' id='nopidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2nop' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2noptd1' ><input type='text' style='width:50px;height:15px' name='series2nopact' id='series2nopact' placeholder='NULL' ></td> 
			</tr>
			
			<tr>
				<td style='display:none;' id='noptargetvar' >Target Variance</td>
				<td style='display:none;' id='noptargetvartd3' ><input type='text' style='width:50px;height:15px' name='noptargetvaridx' id='noptargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2nopvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2nopvartd1' ><input type='text' style='width:50px;height:15px' name='series2nopvarct' id='series2nopvaract' placeholder='NULL' readonly></td> 
				
			</tr>

			<!-- DESEMBER -->
			<tr><th style='display:none;' id='deshead' colspan='4' >December</th></tr>
			<tr>
				<td style='display:none;' id='destitle1' >Actual</td>
				<td style='display:none;' id='desheadtd1' ><input type='text' style='width:50px;height:15px' name='desact' id='desact' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1des' ><label class='series1label'></label></td>
				<td style='display:none;' id='series1destd1' ><input type='text' style='width:50px;height:15px' name='series1desact' id='series1desact' placeholder='NULL' ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='destitle2' >Target</td>
				<td style='display:none;' id='desheadtd2' ><input type='text' style='width:50px;height:15px' name='destar' id='destar' placeholder='NULL' ></td>
				
				<td style='display:none;' id='series1desvar' ><label class='series1labelvariance'></label> </td>
				<td style='display:none;' id='series1desvartd1' ><input type='text' style='width:50px;height:15px' name='series1desvaract' id='series1desvaract' placeholder='NULL' readonly ></td> 
			</tr>	
			<tr>
				<td style='display:none;' id='destitle3' >Index</td>
				<td style='display:none;' id='desheadtd3' ><input type='text' style='width:50px;height:15px' name='desidx' id='desidx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2des' ><label class='series2label'></label></td>
				<td style='display:none;' id='series2destd1' ><input type='text' style='width:50px;height:15px' name='series2desact' id='series2desact' placeholder='NULL' ></td> 
			</tr>
			
			<tr>
				<td style='display:none;' id='destargetvar' >Target Variance</td>
				<td style='display:none;' id='destargetvartd3' ><input type='text' style='width:50px;height:15px' name='destargetvaridx' id='destargetvaridx' placeholder='NULL' readonly /></td>
				
				<td style='display:none;' id='series2desvar' ><label class='series2labelvariance'></label> </td>
				<td style='display:none;' id='series2desvartd1' ><input type='text' style='width:50px;height:15px' name='series2desvarct' id='series2desvaract' placeholder='NULL' readonly></td> 
				
			</tr>
			
		</table>
		<p style='border-top:1px solid #000;text-align:left;'><br />
			
			<button type='submit' class='btn btn-primary' id='savepenugasan'>Save</button>
		</p>
		<?php  
			echo form_close();
		?>
	</div>
	
	
	<div id="tabs-2" >
		<div id="chart1div"></div>
	</div>
	
	
	<div id="tabs-3" >
		<div id="tabs2">
			<form id='formactcomm'>
			<ul>
				<li><a href="#tabs2-1">Commentary</a></li>
				<li><a href="#tabs2-2">Action Plan</a></li>
			</ul>
			<div id="tabs2-1">
				<p><textarea style='width:500px;' rows='10' name='comments' id='comments'></textarea></p>
			</div> 
			<div id="tabs2-2">
				<p><textarea style='width:500px;' rows='10' name='actionplans' id='actionplans'></textarea></p>
			</div> 
				<input type='hidden' style='width:50px;height:15px' id='idmeasureactcomm' name='idmeasureactcomm' />
				<p style='text-align:left;'>
				<button type='submit' class='btn btn-primary' name='submitactcomm' id='submitactcomm' style='margin-left:2em'>Save</button>
				</p>
			</form>
		</div>
	</div>
	
	<div style='text-align:left;'>
		<button type='button' class='btn btn-danger' id	='btnDone' >Close</button>
	</div>
	
</div>
	
</p>

