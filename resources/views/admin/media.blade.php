@extends('layouts.app')

@section('content')

  <div class="container">
    @if(Session::has('alert-success'))
      <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>{!! session('alert-success') !!}</strong></div>
    @endif
    @if(Session::has('alert-danger'))
      <div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> <strong>{!! session('alert-danger') !!}</strong></div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
          <a href="{{route('home')}}" class="btn btn-primary col-2 mb-2">Home</a>

    <drop-zone :data="false"></drop-zone>




  </div>
@endsection
