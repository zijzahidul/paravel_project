@extends('layouts.dashboard_app')

@section('page_title')
{{ ('Paravel | Banner Add') }}
@endsection

@section('banner')
active
@endsection

@section('dashboard_content')

<!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
   <nav class="breadcrumb sl-breadcrumb">
     <a class="breadcrumb-item" href="index.html">Starlight</a>
     <a class="breadcrumb-item" href="index.html">Pages</a>
     <span class="breadcrumb-item active">Blank Page</span>
   </nav>

   <div class="sl-pagebody">
     <div class="sl-page-title">
       <h5>Blank Page</h5>
       <p>This is a Dynamic Place</p>
     </div><!-- sl-page-title -->


   </div><!-- sl-pagebody -->
 </div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection
