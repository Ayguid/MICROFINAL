<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
// use App\Exports\ProductsExport;
use App\Exports\ProductMultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class DataBaseExporter extends Controller
{

    public function index()
    {
      return view('admin.database');
    }

    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportProducts()
    {
        return Excel::download(new ProductMultiSheetExport(), 'products.xlsx');
        // return Excel::download(new ProductMultiSheetExport([1001, 1002]), 'products.xlsx');
    }

}
