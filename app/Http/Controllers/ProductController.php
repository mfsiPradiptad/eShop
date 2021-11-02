<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\AddProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public  $productService;

    public function __construct()
    {
        $this->productService = new AddProductService();
    }

    public function upload(Request $request)
    {
        $data = (array) $request->all();
        $result = $this->productService->uploadProduct($data);
        $product = $result['product'];
        $msg = $result['msg'];
        return view('admin.addProduct', ['data' => $product, 'msg' => $msg]);
    }
    public function product()
    {
        $result = $this->productService->getAllProduct();
        return view('admin.productList', ['data' => $result]);
    }
    public function productId($id = '')
    {
        $product = $this->productService->getProduct($id);
        return view('admin.addProduct',
        [
            'data' => $product,
             'msg' => ''
        ]);
    }
}