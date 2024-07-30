<?php

namespace App\Imports;

use App\Models\AdditionalFields;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AdditionalFieldsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row): ?Model
    {
        $productCode = $row['vnesnii_kod'];

        $product = Product::query()->where('external_code', $productCode)->first();

        return AdditionalFields::query()->updateOrCreate(
            [
                'product_id' => $product->id,
            ],
            [
                'size' => $row['dop_pole_razmer'],
                'color' => $row['dop_pole_cvet'],
                'brand' => $row['dop_pole_brend'],
                'composition' => $row['dop_pole_sostav'],
                'quantity_per_pack' => $row['dop_pole_kol_vo_v_upakovke'],
                'pack_link' => $row['dop_pole_ssylka_na_upakovku'],
                'photo_links' => $row['dop_pole_ssylki_na_foto'],
                'seo_title' => $row['dop_pole_seo_title'],
                'seo_h1' => $row['dop_pole_seo_h1'],
                'seo_description' => $row['dop_pole_seo_description'],
                'product_weight' => $row['dop_pole_ves_tovarag'],
                'width' => $row['dop_pole_sirinamm'],
                'height' => $row['dop_pole_vysotamm'],
                'length' => $row['dop_pole_dlinamm'],
                'package_weight' => $row['dop_pole_ves_upakovkig'],
                'package_width' => $row['dop_pole_sirina_upakovkimm'],
                'package_height' => $row['dop_pole_vysota_upakovkimm'],
                'package_length' => $row['dop_pole_dlina_upakovkimm'],
                'product_category' => $row['dop_pole_kategoriia_tovara'],
            ]
        );
    }
}
