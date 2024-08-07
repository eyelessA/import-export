<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductResource;
use App\Imports\AdditionalFieldsImport;
use App\Imports\ImagesImport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $products = Product::all();
        $products = ProductResource::collection($products)->resolve();
        return inertia('Index', compact('products'));
    }

    public function show(Product $product): Response|ResponseFactory
    {
        $productImage = $product->images;
        $product = ProductResource::make($product);
        return Inertia('Show', compact('product', 'productImage'));
    }

    public function import(): Application|Redirector|RedirectResponse
    {
        Excel::import(new ProductsImport(), 'public/import example.xlsx');
        Excel::import(new ImagesImport(), Storage::disk('public')->path('import example.xlsx'));
        Excel::import(new AdditionalFieldsImport(), 'public/import example.xlsx');

        return redirect('/products');
    }
}
