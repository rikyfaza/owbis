
<div class="span4">
	Performance Information System 1.0 Build 31214<br />
	&copy 2014 <strong>owbis</strong><br />
	<a href="http://www.owbis.net" style="color:#fff">www.owbis.net</a>
</div>

<div class="span5">
	<?php 
		if(isset($_SESSION['company']))
			echo "<strong>".$_SESSION['company']."</strong><br />".$_SESSION['telpcompany']."<br />".$_SESSION['emailcompany']; 
		else echo "";
	?>
</div>

<div class="span3">

</div>
