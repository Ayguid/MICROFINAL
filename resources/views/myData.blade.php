@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
                    <a href="{{route('home')}}" class="btn btn-primary col-2 mb-2">Home</a>
        <h4>{{__('messages.datos')}}</h4>

        {{-- {{$data}} --}}
        @if(session('alert-success'))
          <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i> <strong>{!! session('alert-success') !!}</strong></div>
        @endif
        @if(session('alert-danger'))
          <div class="alert alert-danger"><i class="fa fa-times" aria-hidden="true"></i> <strong>{!! session('alert-danger') !!}</strong></div>
        @endif



        <form  method="POST" action="{{route('updateMyData')}}">
          @csrf

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}" required autocomplete="name" autofocus>

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>


            <div class="form-group row">
                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                <div class="col-md-6">
                    <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ $data->telephone }}" autocomplete="telephone" autofocus>

                    @error('telephone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                <div class="col-md-6">
                    {{-- <input id="country_id" type="text" class="form-control @error('country_id') is-invalid @enderror" name="country_id" value="{{ old('country_id') }}" autocomplete="country_id" autofocus>

                    @error('country_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror --}}
                    {{-- {{$data}} --}}
                    <select id="country_id" class="form-control" name="country_id">
                      @foreach (App\Models440\Country::all() as $country)
                        <option value="{{$country->id}}" {{($data->country_id == $country->id)?'selected':''}}>{{$country->country_desc}}</option>
                      @endforeach
                      <option value="" {{(!$data->country_id)?'selected':''}}>{{__('* Other')}}</option>
                    </select>
                </div>
            </div>
            <div id="other_country" class="{{(!$data->other_country_value)?'hidden':''}} form-group row">
              <label for="other_country" class="col-md-4 col-form-label text-md-right">{{ __('* Other country') }}</label>
              <div class="col-md-6">
                <input id="other_country_value" type="text" class="form-control @error('other_country') is-invalid @enderror" name="other_country_value" value="{{($data->other_country_value)?$data->other_country_value:''}}" autocomplete="other_country" autofocus>
                  <register-country-validator/>
              </div>
            </div>

            <div class="form-group row">
                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                <div class="col-md-6">
                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ $data->company }}" autocomplete="company" autofocus>

                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $data->address }}" autocomplete="address" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                <div class="col-md-6">
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $data->city }}" autocomplete="city" autofocus>

                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$data->email}}" required autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>




              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                  <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      {{__('messages.Guardar cambios')}}
                    </button>
                  </div>
                </div>

              </form>



            </div>
          </div>
        </div>



      @endsection
