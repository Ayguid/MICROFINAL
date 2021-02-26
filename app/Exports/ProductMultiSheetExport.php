<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\ProductsExport;
use App\Models440\Category;

class ProductMultiSheetExport implements WithMultipleSheets
{
    // private $categories;
    //
    // public function __construct(array $categories)
    // {
    //   // dd($this->categories);
    //   $this->categories = $categories;
    // }

    public function sheets(): array
    {
      $sheets = [];
      // dd($this->categories);
      // for ($y = 0; $y < count($this->categories); $y++) {
      //     $sheets[] = new ProductsExport($this->categories[$y]);
      // }

      $masterCats = Category::where('parent_id', null)->get();

      // for ($y = 0; $y < count($masterCats); $y++) {
      //     $sheets[] = new ProductsExport();
      // }
      foreach ($masterCats as $cat) {
        $sheets[] = new ProductsExport($cat->id);
      }


      return $sheets;
    }
}
