@extends('layouts.marketplace-layout')

@section('title')
{{$vendor->company_name ?? '' }}'s Store
@endsection
@section('current-page')
{{$vendor->company_name ?? '' }}'s Store
@endsection

@include('partials.marketplace._header')
<body>
<div class="page-wrapper">
    <h1 class="d-none">CNX Retail</h1>
    <!-- Start of Header -->
    <header class="header header-border">
        <div class="header-middle">
            <div class="container">
                @include('partials.marketplace._search-bar')
            </div>
        </div>
        <div class="header-bottom sticky-content fix-top sticky-header">
            <div class="container">
                <div class="inner-wrap">
                    <div class="header-left">
                        <div class="dropdown category-dropdown has-border" data-visible="true">
                            <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="true" data-display="static"
                               title="Browse Categories">
                                <i class="w-icon-category"></i>
                                <span>Browse Categories</span>
                            </a>
                            <div class="dropdown-box">
                                <ul class="menu vertical-menu category-menu">
                                    @foreach($categories as $cat)
                                        <li>
                                            <a href="{{route('product-category', $cat->slug)}}">
                                                <i class="w-icon-angle-right"></i>{{$cat->category_name ?? '' }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <nav class="main-nav">
                            <ul class="menu active-underline">
                                <li>
                                    <a href="{{route('homepage')}}">Home</a>
                                </li>
                                <li>
                                    <a href="{{route('marketplace')}}">Marketplace</a>
                                </li>
                                <li>
                                    <a href="{{route('contact-us')}}">Contact us</a>
                                </li>
                                <li>
                                    <a href="{{route('login')}}">Login</a>
                                </li>
                                <li>
                                    <a href="{{route('register')}}">Start Trial</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @section('main-content')
        <div class="container">
            <div class="shop-content row gutter-lg">
                <!-- Start of Sidebar, Shop Sidebar -->
                <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                    <!-- Start of Sidebar Overlay -->
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                    <!-- Start of Sidebar Content -->
                    <div class="sidebar-content scrollable">
                        <!-- Start of Sticky Sidebar -->
                        <div class="sticky-sidebar">
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title"><span>All Vendors</span></h3>
                                <ul class="widget-body filter-items search-ul">
                                    @foreach($vendors as $vendor)
                                        <li><a href="{{route('vendor-store', $vendor->slug)}}">{{$vendor->company_name ?? '' }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="main-content">
                    <div class="store store-banner mb-4">
                        <figure class="store-media">
                            <img src="/assets/marketplace/assets/images/vendor/retail.png" alt="Vendor" width="930" height="446" style="background-color: #414960;">
                        </figure>
                        <div class="store-content">

                            <h4 class="store-title">{{$tenant->company_name ?? '' }}</h4>
                            <ul class="seller-info-list list-style-none mb-6">
                                <li class="store-address">
                                    <i class="w-icon-map-marker"></i>
                                    {{$tenant->address ?? '-' }}
                                </li>
                                <li class="store-phone">
                                    <a href="tel:1234567890">
                                        <i class="w-icon-phone"></i>
                                        {{$tenant->phone_no ?? '-' }}
                                    </a>
                                </li>
                                <li class="store-rating">
                                    <i class="w-icon-envelop"></i>
                                    {{$tenant->email ?? '-' }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <div class="toolbox-left">
                            <h3>{{$tenant->company_name ?? '' }}'s Products</h3>
                        </div>

                    </nav>
                    <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                        @if($items->count() > 0)
                        @foreach($items as $item)
                            <div class="product-wrap">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{route('view-item', $item->slug)}}">
                                            <img src="/assets/drive/{{$item->getItemFirstGalleryImage($item->id)->attachment ?? 'image.jpg'}}" alt="Product" width="274"
                                                 height="309" style="width:274px !important; height:309px !important;" />
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <div class="product-cat">
                                            <a href="{{route('view-item', $item->slug)}}">{{ $item->getCategory->category_name ?? '' }}</a>
                                        </div>
                                        <h3 class="product-name">
                                            <a href="{{route('view-item', $item->slug)}}">{{ strlen($item->item_name) > 28 ? substr($item->item_name,0,25).'...' : $item->item_name}}</a>
                                        </h3>
                                        <div class="product-pa-wrapper">
                                            <div class="product-price">
                                                ₦{{number_format($item->selling_price,2)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <h4>No products found.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
<!-- End of Page Wrapper -->



@include('partials.marketplace._footer-script')
