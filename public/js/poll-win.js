var timer;
$(function () {
	timer = setInterval(poll, 1000);
	$('.close').click(function () {
		$($(this).data('target')).hide();
	});
});

function poll() {
	$.get('ajax/poll', function (data) {
		switch (data) {
			case 'win':
				win();
				break;
			case 'lose':
				lose();
				break;
			default:
				break;
		}
	});
}

function win() {
	$('#winner').show();
	clearInterval(timer);
}

function lose() {
	$('#loser').show();
	clearInterval(timer);
}