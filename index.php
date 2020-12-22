

<?php
	
	/*
		TODO: Sort out the mess below with the roleMenu div visibility hack. We really only should build it if we need it. 
		IDEA: Maybe each subject is an a=href refresh of the page and the state is still js ajax. I think that is kinda what is happening now its just not tight yet.
	*/
	
	// get the data from the AJAX function.
	$subject = $_REQUEST["subject"]; // div to be updated
	$state = $_REQUEST["state"]; // div to be updated
	
	
	// this needs to check what we are looking for i.e. is this subject specific perspective? is it general?
	$roles = json_decode(file_get_contents('reqs/'.$RFP_id.'/config/roles.json'));
	?>
	
	<div class="inner" id='main'>
		<br>
		<logo><?php echo $RFP_DATA->name.' ('.$RFP_DATA->course_code.')'?></logo><br><hr>
	
		<div class='flex flex-2'>
			<article style="flex-grow:1"> 
			
				<?php // over section ?>
				
				<button onclick="getOver('0','<?php echo $RFP_id;?>','<?php echo $subject;?>')">Course</button>
				<button onclick="getOver('1','<?php echo $RFP_id;?>','<?php echo $subject;?>')">Project</button>
				<button onclick="getOver('2','<?php echo $RFP_id;?>','<?php echo $subject;?>')">Subjects</button>
				<button onclick="getOver('3','<?php echo $RFP_id;?>','<?php echo $subject;?>')">Stages</button>
				<button onclick="getOver('4','<?php echo $RFP_id;?>','<?php echo $subject;?>')">Help</button>
				<button onclick="getOver('5','<?php echo $RFP_id;?>','<?php echo $subject;?>')">Notes</button>
				<br>
				
				<div id='over'>
				
					<?php if ($subject>-1) { ?>
						<script>getOver(2,<?php echo $RFP_id;?>);</script>
					<?php } else {?>
						<script>getOver(2,<?php echo $RFP_id;?>);</script>
					<?php } ?>	
						
				</div>
				<br>
				<?php // role section  - this is definately not the cleanest way to do this and needs to be sorted out!?>
				
				<div id = 'roleMenu'>
					<?php foreach ($roles as $r) { ?>
					<a style="color:#000; padding:0.2em; background-color:<?php if ($subject == $r->subject)echo $r->hex; else echo '#ccc';?>" href="?subject=<?php echo $r->subject; ?>"><?php echo $r->name;?></a>
					<?php } ?>
				</div>
				<div id='parts'>
					<script>getRole(5,<?php echo $RFP_id;?>,<?php echo $subject;?>);</script>
				</div>
				
			</article>
		
		<article style="flex-shrink:1" >
			<?php // side section 
			include 'properties.php'?>
			
		</article>
		
	</div>
	
	</div>
	<script> according(); </script>
