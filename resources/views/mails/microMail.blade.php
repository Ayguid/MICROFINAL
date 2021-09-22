@component('mail::message')
Te esta contactando **{{$reply}}**,
 {{-- use double space for line break --}}
Para : @foreach ($toMail as $key => $eachToMail)
  @if ($key==0)
    **{{$eachToMail->email}}**
    @else
      **, {{$eachToMail->email}}**
  @endif
@endforeach

@isset($country)
  **
  Origen web: {{$country->country_desc}}
  **
@endisset

{{-- **{{$product}}** --}}
@isset($product)
@php
  $prod = json_decode($product);
@endphp

**Titulo : {{$prod->title_es}}**

**Descripcion :{{$prod->desc_es}}**


**Codigo : {{$prod->product_code}}**
@endisset



**<p>
  Comentarios:
  {{$textArea}}
</p>**

**<p>
  Datos extras:<br>
  @isset($other_country)
    Otro País: {{$other_country}}<br>
  @endisset
  @isset($city)
    Ciudad: {{$city}}
  @endisset
</p>**


{{-- @component('mail::button', ['url' => $link])
@endcomponent --}}



@endcomponent
