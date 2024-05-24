<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $image=ProductImage::all();
        return response()->json([
            'status'=>true,
            'data'=>$image,
            'message'=>"list of categories"
        ]);
    }
    public function store(ProductImageRequest $request) {
        $imagePath = $request->file('image')->store('assets', 'public');
    
        $image = ProductImage::create([
            'image' => $imagePath,
            'product_id' => $request->product_id,
        ]);
    
        return response()->json([
            'status' => true,
            'data' => $image,
            'message' => 'Image uploaded successfully',
        ]);
    }

    public function show($id){
        $image=ProductImage::find($id);
            if($image)
            {
                return response()->json([
                    'status'=>true,
                    'data'=>$image,
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
    
    public function destroy($id) {
        $image = ProductImage::find($id);
    
        if (!$image) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => "Product image not found"
            ]);
        }
        
        $imagePath = storage_path('app/public/' . $image->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        $image->delete();
    
        return response()->json([
            'status' => true,
            'data' => null,
            'message' => "Product image deleted successfully"
        ]);
    }
    
}
