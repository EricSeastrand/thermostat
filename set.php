<?php
	$newTemp = intval($_GET['temp']);
	
	if($newTemp < 40)
		$newTemp = 40;
	elseif($newTemp > 90)
		$newTemp = 90;

	file_put_contents(dirname(__FILE__).'/state/desired_temp', $newTemp );


	require_once('include.inc.php');
	echo json_encode( $status );

?>