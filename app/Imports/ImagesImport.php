<?php

namespace App\Imports;

use App\Jobs\SaveImage;
use App\Models\Image;
use App\Models\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class ImagesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return array
     * @throws Throwable
     */
    public function model(array $row): array
    {
        $client = new Client();

        $product = Product::query()->where('external_code', $row['vnesnii_kod'])->first();
        $photoLinks = explode(',', $row['dop_pole_ssylki_na_foto']);

        $photos = [];
        $promises = [];

        foreach ($photoLinks as $photoLink) {
            $photoLink = trim($photoLink);

            if (!(Image::query()->where('product_id', $product->id)->where('public_path', $photoLink)->exists())) {

                $imageName = explode('/', $photoLink);
                $lastElement = end($imageName);
                $localPath = 'images/' . $lastElement;

                $photos[] = Image::query()->updateOrCreate([
                    'product_id' => $product->id,
                    'public_path' => config('app.url') . 'storage/' . $localPath,
                    'local_path' => $localPath,
                ]);

                SaveImage::dispatch($photoLink, $localPath);
            }
        }
        return $photos;
    }
}
