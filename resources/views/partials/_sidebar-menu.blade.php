
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{route('dashboard', ['account'=>$account])}}">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img desktop-logo" alt="logo">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img toggle-logo" alt="logo">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img light-logo" alt="logo">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img light-logo1" alt="logo">
        </a><!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>Main</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 4h18v10H3z" opacity=".3"/><path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7l-2 3v1h8v-1l-2-3h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 12H3V4h18v10z"/></svg>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-briefcase mr-2"></i>
                <span class="side-menu__label">Examination</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="{{route('register-exams')}}" class="slide-item"> Register Exams</a></li>
                <li><a href="{{route('my-exams')}}" class="slide-item">My Exams</a></li>
            </ul>
        </li>

    </ul>
</aside>
