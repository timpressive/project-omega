@extends('layout.main')
@section('title', 'Overzicht')
@section('content')
<div class="starter-template">
	<main>
		<h2>Overzicht</h2>
		<p>
			Dit is het besturingspaneel voor Project Omega. Hierlangs wordt al het onderhoud uitgevoerd.<br>
			Voor hulp: neem contact op met de technische dienst.
		</p>
		<p>Grote veranderingen en interacties gebeuren via de <a class="console" href="console">console</a>.</p>

		<h2>Status</h2>
		<div class="stats pull-right">
			<p>Energieverbruik: <span class="pull-right">1.5W</span></p>
			<p>Afsluiting: <span class="green pull-right">INTACT</span></p>
			<p>Beveiliging: <span class="green pull-right">100%</span></p>
			<p class="temp-label">Temperatuur: <span class="temp-label pull-right">3.08°C</span></p>
		</div>
		<div class="temp">
			<div id="temp">
			</div>
		</div>
	</main>
</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('js/lib/jqwidgets/jqxcore.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/lib/jqwidgets/jqxchart.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/lib/jqwidgets/jqxgauge.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#temp').jqxGauge({
				ranges: [{ startValue: 0, endValue: 3, style: { fill: '#6AFC6A', stroke: '#6AFC6A' }, endWidth: 10, startWidth: 1 },
					{ startValue: 3, endValue: 5, style: { fill: '#FCF06A', stroke: '#FCA76A' }, endWidth: 15, startWidth: 10 },
					{ startValue: 5, endValue: 6, style: { fill: '#FC6A6A', stroke: '#FC6A6A' }, endWidth: 20, startWidth: 15}],
				ticksMinor: { interval: 10, size: '5%' },
				ticksMajor: { interval: 20, size: '10%' },
				value: 0,
                labels: { interval: 1 },
				max: 6,
				caption: {
					value: 'Temp.in °C',
					position: 'bottom',
					offset: [0, 10],
					visible: true
				},
				colorScheme: 'scheme04',
				animationDuration: 1200
			});

			$('.console').click(function (e) {
				e.preventDefault();
				console.error('click');
				$.get('json/keypad', function (data) {
					console.log(data);
				});
			});

		    setInterval(function() {
		    	var val = Math.random() * (3.55 - 2.9) + 2.9;
				$('#temp').jqxGauge({value: val});
				$('.stats .temp-label span').text(Math.round(val*100)/100 + '°C');
				if (val > 3) {
					$('.stats .temp-label span').removeClass('green');
				} else {
					$('.stats .temp-label span').addClass('green');
				}
		    }, 700);
		});
	</script>
@stop