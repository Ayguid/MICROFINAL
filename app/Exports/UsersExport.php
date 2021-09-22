<?php

namespace App\Exports;

use App\User;
use App\Models440\Country;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
      $cty = Country::find($user->country_id);

      $attributes = [
        $user->id,
        $user->name,
        $user->telephone,
        // $user->country_id,
        $cty['country_desc'],
        $user->other_country_value,
        $user->company,
        $user->address,
        $user->city,
        $user->email,
        $user->from_where,
        $user->created_at,
        $user->updated_at

      ];

      return $attributes;
    }

    public function headings(): array
    {
       // return [
       //     'id', 'name', 'telephone', 'country_id', 'company', 'address', 'city', 'email', '', 'created_at', 'updated_at','other_country_value'
       // ];
       return [
           'id', 'Nombre', 'Teléfono', 'País','Otro_país', 'Companía', 'Dirección', 'Ciudad', 'Email', 'Como_contacto', 'Creado_en', 'Actualizado_en'
       ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],
            //
            // // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

}
