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
            <div class="card">
                <div class="card-header">Export</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    DATABASE

                    @role('superadmin|admin')
                    <div class="mb-2">
                      <a class="btn btn-primary" href="{{route('admin.users.export')}}">Export Users</a>
                    </div>
                    {{-- <div class="mb-2">
                      <a class="btn btn-primary" href="#">Export Products</a>
                    </div> --}}

                    @endrole








                </div>
            </div>
        </div>
    </div>


  </div>
@endsection
