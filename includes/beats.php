<?php 

	// ---- (1) READ THE JSON
	// 			description of the DESIGN
	$DESIGN = json_decode(file_get_contents('data/beats.json'));
	// IDEA: this .... could ...
	$team = null;

	foreach($DESIGN as $d)
	{
		if (strtoupper($URL[1])==strtoupper($d->name) || strtoupper($URL[1])==strtoupper($d->team)) {
			$blocks = $d->segments;
			$team = $d;
		}
	}
	if ($team)
	{
		// ---- (2) COUNT THE FLOORS 
		//			so we can reverse it
		//			don't break it!!!!
		$floorCount = countFloors($blocks);
		//			WE ARE READING THIS FROM LOD ZERO
		
		// ---- (3) calc the floor heights
		//			this is basically floorcount again...
		// 			but I think this time 
		//			we are building a data model ...
		// 			N.B. HERE all floors in block are SAME
		dataModel($floorCount,$blocks); //-- YOU WERE HERE!
		//			THIS NEEDS TO BUILD DATA MODEL.
		//			WE AR MAKING LOD 1....
		
	}
	?>
	
	<div class='full_menu' >
	
	<?php foreach($DESIGN as $d)
			{
				echo "<a href='".$url."/".$version."/".$c->test."/".$d->name."'>".$d->name.'</a>';
				echo ' | ';
			}
		?>
	
	</div>
	
	<!-- THE LEFT SIDE (Input) -->
	
	<div class='sys'>
	
		<div class='io'>
		<?php 
				echo "LOD";
		?>
		</div>
		<br>
		<div class='io'>
			<?php
				$schema = json_decode(file_get_contents($c->schema_in));
					foreach($schema->items->required as $k=>$v)
					{
						echo $v.' : '.$team->$v.'<br>';
			
					}
				
			
			?>
		</div>
		<div class='io'>
		<?php 
				echo "<b>Project ".$team->target."</b><br>";
		?>
		</div>
	</div>
	
	<!-- THE MIDDLE BIT (The system) -->
	
	<div class='sys' style='width:36%'>
		
		<div class='io'>
			<?php
			// ---- (4) do it by block ...
			//			iterate through the blocks
			countBlocks($floorCount,$blocks,$url);
			?>
		</div>
	
	</div>
	
	<!-- THE RIGHT SIDE (Output) -->
	
	<div class='sys' style='width:20%'>
	
		
		<div class='io beats' >
			<?php
			
				$hgt = getHeight($blocks);
				$gfa = getGFA($blocks);
				$offices = ($team->perm_sing_off+$team->perm_sing_off);
				/* if ($offices)
				{
					$efficiency = $gfa/$offices;
					echo $efficiency;
				}
				else
					echo 'really should calc the offices!';
				 */
				specialBeat($hgt,'total HGT');
				specialBeat($gfa,'Total GFA');
				
				
				$schema = json_decode(file_get_contents($c->schema_out));
					foreach($schema->items->required as $k=>$v)
					{
						echo "<b><div style='width:100%;float:right'><div style='float:left'>".$v."   :</div> <div class='beats_value'>".$team->$v.'</div></div></b>';
					}
			?>
		</div>
		<div class='io'>
		<?php 
				echo "Plan view";
		?>
		</div>
	</div>

<?php 

function specialBeat($data, $label)
{
	echo "<b><div style='width:100%;float:right'><div style='float:left'>".$label.": </div> <div class='beats_value'>".$data.'</div></div></b>';
}

// omg it works - don't touch it!! 
function countFloors($blocks){

	$count = 0;
	for($i=0; $i<sizeof($blocks); $i++)
	{
		$count+=$blocks[$i]->flrs;
	}
	return $count;
}

// omg it works - don't touch it!! 
function getHeight($blocks){

	$count = 0;
	for($i=0; $i<sizeof($blocks); $i++)
	{
		$height+=$blocks[$i]->flrs*$blocks[$i]->f2f;
	}
	return $height;
}

function getGFA($blocks){

	$count = 0;
	for($i=0; $i<sizeof($blocks); $i++)
	{
		$gfa+=$blocks[$i]->flrs*$blocks[$i]->gfa;
	}
	return $gfa;
}



function dataModel($blocks){ //-- AND HERE!

	//$count = 0;
	for($i=0; $i<sizeof($blocks); $i++)
	{
		//$count+=$blocks[$i]->flrs;
	}
	//return $count;
}

function grow($currentHeight,$f2f) {
	return ($currentHeight+$f2f);
}

function countBlocks($floorCount,$blocks,$url){

	$hgt=0;
	
	for($i=0; $i<=sizeof($blocks)-1; $i++)
	{
		// write the block name
		echo "<div class='blocker'>";
		//echo $blocks[$i]->name;
		echo "<div style=''>";
		// hey I'm in here already!!
		// I can get the height quick and send it though ....
		// (3a) calc the flr hgt
		
		// draw the floor ...
		$floorCount=flexBuild($floorCount,$blocks[$i]->order,$blocks[$i]->name,$blocks[$i]->flrs,$blocks[$i]->f2f,$blocks[$i]->gfa,$url);
		echo '</div></div>';
	}
}

function flexBuild($floor,$order,$name,$flrs,$f2f,$gfa,$url) {
	
	// this counts the floors
	for($i=$flrs-1; $i>=0; $i--){
		$divHgt = $f2f/2;
		?>
		<hr style='margin:0px;border: solid gray 1px;'>
		<a href='<?php echo $url."/".$version."/".$c->test."/".$d->name?>'>
		<div class='floor' style="height:<?php echo $divHgt?>em;background-color:<?php
		if ($name=='MEP') echo '#F6D04D'; 
		else if ($name=='Auditorium') echo '#00ffff';
		else echo '#ccc';
		
		?>;">
		<?php 
		echo "<span class='floor_name'>";
			echo ($floor-1).' <b>'.ucfirst($name).'</b> ';
		echo "</span>";
		echo "<span class='floor_stats'>";
			echo "<b>";
			echo $gfa.'</b>m <i>GFA</i>';
		echo "</span>";
		echo "<span class='floor_stats'>";
			echo "<b>";
			echo $f2f.'</b>m <i>F2F</i> ';
		echo "</span>";
		$floor--;
		
		?></div></a>
		
	
	<?php } 

	return $floor;
}

?>