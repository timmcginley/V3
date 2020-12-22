<?php

// LOAD ALL INSTANCES we display the name in the 
echo "<span style='float:left;background-color:#ff0;padding:2em;border-radius:10px;margin:2em;'>";
echo "EACH ONE NEEDS TO PROVIDE A DESCRIPTION OF THE CONCEPT....";
echo "</span>";
	if ($c->data)
	{
		
		$data = json_decode(file_get_contents($c->data));
		$schema = json_decode(file_get_contents($c->schema));
		
		// we should check if the url 1 exists, but first I want to ..... 
		echo "<div style='width:100%;float:left;'>"; 
		foreach ($data as $d)
		{
		
			echo "<div style='margin:10px;background-color:#fff;padding:15px;padding-top:0px;border: dashed #ddd 1px;border-radius:5px;float:left'>";
			foreach($schema->items->required as $k=>$v)
			{
				if($v=='name')
					echo "<h3><a href='".$url."/".$version."/".$c->test."/".$d->$v."'>".$d->$v.'</a></h3>';
				else
				{
					
					if(is_array($d->$v) && ($v=='segments')) 
					{
						foreach($d->$v as $q)
						echo '&nbsp;'.$q->flrs.' x '.$q->name.' floors @'.$q->f2f.'m<br>';
					}
					else 

					echo $v.' : '.$d->$v.'<br>';
			
				}
			}
			
			echo '</div>';
			
		}
		echo '</div>';
	
	}
	


?>