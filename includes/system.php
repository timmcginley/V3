<?php 

	// ---- (1) READ THE JSON
	// 			description of the DESIGN
	$SYSTEM = json_decode(file_get_contents('data/system.json'));
	// IDEA: this .... could ...
	$sys = null;

	foreach($SYSTEM as $d)
	{
		if (strtoupper($URL[1])==strtoupper($d->name)) {
		
			$sys = $d;
		}
	}
	if ($sys)
	{
		// do some stuff
	}
	?>
	<div class='full_menu' >
	<?php foreach($SYSTEM as $d)
			{
				echo "<a href='".$url."/".$version."/".$c->test."/".$d->name."'>".$d->name.'</a>';
				echo ' | ';
			}
		?>
	</div>
	<div class='sys'>
	
		<div class='io'>
		
		</div>
		<br>
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
	<div class='sys' style='width:26%'>
		
		<div class='io'>
			
			<?php
			
			if($sys->stream_id)
			{
				$speck = 'https://hestia.speckle.works/api/streams/'.$sys->stream_id;
				$speckle = json_decode(file_get_contents($speck));

				echo '<h1>'.$speckle->resource->name.'</h1>';
				echo 'Created: '.$speckle->resource->createdAt.'<br>';
				echo 'Edited: '.$speckle->resource->updatedAt.'<br>';
				echo '<br>';
				foreach ($speckle->resource->layers as $layer)
				{
					echo '<b>'.$layer->name.' </b>('.$layer->guid.')<br>';
				}
			}
			
			?>
			
		</div>
	
	</div>
	<div class='sys' style='width:30%'>
	
		
		<div class='io' >
			<?php
			if($sys->stream_id)
			{
				
				$stream_url = 'https://hestia.speckle.works/api/streams/'.$sys->stream_id;
				//$objects_url = $speck.'/objects';
				$stream = json_decode(file_get_contents($stream_url));
				
				$object_url = $stream_url.'/objects';
				$object = json_decode(file_get_contents($object_url));
		
				foreach ($stream->resource->layers as $layer)
				{
					echo '<b>'.$layer->name.'</b><br>';
					echo "<div style='padding:2px;margin-top:2px;border-radius:2px;width=100%;background-color:#000;color:#fff;'>";
					for ($i = 1; $i <= $layer->objectCount; $i++) {
						
						echo '&nbsp;'.$i.':';
						$b = $layer->startIndex+$i-1;
						$guid =$stream->resource->objects[$b]->_id;
						
						getObject($guid,$object);
						//slowDeath($guid);
						
						echo '<br>';
					}
					echo '</div>';
				}
			}
			
			?>
		</div>
	</div>

<?php 

function getObject($guid,$object)
{
	foreach ($object->resources as $v)
	{
		if ($guid == $v->_id)
		{
			if ($v->type == 'String' || $v->type == 'Number')
				echo $v->value;
			else if ($guid)
				echo '<i>'.$v->type.'</i> ('.$guid.')';
			else echo 'null'; 
		}
	}
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
		$floorCount=flexBuild($floorCount,$blocks[$i]->order,$blocks[$i]->name,$blocks[$i]->flrs,$blocks[$i]->f2f,$url);
		echo '</div></div>';
	}
}

function flexBuild($floor,$order,$name,$flrs,$f2f,$url) {
	
	// this counts the floors
	for($i=$flrs-1; $i>=0; $i--){
		$divHgt = $f2f/2;
		?>
		<hr style='margin:0px;border: solid gray 1px;'>
		<a href='<?php echo $url."/".$version."/".$c->test."/".$d->name?>'>
		<div class='floor' style="height:<?php echo $divHgt?>em">
		<?php 
		echo "<span style='float:left;padding-left:20px;'>";
			echo $floor.' <b>'.ucfirst($name).'</b> ';
		echo "</span>";
		echo "<span style='float:right;padding:3px;border-radius:5px;background-color:#fff;margin-right:20px;margin-top:3px;'>";
			echo "<b>";
			echo $f2f.'</b>m <i>F2F</i>';
		echo "</span>";
		$floor--;
		
		?></div></a>
		
	
	<?php } 

	return $floor;
}

?>