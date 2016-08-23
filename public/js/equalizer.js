$(function() {
	$('#equalizer span').each(function(i) {
		equalizer($(this));
	});
	$('.progress-bar').each(function(i) {
		bars($(this));
	})
})
function equalizer($bar) {
	var height = Math.random() * 30 + 20;
	var timing = height * 7.5;
	var marg = (50 - height) / 2;

	$bar.animate({ height: height, marginTop: marg }, timing, function() {
		equalizer($(this));
	});
}
function bars($bar) {
	var maxWidth = $bar.parent().width();
	var percentage = Math.round(Math.random() * .75 + .25);
	var width = maxWidth * percentage;

	var timing = 300;

	$bar.animate({ width: width }, timing, function () {
		bars($(this));
	});
}