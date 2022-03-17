<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->productService->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->productService->update($request, $id);
    }

    public function getAllProducts()
    {
        return $this->productService->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productService->getProductById($id);
    }

    public function destroy($id)
    {
        $this->productService->destroy($id);
    }
}
