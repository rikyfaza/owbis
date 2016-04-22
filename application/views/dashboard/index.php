<style>
div{
	/*border: 1px solid #000;*/
}
a{
	color:#000;
}
.titlehome{
	height:30px;
	border-bottom:2px solid #3B5998;
	margin-bottom:15px;
}
.lefthome{
	float:left;
	width:29%;
	height:220px;
	margin-right:50px;
	margin-bottom: 30px;
	/*border: 1px solid #3B5998; */
}
.titleup{
	height:40px;
	border-bottom:1px solid #3B5998;
	margin-left:70px;
}
.titlebrand{
	float:left;
}
.contenthome{
	width:80%;
	height:168px;
	margin-left:50px;
	
}
.icon{
	height:60px;
	width:60px;
	float:left;
}
.imgheader{
	max-height:60px;
	max-width:60px;
}
</style>

<div style='text-align:left;font-size:11px;'>
	
	<div class='titlehome'>
		<h4 style='color:#3B5998'><?php echo $profile[0]['namecompany']; ?></h4>
	</div>
	<?php
		/*
	 	print_r($_SESSION['logon']);echo ' - ';
        print_r($_SESSION['iduserlogged']);echo ' - ';
        print_r($_SESSION['dbuserlogged']);echo ' - ';
        print_r($_SESSION['userlevel']);
        */
    ?>
	<div class='lefthome'>
	
		<div class='icon'>
			<img src='<?php echo base_url().'libs/img/Organization-Chart-Icon-1105185829.png';?>' class='imgheader'></img>
		</div>
		<div class='titleup'>
			<h5 class='titlebrand'>Views</h5>
		</div>
		
		<div class='contenthome'>
			<ul>
            	<?php foreach($listViews as $row) { ?>
				<li style='list-style:none'><a href='<?php echo site_url()."/maincontroller/hirarkikpi/".$row["idview"]; ?>'><?php echo $row['name']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		
	</div>
	
	<div class='lefthome'>
	
		<div class='icon'>
			<img src='<?php echo base_url().'libs/img/Line-chart-icon.png';?>' class='imgheader'></img>
		</div>
		<div class='titleup'>
			<h5 class='titlebrand'>Charts</h5>
		</div>
		
		<div class='contenthome'>
			<ul>
            	<?php foreach($listViews as $row) { ?>
				<li style='list-style:none'><a href='<?php echo site_url()."/chart/viewChart/".$row["idview"]; ?>'><?php echo $row['name']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
		
	</div>
	<div class='lefthome'>
	</div>
	<div class='lefthome'>
	</div>
	<div class='lefthome'>
	</div>
	<div class='lefthome'>
	</div>
</div>