<?php

namespace App\Exports;

use App\Models440\Product;
use App\Models440\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithMapping;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\WithMultipleSheets;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsExport implements FromCollection, ShouldAutoSize, WithTitle
{
    private $category_id;

    public function __construct($category_id)
    {
      $this->category_id = $category_id;
    }

    public function collection()
    {
        $catWithProds = Category::where('parent_id',$this->category_id)->get();
        $array = [];
        foreach ($catWithProds as $cat) {
          array_push($array, $cat->products);
        }
        return collect($array);

    }

    public function title(): string
    {
      return Category::find($this->category_id)->title_es;
    }

    // public function map($product): array
    //   {
    //       return [
    //           $product->category_id,
    //           $product->title_es,
    //           $product->title_en,
    //           $product->title_pt,
    //           $product->desc_es,
    //           $product->desc_en,
    //           $product->desc_pt,
    //           $product->product_code,
    //           $product->attributes
    //       ];
    //   }

    // public function headings(): array
    // {
    //    return [
    //        'id', 'name', 'telephone', 'country_id', 'company', 'address', 'city', 'email', '', 'created_at', 'updated_at','other_country_value'
    //    ];
    // }
}
