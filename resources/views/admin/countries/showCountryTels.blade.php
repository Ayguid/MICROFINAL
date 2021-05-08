@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <a href="{{route('home')}}" class="btn btn-primary col-2 mb-2">Home</a>
        <div class="card">
          <div class="card-header">Tels</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            @if(session('alert-success'))
              <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>{!! session('alert-success') !!}</strong></div>
            @endif
            @if(session('alert-danger'))
              <div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> <strong>{!! session('alert-danger') !!}</strong></div>
            @endif


            <form class="mt-2" action="{{route('admin.saveCountryPhones')}}" method="post">
              {{ csrf_field() }}



              <div class="form-group row">
                {{-- @foreach ($translations['en'] as $key => $data)
                   <div class="col-md-6">
                     <label for="Atributo">{{$key}}</label>
                     <input autofocus class="form-control" type="text" name="{{$key}}[en]" value="{{$data}}" placeholder="Ingles">
                     <input autofocus class="form-control" type="text" name="{{$key}}[pt]" value="{{$translations['pt'][$key]}}" placeholder="Portugues">
                   </div>
                @endforeach --}}
                @foreach (App\Models440\Country::all() as $country)
                  <div class="links pb-4 col-12 col-md-6 col-lg-4">
                    {{$country->country_desc}}
                    <input autofocus class="form-control" type="tel" name="{{$country->id}}" value="{{$country->telephone}}" placeholder="Tel">
                    {{-- {{$country->country_desc}} --}}
                  </div>
                @endforeach
              </div>

            <div class="form-group row">
              <div class="col-md-12">
                <button type="submit" name="button" class="btn btn-primary">
                  Guardar
                </button>
              </div>
            </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
