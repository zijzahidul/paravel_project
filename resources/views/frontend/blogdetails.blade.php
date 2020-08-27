@extends('layouts.frontend_app')

@section('frontend_content')

<!-- .breadcumb-area start -->
   <div class="breadcumb-area bg-img-4 ptb-100">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="breadcumb-wrap text-center">
                       <h2>Blog Details</h2>
                       <ul>
                           <li><a href="index-2.html">Home</a></li>
                           <li><span>Blog Details</span></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- .breadcumb-area end -->
   
   <!-- blog-details-area start-->
   <div class="blog-details-area ptb-100">
       <div class="container">
           <div class="row">
               <div class="col-lg-9 col-12">
                   <div class="blog-details-wrap">
                       <img src="{{ asset('uploads/blog_photos') }}/{{ $blog_details_info->blog_photo }}" alt="">
                       <h3>{{ $blog_details_info->blog_title }}</h3>
                       <ul class="meta">
                           <li>{{ $blog_details_info->created_at->format('d M Y') }}</li>
                           <li>{{ $blog_details_info->relation_with_user_table->name }}</li>
                       </ul>
                       <p>{{ $blog_details_info->blog_short_description }}</p>
                       <p>{{ $blog_details_info->blog_long_description }}</p>
                       <ul class="list">
                           <li>Ever since the 1500s, when an unknown </li>
                           <li>Remaining essentially unchanged. </li>
                           <li>Ipsum has been the industry </li>
                           <li>It was popularised in the 1960s with </li>
                           <li>Printer took a galley of type and scrambled </li>
                       </ul>
                       <p>{{ $blog_details_info->blog_long_description }}</p>
                       <div class="row mb-30">
                           <div class="col-md-5 col-12">
                               <img src="{{ asset('uploads/blog_photos') }}/{{ $blog_details_info->blog_photo }}" alt="">
                           </div>
                           <div class="col-md-7 col-12">
                               <p>{{ $blog_details_info->blog_short_description }}</p>
                           </div>
                       </div>
                       <p>{{ $blog_details_info->blog_long_description }}</p>
                       <div class="share-wrap">
                           <div class="row">
                               <div class="col-sm-7 ">
                                   <ul class="socil-icon d-flex">
                                       <li>share it on :</li>
                                       <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                       <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                       <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                       <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                       <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                   </ul>
                               </div>
                               <div class="col-sm-5 text-right">
                                   <a href="javascript:void(0);">Next Post <i class="fa fa-long-arrow-right"></i></a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="comment-form-area">
                       <div class="comment-main">
                           <h3 class="blog-title"><span>(03)</span>Comments:</h3>
                           <ol class="comments">
                               <li class="comment even thread-even depth-1">
                                   <div class="comment-wrap">
                                       <div class="comment-theme">
                                           <div class="comment-image">
                                               <img src="assets/images/comment/1.png" alt="Jhon">
                                           </div>
                                       </div>
                                       <div class="comment-main-area">
                                           <div class="comment-wrapper">
                                               <div class="sewl-comments-meta">
                                                   <h4>Lily Justin </h4>
                                                   <span>19 JAN 2019  at 2:30pm</span>
                                               </div>
                                               <div class="comment-area">
                                                   <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                   <div class="comments-reply">
                                                       <a rel="nofollow" class="comment-reply-link" href="#0" onclick="return addComment.moveForm( &quot;comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )" aria-label="Reply to Mr WordPress"><span class="comment-reply-link"><i class="fa fa-reply"></i> Reply</span></a>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <ul class="children">
                                       <li class="comment odd alt">
                                           <div class="comment-wrap comment-wrap1">
                                               <div class="comment-theme">
                                                   <div class="comment-image">
                                                       <img src="assets/images/comment/2.png" alt="Jhon">
                                                   </div>
                                               </div>
                                               <div class="comment-main-area">
                                                   <div class="comment-wrapper">
                                                       <div class="sewl-comments-meta">
                                                           <h4>Michel Frost</h4>
                                                           <span>19 JAN 2019  at 2:30pm</span>
                                                       </div>
                                                       <div class="comment-area">
                                                           <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                           <div class="comments-reply">
                                                               <a rel="nofollow" class="comment-reply-link" href="#0" onclick="return addComment.moveForm( &quot;comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )" aria-label="Reply to Mr WordPress"><span class="comment-reply-link"><i class="fa fa-reply"></i> Reply</span></a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                   </ul>
                                   <ul class="children">
                                       <li class="comment odd alt">
                                           <div class="comment-wrap">
                                               <div class="comment-theme">
                                                   <div class="comment-image">
                                                       <img src="assets/images/comment/3.png" alt="Jhon">
                                                   </div>
                                               </div>
                                               <div class="comment-main-area">
                                                   <div class="comment-wrapper">
                                                       <div class="sewl-comments-meta">
                                                           <h4>Michele Anderson</h4>
                                                           <span>19 JAN 2019  at 2:30pm</span>
                                                       </div>
                                                       <div class="comment-area">
                                                           <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                           <div class="comments-reply">
                                                               <a rel="nofollow" class="comment-reply-link" href="#0" onclick="return addComment.moveForm( &quot;comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )" aria-label="Reply to Mr WordPress"><span class="comment-reply-link"><i class="fa fa-reply"></i> Reply</span></a>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </li>
                                   </ul>
                               </li>
                           </ol>
                       </div>
                       <div id="respond" class="sewl-comment-form comment-respond form-style">
                           <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                           <form novalidate="" method="post" id="commentform" class="comment-form" action="#0">
                               <div class="row">
                                   <div class="col-12">
                                       <div class="sewl-form-inputs no-padding-left">
                                           <div class="row">
                                               <div class="col-sm-6 col-12">
                                                   <input id="name" name="name" value="" tabindex="2" placeholder="Name" type="text">
                                               </div>
                                               <div class="col-sm-6 col-12">
                                                   <input id="email" name="email" value="" tabindex="3" placeholder="Email" type="email">
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="sewl-form-textarea no-padding-right">
                                           <textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-submit">
                                           <input name="submit" id="submit" value="Send" type="submit">
                                           <input name="comment_post_ID" value="1" id="comment_post_ID" type="hidden">
                                           <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                                       </div>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-12">
                   <aside class="sidebar-area">
                       <div class="widget widget_search">
                           <h4 class="widget-title">Search Product</h4>
                           <form action="#" class="searchform">
                               <input type="text" name="s" placeholder="Search Product...">
                               <button type="submit"><i class="fa fa-search"></i></button>
                           </form>
                       </div>
                       <div class="widget widget_categories">
                           <h4 class="widget-title">Categories</h4>
                           <ul>
                               <li><a href="#">Coconut Oil</a></li>
                               <li><a href="#">Honey</a></li>
                               <li><a href="#">Olive Oil</a></li>
                               <li><a href="#">Nut Oil</a></li>
                               <li><a href="#">Mustard Oil</a></li>
                               <li><a href="#">Sunrise Oil</a></li>
                           </ul>
                       </div>
                       <div class="widget widget_recent_entries recent_post">
                           <h4 class="widget-title">Recent Post</h4>
                           <ul>
                             @foreach ($blog_all as $blog)

                               <li>
                                   <div class="post-img">
                                      <img src="{{ asset('uploads/blog_photos') }}/{{ $blog->blog_photo }}" alt="" class = "w-10 img-fluid" style = "width: 70px; height: 60px;">
                                   </div>
                                   <div class="post-content">
                                       <a href="{{ route('blogdetails' , $blog->slug) }}">{{ $blog->blog_title }}</a>
                                       <p>{{ $blog->created_at->format('d M Y') }}</p>
                                   </div>
                                 </li>
                             @endforeach
                           </ul>
                       </div>
                       <div class="widget widget_tag_cloud">
                           <h4 class="widget-title">Tag Cloud</h4>
                           <div class="tagcloud">
                               <ul class="product-tags">
                                   <li><a href="#">Oil</a></li>
                                   <li><a href="#">Coconut</a></li>
                                   <li><a href="#">olive</a></li>
                                   <li><a href="#">Sunrise</a></li>
                                   <li><a href="#">Pure Honey</a></li>
                                   <li><a href="#">Mustard</a></li>
                                   <li><a href="#">Lorem</a></li>
                                   <li><a href="#">ipsum</a></li>
                                   <li><a href="#">dolor</a></li>
                                   <li><a href="#">sit</a></li>
                                   <li><a href="#">amet</a></li>
                               </ul>
                           </div>
                       </div>
                   </aside>
               </div>
           </div>
       </div>
   </div>
   <!-- blog-details-area end -->
 @endsection
