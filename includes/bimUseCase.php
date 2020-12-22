<?php 

	// tiss is taken from beats -> the idea is to get the use cases in one place...
	
	// ---- (1) READ THE JSON
	// 			description of the DESIGN
	$team = null;
	$useCase = json_decode(file_get_contents('data/bimusecase.json'));
	foreach($useCase as $d)
	{
		if (strtoupper($URL[1])==strtoupper($d->name)) {
			$team = $d;
		}
	}
	
	?>
	<div class='sys' >

		<div class='io'>
		<?php foreach($useCase as $d)
			{
				echo "<a href='".$url."/".$version."/".$c->test."/".$d->name."'>".$d->name.'</a>';
				echo ' | ';
				
			}
		?>
		</div>

		<br>
		<div class='io'>
			<?php
				$schema = json_decode(file_get_contents($c->schema));
					
					?>
					Bim Use Cases taken from the awesome <a href='https://www.bim.psu.edu/'> Penn State Bim Use Cases </a> provided under the <a href='http://creativecommons.org/licenses/by-sa/3.0/us/'>Creative Commons Attribution-Share Alike 3.0 United States License</a><br><br>
					
					<?php
					foreach($schema->items->required as $k=>$v)
					{
						
						if ($v =='desc') echo $team->$v.'<br>';
			
					}
				
			
			?>
		</div>
	</div>
	
	<div class='sys' style='width:60%'>
		
		<div class='io'>
			<?php
			
			$subCase = json_decode(file_get_contents('data/bimSubCases.json'));
			$subCase_schema = json_decode(file_get_contents('data/bimSubCases_schema.json'));
			
			foreach ($subCase as $sub)
			{
			
				if ($sub->major == $team->name)
				{
					foreach($subCase_schema->items->required as $k=>$v)
					{
							if ($v =='name') echo '<h1>'.$sub->$v.'</h1>';
							else if ($v =='aim')echo '<i>Objective: '.$sub->$v.'</i><br>';
							else if ($v =='desc')echo $sub->$v.'<br>';
					
						
					}
					echo '<br>';
				}
			}
			
			
			?>
		</div>
	
	</div>
