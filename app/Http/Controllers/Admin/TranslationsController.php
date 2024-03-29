<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\Validator;

class TranslationsController extends Controller
{

  public $paginate = 12;
  public $path = 'storage/lang/translations';

  public function index()
  {

    $contentEN = json_decode(file_get_contents($this->path.'_en.json'), true);
    $collectionEN = new Collection($contentEN['en']);

    $contentPT = json_decode(file_get_contents($this->path.'_pt.json'), true);
    $collectionPT = new Collection($contentPT['pt']);

    $translations = [
      'en' => $collectionEN->paginate($this->paginate),
      'pt' => $collectionPT->paginate($this->paginate)
    ];
    // dd($translations);
    return view('admin.translations')->with('translations', $translations);
    // return response($translations, 200 );
  }



  public function save(Request $request)
  {
    // dd($request->all());
    // $validator =  Validator::make($request->newTranslation, [
    //   'word' => ['required'],
    //   'en' => ['required'],
    //   'pt' => ['required']
    // ]);
    //
    // if ($validator->fails()) {
    //   $request->session()->flash('alert-danger', $validator->errors());
    //   return redirect()->route('admin.translations')->withErrors($validator);
    // }

    $contentEN = json_decode(file_get_contents($this->path.'_en.json'), true);
    $contentPT = json_decode(file_get_contents($this->path.'_pt.json'), true);


    if ($request->newTranslation['word']) { //palabra nueva
      if (array_key_exists($request->newTranslation['word'], $contentEN['en']) || array_key_exists($request->newTranslation['word'], $contentPT['pt'])) {
        $request->session()->flash('alert-danger', 'La palabra ya tiene traducción');
        return redirect()->route('admin.translations');
      }
      $contentEN['en'][$request->newTranslation['word']] = $request->newTranslation['en'];
      $contentPT['pt'][$request->newTranslation['word']] = $request->newTranslation['pt'];
    }


    foreach ($request->all() as $palabra => $array) {  //update palabra
      if($palabra !=="_token" && $palabra !=="newTranslation" && $palabra !=="button"){
        $palabra = str_replace("_"," ",$palabra);
        $contentEN['en'][$palabra] = $array['en'];
        $contentPT['pt'][$palabra] = $array['pt'];
      }
    }
    // dd($contentEN);
    // dd($contentEN['en']['Consultas adicionales']);

    $json_objectEN = json_encode($contentEN);
    file_put_contents($this->path.'_en.json', $json_objectEN);

    $json_objectPT = json_encode($contentPT);
    file_put_contents($this->path.'_pt.json', $json_objectPT);

    $request->session()->flash('alert-success', 'Exito');
    return redirect()->route('admin.translations');
  }



  public function find(Request $request)
  {
    //dd($query);
    $searchword = $request->queryString;
    $contentEN = json_decode(file_get_contents($this->path.'_en.json'), true);
    $contentPT = json_decode(file_get_contents($this->path.'_pt.json'), true);


    $matchesEN = array();
    foreach($contentEN['en'] as $k=>$v) {
      if (stripos(strtolower($k), $searchword) !== false) {
        $matchesEN[$k] = $contentEN['en'][$k];
      }
    }

    $matchesPT = array();
    foreach($contentPT['pt'] as $k=>$v) {
      if (stripos(strtolower($k), $searchword) !== false) {
        $matchesPT[$k] = $contentPT['pt'][$k];
      }
    }
    $collectionEN = new Collection($matchesEN);
    $collectionPT = new Collection($matchesPT);
    // $contentEN = json_decode(file_get_contents($this->path.'_en.json'), true);
    // $contentPT = json_decode(file_get_contents($this->path.'_pt.json'), true);

    // $collectionEN = new Collection($contentEN['en']);
    // $collectionPT = new Collection($contentPT['pt']);

    $translations = [
      'en' => $collectionEN->paginate($this->paginate, null, null, 'page')->appends($request->all()),
      'pt' => $collectionPT->paginate($this->paginate, null, null, 'page')->appends($request->all())
    ];
    //dd($translations);
    return view('admin.translations')->with('translations', $translations);
    //return redirect()->route('admin.translations');

  }



}
