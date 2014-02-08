<?php
	require_once('include.inc.php');

	file_put_contents(__DIR__.'/state/last_cycle', time());

	$desiredTemp = intval($status['desired']);
	$actualTemp  = intval($status['temperature']);

	if($desiredTemp == $actualTemp) {
		systemOff();
	}elseif($actualTemp < $desiredTemp){
		systemHeat();
	}else{
		systemCool();
	}
?>