$(document).ready(function() {
$('#datepicker-container .input-group.date').datepicker({
	format: "yyyy-mm-dd",
	autoclose: true,
	todayHighlight: true
});


/*
	$('#datepicker-range .input-daterange').datepicker({
		format: "yyyy-mm-dd",
		startDate: "today",
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true
	});
*/
/*
$('#datepicker .input-group.date').datepicker({
    format: "yyyy-mm-dd",
    startDate: "today",
    todayHighlight: true
});

/*
$('#basicExample .time').timepicker({
	'showDuration': true,
	'timeFormat': 'g:i'
});

$('#basicExample .date').datepicker({
	format: "yyyy-mm-dd",
	startDate: "today",
	todayBtn: "linked",
	autoclose: true,
	todayHighlight: true
});

// initialize datepair
$('#basicExample').datepair();

$('#paired').datepair();
$('#paired .date').datepicker({
	format: "yyyy-mm-dd",
	startDate: "today",
	todayBtn: "linked",
	autoclose: true,
	todayHighlight: true
});
$('#paired .time').timepicker({
	'showDuration': true,
	step:5,
	'timeFormat': 'g:i'
});
/*
$('#image_button').click(function(){
	$('.date').datepicker('show');
});
*/
});
