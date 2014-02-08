<?php 
require_once('include.inc.php');

	$desiredTemp = trim(file_get_contents(dirname(__FILE__).'/state/desired_temp'));
	$actualTemp  = trim(file_get_contents(dirname(__FILE__).'/io/temperature'));

	if($desiredTemp == $actualTemp) {
		systemOff();
	}elseif($actualTemp < $desiredTemp){
		systemHeat();
	}else{
		systemCool();
	}

	file_put_contents(dirname(__FILE__).'/state/last_cycle', time());		



echo json_encode( getStatus() );

?>