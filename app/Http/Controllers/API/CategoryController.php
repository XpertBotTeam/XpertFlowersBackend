<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Category::all();
        return response()->json([
            'status'=>true,
            'data'=>$category,
            'message'=>"list of categories"
        ]);
    }
    public function show($id)
    {
        $category=Category::find($id);
            if($category)
            {
                return response()->json([
                    'status'=>true,
                    'data'=>$category,
                    'message'=>'Category information'
                ]);
            }else
            {
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'message'=>'Category not found'
                ]);
            }
    }
    public function addCategory(Request $request)
    {
            $category = new Category();
            $category->name = $request->get('name');
            $category->save();

            return response()->json([
                'status' => true,
                'data' => $category,
                'message' => 'Category Created Successfully'
            ]);
    }
    public function update(Request $request,String $id)
    {
        $category =Category::find($id);
        $category=$category->update($request->all());
        return response()->json([
            'status'=>true,
            'data'=>$category,
            'message'=>"Category updated Successfully"
        ]);
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Category not found'
            ]);
        }

        $category->delete();
    
        return response()->json([
            'status' => true,
            'data' => null,
            'message' => 'Category and associated products deleted successfully'
        ]);
    }
}
