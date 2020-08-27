@extends('layouts.frontend_app')

@section('frontend_content')
  <!-- .breadcumb-area start -->
      <div class="breadcumb-area bg-img-4 ptb-100">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcumb-wrap text-center">
                          <h2>Contact Us</h2>
                          <ul>
                              <li><a href="{{ url('/') }}">Home</a></li>
                              <li><span>Category</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- .breadcumb-area end -->

<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                  <div class="product-active owl-carousel">
                    <div class="item">
                      <img src="{{ asset('uploads/category_photos') }}/{{ $categories_info->category_photo }}" alt="">
                    </div>
                  </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        <div class="item">
                          <img src="{{ asset('uploads/category_photos') }}/{{ $categories_info->category_photo }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{ $categories_info->category_name }}</h3>
                    <div class="rating-wrap fix">
                        <ul class="rating pull-right">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li>(05 Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{ $categories_info->category_description }}</p>
                    <ul class="input-style">
                        <li class="quantity cart-plus-minus">
                            <input type="text" value="1" />
                        </li>
                        <li><a href="cart.html">Add to Cart</a></li>
                    </ul>
                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li><a href="#">{{$categories_info->category_name}}</a></li>
                    </ul>
                    <div class="color-plate">
                        <p>Color:</p>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="product-size">
                        <p>Size:</p>
                        <ul>
                            <li><a href="#">S</a></li>
                            <li><a href="#">M</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">XL</a></li>
                        </ul>
                    </div>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="description">

                        <div class="description-wrap">
                            <p>{{ $categories_info->category_description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                          @foreach ($faq_all as $faq)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{ $faq->faq_question }}</button> </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                      {{ $faq->faq_answare }}
                                    </div>
                                </div>
                            </div>
                          @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->
<!-- featured-product-area start -->
<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
          @forelse ($product_info as $product)
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <div class="featured-product-img">
                        <img src="{{ asset('uploads/product_photos') }}/{{ $product->product_photo }}" alt="">
                    </div>
                    <div class="featured-product-content">
                        <div class="row">
                            <div class="col-7">
                                <h3><a href="{{ route('productdetails' , $product->slug) }}">{{ $product->product_name }}</a></h3>
                                <p>${{ $product->product_price }}</p>
                            </div>
                            <div class="col-5 text-right">
                                <ul>
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @empty
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <h2 class = "text-danger">No Related Product</h2>
                </div>
            </div>
          @endforelse
        </div>
    </div>
</div>
<!-- featured-product-area end -->

@endsection
