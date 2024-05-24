<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return response()->json([
            'status'=>true,
            'data'=>$products,
            'message'=>"list of products"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product =Product::create($request->all());
        return response()->json([
            'status'=>true,
            'data'=>$product,
            'message'=>'Product Created Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
            if($product)
            {
                return response()->json([
                    'status'=>true,
                    'data'=>$product,
                    'message'=>'Product information'
                ]);
            }else
            {
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'message'=>'Product not found'
                ]);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,String $id)
    {
        $product =Product::find($id);
        $product=$product->update($request->all());
        return response()->json([
            'status'=>true,
            'data'=>$product,
            'message'=>"Product updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=Product::destroy($id);
        if($result){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'message'=>"Product deleted Successfully"
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'data'=>null,
                'message'=>"Product not found"
            ]);
        }
    }
}
