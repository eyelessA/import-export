<?php

namespace App\Imports;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImagesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row): ?Model
    {

        $productCode = $row['vnesnii_kod'];
        $photoLinks = explode(',', $row['dop_pole_ssylki_na_foto']);
        $photo = '';

        foreach ($photoLinks as $photoLink) {
            $photo = '';
            $photo = $photoLink;
        }


        $product = Product::query()->where('external_code', $productCode)->first();


        return Image::query()->updateOrCreate(
            [
                'link' => $photo,
            ],
            [
                'product_id' => $product->id,
            ]
        );
    }
}
