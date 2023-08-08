
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="#">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img desktop-logo" alt="logo">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img toggle-logo" alt="logo">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img light-logo" alt="logo">
            <img src="/assets/images/brand/cidsan-logo.png" class="header-brand-img light-logo1" alt="logo">
        </a><!-- LOGO -->
    </div>
    <ul class="side-menu">
        <li><h3>Main</h3></li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('view-profile', Auth::user()->slug) }}">
                <i class="ti-user mr-2"></i>
                <span class="side-menu__label">Profile</span>
            </a>
        </li>
       <!-- <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <i class="ti-briefcase mr-2"></i>
                <span class="side-menu__label">Examination</span><i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="route('register-exams')}}" class="slide-item"> Register Exams</a></li>
                <li><a href="route('my-exams')}}" class="slide-item">My Exams</a></li>
            </ul>
        </li> -->

    </ul>
</aside>
