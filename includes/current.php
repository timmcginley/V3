<?php

	// if we have an include file for this type - include it...
	
	if ($c->inc)
	{
		include $c->inc;
		
	}
	
	// else check to see if we have a json and display it...
	else if ($c->data)
	{
		$data = json_decode(file_get_contents($c->data));
		$schema = json_decode(file_get_contents($c->schema));
		
		// we should check if the url exists, but first I want to ..... 
		
		foreach ($data as $d)
		{
			if ($d->name ==$URL[1])
			{
			
			foreach($schema->items->required as $k=>$v)
			{
				echo $v.' : '.$d->$v.'<br>';
			}
			}
		}
	}
	
?>