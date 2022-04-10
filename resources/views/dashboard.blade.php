@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <img src="{{ asset('material')}}/img/dash.jpg" alt="Dashboard" style="width: 100%">
      </div>
    </div>
  </div>
@endsection
