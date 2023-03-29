@include('layoutbootstrap/header')

@include('layoutbootstrap/sidebar')

<!-- Page level plugins -->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

@yield('konten')                

@include('layoutbootstrap/footer')