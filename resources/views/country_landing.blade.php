@extends('layouts.app')
@section('content')
  <div class="container">

    {{-- <h3>{{session('country.country_desc')}}</h3> --}}
    {{-- @if (!isset($data['category']))
          <h6 class="p-2">{{Lang::get('messages.welcome')}}</h6>
    @endif --}}

    @php
    $lang=App::getLocale();
    if ($lang == 'Pt-BR') {
      $lang='pt';
    }
    @endphp

    @isset($data['categories'])
      <div class="">
        @include('components.category-menu')
      </div>
      @php
        $country = App\Models440\Country::find(session('country')->id);
      @endphp
      {{-- <a href="https://wa.me/{{$country->telephone}}" class="wassapfloat wassap-hide" target="_blank">
        <i class="fab fa-whatsapp my-wassapfloat"></i>
      </a> --}}
    @endisset


    @isset($data['category'])
      {{-- <h3>{{$data['category']->father-> {'title_' . $lang} ?? $data['category']->father->title_es}}->{{$data['category']-> {'title_' . $lang} ?? $data['category']->title_es}}</h3> --}}
      <products-portfolio
        :country='{!! json_encode(session('country')) !!}'
        :category='{!! json_encode($data['category']) !!}'
      ></products-portfolio>
      @php
        $country = App\Models440\Country::find(session('country')->id);
      @endphp
      {{-- <a href="https://wa.me/{{$country->telephone}}" class="wassapfloat wassap-hide wassapBumpUp" target="_blank">
        <i class="fab fa-whatsapp my-wassapfloat"></i>
      </a> --}}
      <a href="https://web.whatsapp.com/send?phone={{$country->telephone}}" class="wassapfloat wassap-hide wassapBumpUp" target="_blank">
        <i class="fab fa-whatsapp my-wassapfloat"></i>
      </a>
      @else
        <a href="https://web.whatsapp.com/send?phone={{$country->telephone}}" class="wassapfloat wassap-hide" target="_blank">
          <i class="fab fa-whatsapp my-wassapfloat"></i>
        </a>
    @endisset


    @isset($data['products'])
      @if ($data['products']->count() == 0)
        <div class="mt-4">
          <h4>{{__('messages.No products were found')}}</h4>
        </div>
      @endif
      <div class="row">
        @foreach ($data['products'] as $prod)
          <product-component class="col-12 col-md-4 col-lg-3"
          :product='{!! json_encode($prod) !!}'
          :product_route_view='{!! json_encode(route('showProduct', $prod->id)) !!}'
          :cat_route='{!! json_encode(route('getCategoryData', $prod->category)) !!}'>
        </product-component>
        @endforeach
      </div>
      <div class="d-flex justify-content-around">
        {{ $data['products']->appends(request()->except('page'))->links() }}
      </div>
    @endisset
    {{-- @php
      $country = App\Models440\Country::find(session('country')->id);
    @endphp
    <a href="https://wa.me/{{$country->telephone}}" class="wassapfloat wassap-hide" target="_blank">
      <i class="fab fa-whatsapp my-wassapfloat"></i>
    </a> --}}

    </div>
  @endsection
