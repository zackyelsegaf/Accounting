<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Easy Accounting</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{URL::to('assets/img/logo_EA7.svg')}}">
	<link rel="stylesheet" href="{{URL::to('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/plugins/fontawesome/css/all.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('assets/css/feathericon.min.css')}}">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="{{URL::to('assets/plugins/morris/morris.css')}}">
	<link rel="stylesheet" href="{{URL::to('assets/css/style.css')}}"> </head>

	<!-- Moment.js -->
	<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

	<!-- Daterangepicker -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<body>
	@yield('content')

	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
	<script src="{{URL::to('assets/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{URL::to('assets/js/popper.min.js')}}"></script>
	<script src="{{URL::to('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{URL::to('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{URL::to('assets/js/script.js')}}"></script>

</body>

</html>