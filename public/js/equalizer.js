$(function() {
	$('#equalizer span').each(function(i) {
		equalizer($(this));
	});
	$('.progress-bar').each(function(i) {
		bars($(this));
	})
})
function equalizer($bar) {
	// Syntax: Math.random() * (max-min = range) + min;
	// My bars will be at least 70px, and at most 170px tall
	var height = Math.random() * 30 + 20;
	// Any timing would do the trick, mine is height times 7.5 to get a speedy yet bouncy vibe
	var timing = height * 7.5;
	// If you need to align them on a baseline, just remove this line and also the "marginTop: marg" from the "animate"
	var marg = (50 - height) / 2;

	$bar.animate({ height: height, marginTop: marg }, timing, function() {
		equalizer($(this));
	});
}
function bars($bar) {
	var maxWidth = $bar.parent().width();
	var percentage = Math.round(Math.random() * .75 + .25);
	var width = maxWidth * percentage;
	console.log(maxWidth);

	var timing = 300;

	$bar.animate({ width: width }, timing, function () {
		bars($(this));
	});
}