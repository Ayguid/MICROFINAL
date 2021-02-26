<?php

namespace App\Imports;

use App\Models440\Category;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Sheet implements FromCollection
{
    public function collection(Collection $rows)
    {
        //
    }
}
