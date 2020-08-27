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
                              <li><a href="index-2.html">Home</a></li>
                              <li><span>Contact</span></li>
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
                      <img src="{{ asset('uploads/product_photos') }}/{{ $actvie_product->product_photo }}" alt="">
                    </div>

                    @foreach ($actvie_product->relation_with_product_image_table as $single_photo)
                      <div class="item">
                        <img src="{{ asset('uploads/product_multiple_photos') }}/{{ $single_photo->product_multiple_image_name }}" alt="">
                      </div>
                    @endforeach
                  </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        <div class="item">
                          <img src="{{ asset('uploads/product_photos') }}/{{ $actvie_product->product_photo }}" alt="">
                        </div>
                        @foreach ($actvie_product->relation_with_product_image_table as $single_photo)
                          <div class="item">
                            <img src="{{ asset('uploads/product_multiple_photos') }}/{{ $single_photo->product_multiple_image_name }}" alt="">
                          </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{ $actvie_product->product_name }}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">${{ $actvie_product->product_price }}</span>
                        <ul class="rating pull-right">

                            @if (average_stars($actvie_product->id) == 0)
                                No Review Yet
                            @endif

                            @for ($i = 1; $i <= average_stars($actvie_product->id); $i++) 
                             <li><i class="fa fa-star"></i></li>
                            @endfor

                            <li>({{ review_customer_count($actvie_product->id) }} Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{ $actvie_product->product_short_description }}</p>
                    <ul class="input-style">

                      <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        <input type="hidden" value = "{{ $actvie_product->id }}" name = "product_id">
                        <li class="quantity cart-plus-minus">
                          <input type="text" value="1" name = "product_quantity">
                        </li>
                        <li>
                          <button type="submit" class = "btn btn-danger">Add to Cart</button>
                        </li>
                      </form>

                    </ul>
                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li><a href="#">{{$actvie_product->relation_with_category_table->category_name}}</a></li>
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
                            <p>{{ $actvie_product->product_long_description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                          @foreach ($faq_all as $faq)
                            <div class="card">
                                <div class="card-header" id="heading_{{ $faq->id }}">
                                    <h5><button data-toggle="collapse" data-target="#collapse_{{ $faq->id }}" aria-expanded="true" aria-controls="collapse_{{ $faq->id }}">{{ $faq->faq_question }}</button> </h5>
                                </div>
                                <div id="collapse_{{ $faq->id }}" class="collapse" aria-labelledby="heading_{{ $faq->id }}" data-parent="#accordion">
                                    <div class="card-body">
                                      {{ $faq->faq_answare }}
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="review">

                        <div class="review-wrap">
                            <ul>
                                @foreach ($reviews as $review)
                                    <li class="review-items">
                                        <div class="review-img">
                                            <img src="assets/images/comment/1.png" alt="">
                                        </div>
                                        <div class="review-content">
                                            <h3><a href="#">{{ App\user::find($review->user_id)->name }}</a></h3>
                                            <span>{{ $review->created_at->format('d M,Y') }} AT Time After</span>
                                            <p>Comment: {{ $review->review }}</p>
                                            <ul class="rating">
                                                @for ($i = 1; $i <= $review->stars; $i++)
                                                   <li><i class="fa fa-star"></i></li>
                                                @endfor

                                               
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                               
                            </ul>
                        </div>


                        @auth
                        @if ($show_review_from == 1)
                        <div class="add-review">
                            <h4>Your Review</h4>
                            
                            
                           <form action="{{ url('review/post') }}" method="POST">
                            @csrf

                            <div class="ratting-wrap">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>task</th>
                                            <th>1 Star</th>
                                            <th>2 Star</th>
                                            <th>3 Star</th>
                                            <th>4 Star</th>
                                            <th>5 Star</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Review</td>
                                            <td>
                                                <input type="radio" name="stars" value="1"/>
                                            </td>
                                            <td>
                                                <input type="radio" name="stars" value="2"/>
                                            </td>
                                            <td>
                                                <input type="radio" name="stars" value="3"/>
                                            </td>
                                            <td>
                                                <input type="radio" name="stars" value="4"/>
                                            </td>
                                            <td>
                                                <input type="radio" name="stars" value="5"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Your Review:</h4>
                                    <input type="hidden" name = "order_details_id" value = "{{ $order_details_id }}">
                                    <textarea name="review" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn-style">Submit</button>
                                </div>
                            </div>
                        </form>
                        </div>
                      @else
                        
                      @endif

                        @endauth
                        @guest
                         Please Login First    
                        @endguest
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
          @forelse ($related_products as $related_product)
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <div class="featured-product-img">
                        <img src="{{ asset('uploads/product_photos') }}/{{ $related_product->product_photo }}" alt="">
                    </div>
                    <div class="featured-product-content">
                        <div class="row">
                            <div class="col-7">
                                <h3><a href="{{ route('productdetails' , $related_product->slug) }}">{{ $related_product->product_name }}</a></h3>
                                <p>${{ $related_product->product_price }}</p>
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
