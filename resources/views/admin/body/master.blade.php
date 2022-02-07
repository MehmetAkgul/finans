<!DOCTYPE html>
<html lang="tr">
<!--begin::Head-->

<head>
    @include('admin.body.head')
    @yield('page-level-css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    <!-- Navbar -->
@include('admin.body.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('admin.body.sidebar')

<!-- Content Wrapper. Contains page content -->
@yield('master')
<!-- /.content-wrapper -->


    <!-- Main Footer -->
@include('admin.body.footer')

<!-- Control Sidebar -->
@include('admin.body.control-sidebar')
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<!-- REQUIRED SCRIPTS -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script> $.widget.bridge('uibutton', $.ui.button)</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.js')}}"></script>

<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>


<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>


<script type="text/javascript">
    $('.select2').select2();

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

</script>

@yield('page-level-script')

</html>



