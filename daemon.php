<?php
	require_once('include.inc.php');

	while(1) {

		$desiredTemp = trim(file_get_contents(__DIR__.'/state/desired_temp'));
		$actualTemp  = trim(file_get_contents(__DIR__.'/io/temperature'));

		if($desiredTemp == $actualTemp) {
			systemOff();
		}elseif($actualTemp < $desiredTemp){
			systemHeat();
		}else{
			systemCool();
		}

		file_put_contents(__DIR__.'/state/last_cycle', time());		

		sleep(3);
	}

?>