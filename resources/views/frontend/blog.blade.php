@extends('layouts.frontend_app')

@section('frontend_content')
  <!-- .breadcumb-area start -->
   <div class="breadcumb-area bg-img-4 ptb-100">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="breadcumb-wrap text-center">
                       <h2>Blog Page</h2>
                       <ul>
                           <li><a href="index-2.html">Home</a></li>
                           <li><span>Blog</span></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- .breadcumb-area end -->
   <!-- blog-area start -->
   <div class="blog-area">
       <div class="container">
           <div class="col-lg-12">
               <div class="section-title  text-center">
                   <h2>Latest News</h2>
                   <img src="assets/images/section-title.png" alt="">
               </div>
           </div>
           <div class="row">
             @foreach ($blog_all as $blog)
               <div class="col-lg-4  col-md-6 col-12">
                   <div class="blog-wrap">
                       <div class="blog-image">
                           <img src="{{ asset('uploads/blog_photos') }}/{{ $blog->blog_photo }}" alt="">
                           <ul>
                               <li>{{ $blog->created_at->format('d') }}</li>
                               <li>{{ $blog->created_at->format('M') }}</li>
                           </ul>
                       </div>
                       <div class="blog-content">
                           <div class="blog-meta">
                               <ul>
                                   <li><a href="#"><i class="fa fa-user"></i> {{ $blog->relation_with_user_table->name }}</a></li>
                                   <li><a href="#"><i class="fa fa-heart"></i> Love</a></li>
                                   <li><a href="#"><i class="fa fa-comments"></i> 15 Comments</a></li>
                               </ul>
                           </div>
                           <h3><a href="{{ route('blogdetails' , $blog->slug) }}">{{ $blog->blog_title }}</a></h3>
                           <p>{{ $blog->blog_long_description }}</p>
                       </div>
                   </div>
               </div>
             @endforeach
               <div class="col-12">
                   <div class="pagination-wrapper text-center mb-30">
                       <ul class="page-numbers">
                           <li><a class="prev page-numbers" href="#"><i class="fa fa-arrow-left"></i></a></li>
                           <li><span class="page-numbers current">1</span></li>
                           <li><a class="page-numbers" href="#">2</a></li>
                           <li><a class="page-numbers" href="#">3</a></li>
                           <li><a class="next page-numbers" href="#"><i class="fa fa-arrow-right"></i></a></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- blog-area end -->
@endsection
