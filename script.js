function getStatus() {
	$.get('status.php', function(resp){
		var parsed = $.parseJSON(resp);

		$('.current-temp dd').text(parsed.temperature).append('&#8457;');
		$('.ideal-temp').val(parsed.desired);
		$('.temp-readout').text(parsed.desired).append('&#8457;');

		$('.comp-status dd').text(parsed.cool==1?'On':'Off');
		$('.comp-status').removeClass('status-is-1', 'status-is-0').addClass('status-is-'+parsed.cool);
		
		$('.heat-status dd').text(parsed.heat==1?'On':'Off');
		$('.heat-status').removeClass('status-is-1', 'status-is-0').addClass('status-is-'+parsed.heat);
		
		$('.fan-status dd').text(parsed.fan==1?'On':'Off');
		$('.fan-status').removeClass('status-is-1', 'status-is-0').addClass('status-is-'+parsed.fan);
		
		$('.coil-temp dd').text(parsed.ac_coil_temp).append('&#8457;');
		
		$('.coil-cutoff-temp dd').text(parsed.ac_coil_protect).append('&#8457;');

		$('.latency dd').text(parsed.latency+'s');
	});
}

function setDesiredTemp(desiredTemp) {
	$.get('set.php?temp='+desiredTemp, getStatus);
}

$(function(){
	$('.ideal-temp').hide().on('change', function(){
		setDesiredTemp( $(this).val() );
	});

	$('#show-advanced-features').on('change', function(){
		if( this.checked ) {
			$('.advanced').show();
		} else {
			$('.advanced').hide();
		}
	});

	$('body').on('dblclick', '.temperature-set button.temp-up', function(){
		var input = $(this).closest('.temperature-set').find('input');
		input.val( parseInt(input.val()) + 10 ).trigger('change');
	});


	$('body').on('click', '.temperature-set button.temp-up', function(){
		var input = $(this).closest('.temperature-set').find('input');
		input.val( parseInt(input.val()) + 1 ).trigger('change');
	});


	$('body').on('click', '.temperature-set button.temp-dn', function(){
		var input = $(this).closest('.temperature-set').find('input');
		input.val( parseInt(input.val()) - 1 ).trigger('change');
	});

	$('body').on('dblclick', '.temperature-set button.temp-dn', function(){
		var input = $(this).closest('.temperature-set').find('input');
		input.val( parseInt(input.val()) - 10 ).trigger('change');
	});


	window.setInterval(getStatus, 2000);
});