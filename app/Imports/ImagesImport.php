<?php

namespace App\Imports;

use App\Models\Image;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImagesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return array
     */
    public function model(array $row): array
    {
        $product = Product::query()->where('external_code', $row['vnesnii_kod'])->first();

        $photoLinks = explode(',', $row['dop_pole_ssylki_na_foto']);
        $photos = [];

        foreach ($photoLinks as $photoLink) {
            if (!Image::query()->where('product_id', $product->id)->where('link', $photoLink)->exists()) {
                $photos[] = Image::query()->create([
                    'product_id' => $product->id,
                    'public_path' => $photoLink,
                ]);
            }
        }

        return $photos;
    }
}
