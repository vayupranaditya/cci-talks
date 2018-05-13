<?php
	
	error_reporting(0);

	header('Content-Type: application/json');
	
	if(isset($_GET['nim']))
	{
		$nim=$_GET['nim'];
	
		$request = array(
			'http' => array(
				'method' => 'POST',
				'content' => http_build_query(array(
					'term' => $nim,
					'unnamed' => 'sisfo'
				)),
			));

		$context = stream_context_create($request);
		
		$html = file_get_contents('https://igracias.telkomuniversity.ac.id/libraries/ajax/ajax.dashboard.php?act=messagereceiver', false, $context);
		
		if($html!=='null')
		{	
			print_r(json_decode($html)[0]);
			$user=json_decode($html)[0]->title;
			$user=explode(' - ',$user);
			
			date_default_timezone_set("Asia/Jakarta");
			$datetime=date("M d Y H:m:s");
			
			echo sprintf("%s(%s) has been confirmed to attend at %s using %s \n",
				$user[1],
				$nim,
				$datetime,
				$_SERVER['REMOTE_ADDR']);
		}
		else
		{
			echo sprintf("student with student id: %s is not found.\n",
				$nim);
		}
		
	}
	else
	{
		echo 'no nim';
	}