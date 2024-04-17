<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" >
  <title>KCCC Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ url('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ url('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ url('admin/plugins/bs-stepper/css/bs-stepper.min.css') }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ url('admin/plugins/dropzone/min/dropzone.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
  <!--<link rel="stylesheet" href="{{ url('admin/css/jquery-ui-1.8.4.custom.css') }}">
  <link rel="stylesheet" href="{{ url('admin/css/jquery-datetimepicker.css') }}">-->

  <link rel="stylesheet" href="{{ url('admin/css/custom.css') }}">
</head>
<body class="hold-transition sidebar-mini dark-mode layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ url('admin/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>-->

@include('admin.layout.header')
@include('admin.layout.sidebar')

@yield('content')

@include('admin.layout.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ url('admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ url('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ url('admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ url('admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('admin/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<!--<script src="{{ url('admin/js/demo.js') }}"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('admin/js/pages/dashboard2.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src= "{{ url('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ url('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ url('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('admin/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ url('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ url('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ url('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ url('admin/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ url('admin/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE App -->
<!-- date-range-picker -->
<script src="{{ url('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!--<script src="{{ url('admin/js/jquery.datetimepicker.full.js') }}"></script>-->

<!-- AdminLTE App -->
<script src="{{ url('admin/js/adminlte.js') }}"></script>

<!-- Custom JS File -->
<script src="{{ url('admin/js/custom.js') }}"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  $(function () {
    $("#cmspages").DataTable();
    $("#tablepages").DataTable({
      "ordering": false,
       scrollY: true,

    });

    $("#divtablepages").DataTable({
       scrollY: true,

    });


    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });




  });
</script>


<script>

  $(function () {
    //'use strict';

    //jQuery('#events_startdate, #events_enddate').datetimepicker({format: 'Y-m-d',timepicker: true });
    
      //Date and time picker

    $('#events_startdate').datetimepicker(
      { 
        format: 'Y-MM-DD HH:mm',
        timePicker: true,
        icons: { time: 'far fa-clock' }
      }
    );


    $('#events_enddate').datetimepicker(
      { 
        format: 'Y-MM-DD HH:mm',
        timePicker: true,
        icons: { time: 'far fa-clock' }
      }
    );

    $('#livecountdowns_datetime').datetimepicker(
      { 
        format: 'Y-MM-DD HH:mm',
        timePicker: true,
        icons: { time: 'far fa-clock' }
      }
    );


    $('#foodbanks_date').datetimepicker(
      { 
        format: 'Y-MM-DD',
      }
    );

    $('#voldatetime').datetimepicker(
      { 
        format: 'Y-MM-DD HH:mm',
        timePicker: true,
        icons: { time: 'far fa-clock' }
      }
    );

    $('#sermons_date').datetimepicker(
      { 
        format: 'Y-MM-DD',
      }
    );

    $('#reviews_year').datetimepicker(
      { 
        format: 'Y',
      }
    );


});

</script>

</body>
</html>
