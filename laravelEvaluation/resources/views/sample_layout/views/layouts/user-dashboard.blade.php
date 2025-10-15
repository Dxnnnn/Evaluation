@extends('layouts.app')
@push('css')
 <!-- If you have an specific CSS for this page, declare here. -->
@endpush
@section('content')
<div class="container-scroller">
    <!--header-->
    @include('common._headermenu')
    <div class="container-fluid page-body-wrapper">
        <div class="sidebar-main-panel-wrapper">
            <!--side_menu-->
            @include('common._sidemenu')
            <!-- main panel -->
            <div class="main-panel" id="master_panel">
                <div class="content-wrapper">
                    <div id="main_content">
                        @yield('maincontent')
                    </div>
                </div>
                <!-- footer -->
            </div>
        </div>
    </div>
    @include('common._footer')
</div>
@push('scripts')
<script src="{{ asset('assets/js/demo_1/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>
@endpush
@endsection
