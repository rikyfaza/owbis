
<div class="navbar navbar-fixed-top" style='text-align: left;'>
	<div class="navbar-inner">
		<div class="backcolorhead">
			<div class="container">
				<a class="brand" href="<?php echo site_url().'/maincontroller/index';?>">
					<img src="<?= base_url();?>libs/css/images/chart-icon.png" class="iconimg" alt="logo"> Performance IS
				</a>
				<?php 
					if(isset($_SESSION['logon'])) {
				?>
				<ul class="nav nav-pills" >
				
					<li><a href="<?php echo site_url().'/maincontroller/index';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Home</a></li>
					<!--
					<li class="dropdown">
						<a href="#" class="dropdown-toggle"  data-toggle="dropdown" style="color:#fff;text-shadow: 0 1px 0 #999;">Performance<b class="caret"></b></a>
						<ul class="dropdown-menu leftt">
							<li><a href="<?php echo site_url().'/maincontroller/hirarkikpi'; ?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Hirarki KPI</a></li>    
							<!--
							<li><a href="<?php echo site_url().'/maincontroller/hirarkikpibylocation'; ?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Hirarki KPI by Location</a></li>    
							<li><a href="<?php echo site_url().'/maincontroller/hirarkikpibyowner'; ?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Hirarki KPI by Owner</a></li>    
							
						</ul>
					</li> 
					-->
					<?php if(isset($_SESSION['accesssetup'])) {
							if ($_SESSION['accesssetup'] == 'signed') {
					?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle"  data-toggle="dropdown" style="color:#fff;text-shadow: 0 1px 0 #999;">Setup<b class="caret"></b></a>
						<ul class="dropdown-menu leftt">
							<li><a href="<?php echo site_url().'/maincontroller/setupperformanceranges';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Performance Ranges</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupmeasure';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Measures</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setuplocations';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Locations</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupunittype';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Unit Types</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupusers';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Users</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupviews';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Views</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupperiod';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Period</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupreport';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Report</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupdatabase';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Databases</a></li>
						</ul>
					</li> 
					<?php } } ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle"  data-toggle="dropdown" style="color:#fff;text-shadow: 0 1px 0 #999;">Company<b class="caret"></b></a>
						<ul class="dropdown-menu leftt">
							<li><a href="<?php echo site_url().'/maincontroller/profile';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Company Profile</a></li>
							<li><a href="<?php echo site_url().'/maincontroller/setupCompany';?>" style="color:#fff;text-shadow: 0 1px 0 #999;">Setup Company</a></li>
						</ul>
					</li>
					<li></li>
				</ul>
				
				<span style='float:right;margin-top:10px;color:#fff;text-align:right'>Welcome <strong><?php print $_SESSION['usernamelog']; ?></strong><br /><a href="<?php echo site_url().'/maincontroller/logout';?>" style="color:#fff;text-shadow: 0 1px 0 #999;"><strong>Logout</strong></a></span>
				<?php } else {} ?>
			</div>
		</div>	
	</div>
</div>
