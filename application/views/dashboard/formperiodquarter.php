<div id="tabsquarter">
	
	<ul>
		<li><a href="#tabs-1">Data</a></li>
		<li><a href="#tabs-2">Chart XY</a></li>
		<li><a href="#tabs-3">Action Plan</a></li>
	</ul>

	<div id="tabs-1">
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
				echo form_open('setup/saveperiodquarter');
			?>
			
			<input type='hidden' style='width:50px;' id='idmeasureq' name='idmeasure' />
			<input type='hidden' style='width:50px;' id='idviewq' name='idview' />
			<input type='hidden' style='width:50px;' id='periodset' name='periodset' />
			<p>
				<table class="table table-striped table-hover table-condensed table-bordered">
				
					<tr><th style='display:none;' id='Q1head' colspan='2' >Quarter #1</th></tr>
					<tr>
						<td style='display:none;' id='Q1title1' >Actual</td>
						<td style='display:none;' id='Q1headtd1' ><input type='text' style='width:50px;' name='q1act' id='Q1act'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q1title2' >Target</td>
						<td style='display:none;' id='Q1headtd2' ><input type='text' style='width:50px;' name='q1tar' id='Q1tar'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q1title3' >Index</td>
						<td style='display:none;' id='Q1headtd3' ><input type='text' style='width:50px;' name='q1idx' id='Q1idx' readonly /></td>
					</tr>
					
					<tr><th style='display:none;' id='Q2head' colspan='2' >Quarter #2</th></tr>
					<tr>
						<td style='display:none;' id='Q2title1' >Actual</td>
						<td style='display:none;' id='Q2headtd1' ><input type='text' style='width:50px;' name='q2act' id='Q2act'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q2title2' >Target</td>
						<td style='display:none;' id='Q2headtd2' ><input type='text' style='width:50px;' name='q2tar' id='Q2tar'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q2title3' >Index</td>
						<td style='display:none;' id='Q2headtd3' ><input type='text' style='width:50px;' name='q2idx' id='Q2idx' readonly /></td>
					</tr>
					
					<tr><th style='display:none;' id='Q3head' colspan='2' >Quarter #3</th></tr>
					<tr>
						<td style='display:none;' id='Q3title1' >Actual</td>
						<td style='display:none;' id='Q3headtd1' ><input type='text' style='width:50px;' name='q3act' id='Q3act'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q3title2' >Target</td>
						<td style='display:none;' id='Q3headtd2' ><input type='text' style='width:50px;' name='q3tar' id='Q3tar'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q3title3' >Index</td>
						<td style='display:none;' id='Q3headtd3' ><input type='text' style='width:50px;' name='q3idx' id='Q3idx' readonly /></td>
					</tr>
					
					
					<tr><th style='display:none;' id='Q4head' colspan='2' >Quarter #4</th></tr>
					<tr>
						<td style='display:none;' id='Q4title1' >Actual</td>
						<td style='display:none;' id='Q4headtd1' ><input type='text' style='width:50px;' name='q4act' id='Q4act'></td>
					</tr>
					
					<tr>
						<td style='display:none;' id='Q4title2' >Target</td>
						<td style='display:none;' id='Q4headtd2' ><input type='text' style='width:50px;' name='q4tar' id='Q4tar'></td>
					</tr>
					<tr>
						<td style='display:none;' id='Q4title3' >Index</td>
						<td style='display:none;' id='Q4headtd3' ><input type='text' style='width:50px;' name='q4idx' id='Q4idx' readonly /></td>
					</tr>
					
				</table>
			</p>
			
			<p style='border-top:1px solid #000;text-align:left;'><br />
				<button type='submit' class='btn btn-primary' id='savepenugasan'>Save</button>
			</p>
			
			<?php  
				echo form_close();
			?>
	</div>

	<div id="tabs-2">
		<div id="chart2div"></div>
	</div>
	
	
	<div id="tabs-3">
		<div id="tabs2quarter">
			<form id='formactcomm'>
			<ul>
				<li><a href="#tabs2-1">Commentary</a></li>
				<li><a href="#tabs2-2">Action Plan</a></li>
			</ul>
			<div id="tabs2-1">
				<p><textarea style='width:500px;' rows='10' name='commentsQ' id='commentsQ'></textarea></p>
			</div> 
			<div id="tabs2-2">
				<p><textarea style='width:500px;' rows='10' name='actionplansQ' id='actionplansQ'></textarea></p>
			</div> 
				<input type='hidden' style='width:50px;' id='idmeasureactcommQ' name='idmeasureactcommQ' />
				<p style='text-align:left;'>
				<button type='submit' class='btn btn-primary' name='submitactcommQ' id='submitactcommQ' style='margin-left:2em'>Save</button>
				</p>
			</form>
		</div>
	</div>
	
	<div style='text-align:left;'>
		<button type='button' class='btn btn-danger' id	='btnDoneQ' >Close</button>
	</div>
	
</div>

