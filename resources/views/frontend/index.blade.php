@extends('layouts.frontend_app')

@section('frontend_content')
    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
              @foreach ($banner_all as $banner)
                <div class="swiper-slide overlay">
                    <div class="single-slider slide-inner slide-inner1" style = "background: url({{ asset('uploads/banner_photos') }}/{{ $banner->banner_photo }})">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">{{ $banner->banner_heading }}</h2>
                                            <p data-swiper-parallax="-400">{{ $banner->banner_desciption }}</p>
                                            <a href="{{ $banner->button_link }}" data-swiper-parallax="-300">{{ $banner->banner_button }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->

    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">
                      @foreach ($category_all as $category)
                        <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="">
                                <div class="featured-content">
                                    <a href="{{ route('categoryview' ,$category->id) }}">{{ $category->category_name }}</a>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->

    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->

    <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="{{ asset('frontend_assets') }}/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
              @for ($i = 1; $i < 5; $i++)
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <img src="{{ asset('frontend_assets') }}/images/product/1.jpg" alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="single-product.html">Nature Honey</a></h3>
                            <p class="pull-left">$125
                                <del>$156</del>
                            </p>
                            <ul class="pull-right d-flex">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-half-o"></i></li>
                            </ul>
                        </div>
                    </div>
                </li>
              @endfor
            </ul>
        </div>
    </div>
    <!-- product-area end -->

    <!-- banner-area start -->
    <div class="banner-area bg-img-8">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-6 col-md-8 offset-md-4">
                    <div class="banner-wrap">
                        <p>Neture Oil Collection</p>
                        <h2>upto<span>50%</span> Off</h2>
                        <a href="shop.html">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->

    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
              @foreach ($product_all as $product)
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <span>Sale</span>
                            <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('productdetails' , $product->slug) }}">{{ $product->product_name }}</a></h3>
                            <p class="pull-left">$ {{ $product->product_price }} | 
                                <span class = "pl-1">P: Q: - {{ $product->product_quantity }}</>
                            </p>
                            <ul class="pull-right d-flex">

                            @if (average_stars($product->id) == 0)
                                No Review Yet
                            @endif

                            @for ($i = 1; $i <= average_stars($product->id); $i++) 
                            <li><i class="fa fa-star"></i></li>
                            @endfor

                            </ul>
                        </div>
                    </div>
                </li>
              @endforeach
                <li class="col-12 text-center">
                    <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- product-area end -->

    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                      @forelse ($testmonial_all as $testmonial)
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{ $testmonial->client_review_text }}</p>
                                <h2>{{ $testmonial->client_name }}</h2>
                                <p>{{ $testmonial->client_position }}</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{ asset('uploads/client_photos') }}/{{ $testmonial->client_photo }}" alt="">
                            </div>
                        </div>
                      @empty
                        <div class="test-items test-items2">
                            <span class = "text-danger">No Data Available</span>
                        </div>
                      @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
@endsection
