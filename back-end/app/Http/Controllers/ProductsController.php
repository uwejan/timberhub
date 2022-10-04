<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Products;
use App\Models\Specifications;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Success',
            'data' => Products::all()->sortByDesc("created_at")->values()
        ]);
    }

    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {

        $product = new Products([
            'supplier_id' => $request->supplier_id
        ]);
        $product->save();


        $request->request->remove('supplier_id');
        $request->request->add(['product_id'=>$product->id]);

        $specifications = new Specifications($request->request->all());

        // can also be used instead of $specifications->save()
        //$product->specifications()->save($specifications);
        $specifications->save();

        $product->refresh();
        $product->load('specifications', 'supplier');

        //$product->supplier();

        return response()->json(
            [
                'message' => 'Product saved successfully!',
                'data' => $product,
            ],
            200
        );
    }
}
