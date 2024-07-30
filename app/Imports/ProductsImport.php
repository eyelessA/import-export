<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row): ?Model
    {
        return Product::query()->updateOrCreate(
            [
                'external_code' => $row['vnesnii_kod']
            ],
            [
                'name' => $row['naimenovanie'],
                'description' => $row['opisanie'],
                'price' => $row['cena_cena_prodazi'],
                'discount' => $row['zapretit_skidki_pri_prodaze_v_roznicu'],
            ]
        );
    }
}
