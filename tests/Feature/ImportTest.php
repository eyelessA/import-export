<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Imports\ProductsImport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_is_there_an_excel_file()
    {
        $filePath = storage_path('app/public/import example.xlsx');
        $this->assertFileExists($filePath);
    }

    /** @test */
    public function does_the_product_exist(): void
    {
        $filePath = storage_path('app/public/import example.xlsx');
        $expectedData = [
            'external_code' => '3UHfAid1jaMiwgBuNvnsf3',
            'name' => 'Бермуды мужские, Grigio/Verde, OMSA, 46(M), РОССИЯ',
            'description' => 'Мужские трикотажные домашние бермуды. Легкие, мягкие, дышащие и очень удобные. Универсальная длина ниже колена, пояс на эластичной ленте и карманы создают дополнительный комфорт.Отличный вариант для дома и отдыха. Бермуды стильно смотрятся благодаря эффектному рисунку и позволяют создать эффектный мужской образ.  Производство РОССИЯ',
            'price' => '1320,00',
            'discount' => 'нет',
        ];

        $this->assertFileExists($filePath);

        Storage::fake('public');
        Storage::disk('public')->put('import example.xlsx', file_get_contents($filePath));

        Excel::import(new ProductsImport(), Storage::disk('public')->path('import example.xlsx'));

        $product = Product::query()->where('external_code', $expectedData['external_code'])->first();

        $this->assertEquals($expectedData['name'], $product->name);
        $this->assertEquals($expectedData['description'], $product->description);
        $this->assertEquals($expectedData['price'], $product->price);
        $this->assertEquals($expectedData['discount'], $product->discount);
    }
}
