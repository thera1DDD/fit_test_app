<?php

namespace App\Http\Controllers;

use App\DTO\ProductDTO;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index()
    {
        $products = $this->service->getAllProducts();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $category = Category::findOrFail($request->category_id);

        $dto = new ProductDTO(
            null,
            $request->name,
            (object)[
                'id' => $category->id,
                'name' => $category->name
            ],
            $request->description,
            $request->price
        );

        $this->service->createProduct($dto);
        return redirect()->route('products.index');
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $category = Category::findOrFail($request->category_id);

        $dto = new ProductDTO(
            $id,
            $request->name,
            (object)[
                'id' => $category->id,
                'name' => $category->name
            ],
            $request->description,
            $request->price
        );

        $this->service->updateProduct($id, $dto);
        return redirect()->route('products.index');
    }

    public function show(int $id)
    {
        $product = $this->service->getProduct($id);
        abort_if(!$product, 404);
        return view('products.show', ['product' => $product]);
    }

    public function edit(int $id)
    {
        $product = $this->service->getProduct($id);
        $categories = \App\Models\Category::all();

        // Преобразуем DTO в массив с нужной структурой
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'category_id' => $product->category->id, // Доступ к ID категории
            'description' => $product->description,
            'price' => $product->price
        ];

        return view('products.edit', [
            'product' => (object)$productData,
            'categories' => $categories
        ]);
    }


    public function destroy(int $id)
    {
        $this->service->deleteProduct($id);
        return redirect()->route('products.index');
    }
}
