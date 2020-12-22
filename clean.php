<!doctype html>
<html class="no-js" lang="">


<?php

	$URL = explode('/',$_SERVER['QUERY_STRING']);
	function base() {
		echo str_replace('clean.php',"",$_SERVER['PHP_SELF']);
	}
	// adding http ($base) seems to slow it down crazy.... BUT means flexible between local and production..
	$base = str_replace('clean.php',"",$_SERVER['PHP_SELF']);
	
	$version = 'v3';
	?>
<head>
	<title><?php 

	
	// ------------------------
	
	// this is state of the system 
	$test = strtoupper($URL[0]);
	// this contains all the actions for the different states
	$clean = json_decode(file_get_contents('system/clean.json'));
	
	foreach($clean as $c)
	{
		// if the state (class) is the same as the value in url[0] ....
		if (strtoupper($test)==strtoupper($c->name) || strtoupper($test)==strtoupper($c->test)) {
			echo 'AGILE X | '.$version.' | '.ucfirst($c->name).' | '.strtoupper($URL[1]);
	}
	}
	?>
	</title>
	<meta name="description" content="">
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?php echo base();?>css/main.css">
	<link rel="stylesheet" href="<?php echo base();?>css/normalize.css">
	<link rel="stylesheet" href="<?php echo base();?>css/DTU.css">
	<link rel="stylesheet" href="<?php echo base();?>css/design.css">
	  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
	<script src='<?php echo base();?>RFP.js'></script>
	<script src='<?php echo base();?>js/main.js'></script>
</head>

<style type="text/css">
@media print { body { -webkit-print-color-adjust: exact; } }
</style>

<body>
	<code>
		<div class="inner" id='main' >
		
			<?php 
			
			
				$found=false;
				// loop through the potential states....
				foreach($clean as $c)
				{
					// if the state (class) is the same as the value in url[0] ....
					if (strtoupper($test)==strtoupper($c->name) || strtoupper($test)==strtoupper($c->test)) {
						
						// the title of the page
						include 'includes/heading.php';
						
						
						echo "<div style='padding:0%;height:1050px;'>";
						
							// probs need to be able to change class
							
							// if instance defined - display it
							if ($URL[1])
								include 'includes/current.php';
							
							// option to creat new instance
							//include 'includes/new.php';
							// view all instances of class.
							
							include 'includes/load.php';
						
						echo "</div>";
						
						$found=true;
						}
						
				}
				if ($found==false)
					
			
						
				?>
		</div>
	</code>
</body>
<?php 
 ?>

</html>