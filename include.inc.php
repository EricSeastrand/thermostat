<?php

function getConstants($byKey = false) {
	$conf = array(
		'ac_coil_protect' => 40
	);

	if($byKey !== false)
		return $conf[$byKey];
	else
		return $conf;
}

function getStatus() {
	$status = array(
		'temperature'  => trim(file_get_contents(dirname(__FILE__).'/io/temperature')),
		'ac_coil_temp' => trim(file_get_contents(dirname(__FILE__).'/io/ac_coil_temp')),
		'fan'          => trim(file_get_contents(dirname(__FILE__).'/io/gpio_fan')),
		'cool'         => trim(file_get_contents(dirname(__FILE__).'/io/gpio_comp')),
		'heat'         => trim(file_get_contents(dirname(__FILE__).'/io/gpio_heat')),
		'desired'      => trim(file_get_contents(dirname(__FILE__).'/state/desired_temp')),
		'latency'      => ( time() - intval(file_get_contents(dirname(__FILE__).'/state/last_cycle')) ) ,
		'now'          => time()
	);

	return array_merge($status, getConstants());
}

function fanOn() {
	file_put_contents(dirname(__FILE__).'/state/fan_run_until', time() + 30);

	file_put_contents(dirname(__FILE__).'/io/gpio_fan', '1');
}

function fanOff() {
	$fanTimeout = intval(trim(file_get_contents(dirname(__FILE__).'/state/fan_run_until')));
	
	if(time() > $fanTimeout) {
		file_put_contents(dirname(__FILE__).'/state/fan_run_until', '0');
		file_put_contents(dirname(__FILE__).'/io/gpio_fan', '0');
	}
}


function coolOn() {
	// If the coil goes under a certain temperature, turn off to avoid freeze-over
	if( trim(file_get_contents(dirname(__FILE__).'/io/ac_coil_temp')) < getConstants('ac_coil_protect') )
		coolOff();
	else
		file_put_contents(dirname(__FILE__).'/io/gpio_comp', '1');

}
function coolOff() {
	file_put_contents(dirname(__FILE__).'/io/gpio_comp', '0');
}


function heatOn() {
	file_put_contents(dirname(__FILE__).'/io/gpio_heat', '1');
}
function heatOff() {
	file_put_contents(dirname(__FILE__).'/io/gpio_heat', '0');
}

function systemOff() {
	coolOff();
	heatOff();
	fanOff();
}

function systemHeat() {
	fanOn();
	heatOn();
	coolOff();
}

function systemCool() {
	fanOn();
	heatOff();
	coolOn();
}


?>