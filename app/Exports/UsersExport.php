<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
       return [
           'id', 'name', 'telephone', 'country_id', 'company', 'address', 'city', 'email', '', 'created_at', 'updated_at','other_country_value'
       ];
    }
}
