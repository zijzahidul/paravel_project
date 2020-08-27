@extends('layouts.dashboard_app')
@section('page_title')
    {{ ('Paravel | Dashboard ') }}
@endsection
@section('home')
  active
@endsection

@section('dashboard_content')

 <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Dashboard </h5>
        <p>This is a Dashboard Page</p>

        <h2>
          @if (Auth::user()->role == 1)
            Your Are Admin
          @else
            Your Are Customer
          @endif
        </h2>
      </div><!-- sl-page-title -->

      <div class="container">
       <div class="row justify-content-center">
         
         <div class="col-lg-12 mb-3">
           @if(session()->has('success_status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session()->get('success_status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <div class="card">
              <div class="card-header">
                <h2> All Subscribers</h2>
                <a href="{{ url('send/newsletter') }}" class = "btn btn-info">Send Newsletter to {{ $total_users }} Users</a>
              </div>
              <div class="card-body">


              </div>
            </div>
          </div>

         <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                Dashboard
                <h2>Total Users : {{ $total_users }}</h2>
              </div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <th>{{ $user->id}}</th>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->created_at}}</td>
                      </tr>
                     @endforeach

                    </tbody>
                  </table>


                 </div>
             </div>
          </div>
       </div>
      </div>

    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
 <!-- ########## END: MAIN PANEL ########## -->
@endsection
