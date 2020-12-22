<?php
	// make a menu
	echo "<div class='top_banner'>";
		echo "<div class='logo_fix';>";
			
			echo "FIX";
		
		echo "</div>";
		echo "<div class='heading-background;float:left;'>";

			echo "<h1 style='color:#fff;padding-right:1em;width:100%;padding-top:1px'>";
				echo "<b>".ucfirst($c->name).'</b>';
				if ($URL[1])
				{
					echo "->".$URL[1];
					// also need to check if we have it in the data...
				}
	
			echo "</h1>";
		
		echo "<span style='padding-left:0em;'>";
	
		foreach ($clean as $b){
			echo "<b><a href='".$url."/".$version."/".$b->test."/'>".ucfirst($b->name)."</a></b> | ";
		}

		echo "</span>";
		echo "</div>";
	echo "</div>";

?>