<?php

namespace App\Exports;

use App\Models440\Product;
use App\Models440\Category;
use App\Models440\File;
use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

// use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
// use Illuminate\Support\Collection;
// use App\Models440\Product_Attribute;

class ProductsExport implements FromQuery, ShouldAutoSize, WithTitle, WithMapping, WithHeadings
{
    // use Exportable;

    // private $category_id;
    private $masterCat;

    public function __construct($category_id)
    {
      // $this->category_id = $category_id;
      $this->masterCat = Category::find($category_id);
    }

    public function query()
    {
      $catWithProds = Category::query()->where('parent_id', $this->masterCat->id)->pluck('id');
      return Product::query()->whereIn('category_id', $catWithProds );
    }

    public function title(): string
    {
      return $this->masterCat->title_es;
    }

    public function map($product): array
      {
        $attributes = [
            $product->category_id,
            $product->title_es,
            $product->title_en,
            $product->title_pt,
            $product->desc_es,
            $product->desc_en,
            $product->desc_pt,
            $product->product_code
            // $product->files
            // $product->attributes
        ];

        // La unica manera de hacerlo mas rapido sera haciendo un sheet por cada subCategoria?!
        foreach ($this->masterCat->attributes as $attribute) {
          $attributes[] = $product->attributes->where('attribute_id', $attribute->id)->pluck('value_es')->first() ?? null;
        }

        // $this->masterCat->attributes->each(function($attribute, $key) use ($product) {
        //   $attributes[] = $product->attributes->where('attribute_id', $attribute->id)->pluck('value_es')->first() ?? null;
        // });


        // array_push($attributes, File::where('fileable_id', $product->id)->get());
        // array_push($attributes, $product->files->pluck('file_path'));
        // dd($attributes);
        return $attributes;
      }


    public function headings(): array
    {
       $attributes = [
           'category_id', 'title_es', 'title_en', 'title_pt', 'desc_es', 'desc_en', 'desc_pt', 'product_code'
       ];

       // $masterCat = Category::find($this->category_id);

       foreach ($this->masterCat->attributes as $attribute) {
         $attributes[] = $attribute->name_es; // como poner todos los valores en todos los idiomas ??
         // array_push($attributes, $attribute->value_en); // como poner todos los valores en todos los idiomas ??
         // array_push($attributes, $attribute->value_pt); // como poner todos los valores en todos los idiomas ??
       }
       return $attributes;
    }

}
