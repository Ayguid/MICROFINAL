<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models440\Country;
use DB;

use App\Http\Controllers\Controller;


class CountryController extends Controller
{
  //

  public function showCountryTelephones()
  {
    return view('admin.countries.showCountryTels');
  }


  public function saveTelephones(Request $request)
  {

    return DB::transaction(function () use ($request) {

      $counter = Country::all()->count();
      // dd($counter);
      // $array = [];
      foreach ($request->all() as $countryId => $value) {
        if (is_numeric($countryId)) {
          // code...
          // array_push ( $array , $countryId );
            $country = Country::find($countryId);
            // dd($value);
            $country->telephone = $value;
            $country->save();
            $counter--;
        }
        // if ($country) {
        // }
      }
      if ($counter == 0) {
        $request->session()->flash('alert-success', 'Editaste con exito!');
        return redirect()->back();
      }
      else
      {
        $request->session()->flash('alert-danger', 'Oops there was a problem!');
        return redirect()->back();
      }
      // dd($array);

    });
  }



}
