@include('partials._header')

<body class="app sidebar-mini">
<div class="page">
    <div class="page-main">
        @if(\Illuminate\Support\Facades\Auth::user()->user_type == 0)
            @include('partials._sidebar-menu')
        @else
            @include('partials._admin-sidebar-menu')
        @endif
        @include('partials._app-header')
        <div class="app-content">
            <div class="side-app">
                @include('partials._breadcrumb')
                @yield('main-content')
            </div>
        </div>
    </div>


@include('partials._footer')
</div>

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
@include('partials._footer-scripts')
