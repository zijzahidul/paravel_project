<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>@yield('page_title', 'Dashboard')</title>

    <!-- vendor css -->
    <link href="{{ asset('dashboard_asset') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('dashboard_asset') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="{{ asset('dashboard_asset') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">

    <!-- dataTables -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard_asset') }}/css/starlight.css">

  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> {{ env('APP_NAME') }}</a></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Navigation</label>
      <div class="sl-sideleft-menu">
        <a href="{{ url('/') }}" class="sl-menu-link" target="_blank">
          <div class="sl-menu-item">
            <i class="fa fa-firefox"></i>
            <span class="menu-item-label">View WebPage</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        @if (Auth::user()->role == 1)
          <a href="{{ url('home') }}" class="sl-menu-link @yield('home')">
            <div class="sl-menu-item">
              <i class="fa fa-tachometer"></i>
              <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('order.index') }}" class="sl-menu-link @yield('order')">
            <div class="sl-menu-item">
              <i class="fa fa-tachometer"></i>
              <span class="menu-item-label">Order</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('banner.index') }}" class="sl-menu-link @yield('banner')">
            <div class="sl-menu-item">
              <i class="fa fa-sliders"></i>
              <span class="menu-item-label">Banner Add</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ url('admin/category/add') }}" class="sl-menu-link @yield('category')">
            <div class="sl-menu-item">
              <i class="fa fa-creative-commons"></i>
              <span class="menu-item-label">Category Add</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('product.index') }}" class="sl-menu-link @yield('product')">
            <div class="sl-menu-item">
              <i class="fa fa-product-hunt"></i>
              <span class="menu-item-label">Product Add</span>
              <span class="badge badge-danger"> {{ total_alert_products() }} </span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('testmonial.index') }}" class="sl-menu-link @yield('testmonial')">
            <div class="sl-menu-item">
              <i class="fa fa-commenting-o"></i>
              <span class="menu-item-label">Testmonial Add</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('faq.index') }}" class="sl-menu-link @yield('faq')">
            <div class="sl-menu-item">
              <i class="fa fa-question-circle-o"></i>
              <span class="menu-item-label">Faq's Add</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('customerinfo.index') }}" class="sl-menu-link @yield('customer')">
            <div class="sl-menu-item">
              <i class="fa fa-users"></i>
              <span class="menu-item-label">Customerinfo View</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('customerEmail.index') }}" class="sl-menu-link @yield('subscribe')">
            <div class="sl-menu-item">
              <i class="fa fa-envelope"></i>
              <span class="menu-item-label">Subscribe View</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="{{ route('coupon.index') }}" class="sl-menu-link @yield('coupon')">
            <div class="sl-menu-item">
              <i class="fa fa-copyright"></i>
              <span class="menu-item-label">Coupon View</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->

          <a href="#" class="sl-menu-link @yield('blog')">
            <div class="sl-menu-item">
              <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
              <span class="menu-item-label">Blog</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Blog Add</a></li>
            <li class="nav-item"><a href="chart-morris.html" class="nav-link">Blog Details</a></li>
          </ul>
        @else
          <a href="{{ url('customer/home') }}" class="sl-menu-link @yield('customerhome')">
            <div class="sl-menu-item">
              <i class="fa fa-tachometer"></i>
              <span class="menu-item-label">Customer Home</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
        @endif
        <a href="{{ url('profile/index') }}" class="sl-menu-link @yield('profile')">
          <div class="sl-menu-item">
            <i class="icon ion-ios-person-outline"></i>
            <span class="menu-item-label">Edit Profile</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="icon ion-power"></i>
            <span class="menu-item-label">Logout</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

      </div><!-- sl-sideleft-menu -->
      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->name }}</span>
              <img src="{{ asset('uploads/profile_photos') }}/{{ Auth::user()->profile_image }}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li>
                  <a href="{{ url('profile/index') }}"><i class="icon ion-ios-person-outline"></i> Edit Profile</a>
                </li>

                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>



              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link">
              <div class="media">
                <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                  <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
                  <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
          </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                  <span class="tx-12">October 03, 2017 8:45am</span>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->
          </div><!-- media-list -->
        </div><!-- #notifications -->

      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

      @yield('dashboard_content')

    <script src="{{ asset('dashboard_asset') }}/lib/jquery/jquery.js"></script>
    <script src="{{ asset('dashboard_asset') }}/lib/popper.js/popper.js"></script>
    <script src="{{ asset('dashboard_asset') }}/lib/bootstrap/bootstrap.js"></script>
    <script src="{{ asset('dashboard_asset') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>

    <script src="{{ asset('dashboard_asset') }}/js/starlight.js"></script>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    @yield('footer_scripts')


  </body>
</html>
