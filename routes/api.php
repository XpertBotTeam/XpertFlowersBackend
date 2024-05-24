<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ShoppingCartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);


Route::group(['middleware' => ['auth:sanctum']], function () 
{

    Route::get('/cat/{id}',[CategoryController::class,'show']);
    Route::get('/categories',[CategoryController::class,'index']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    
    Route::group(['middleware' => ['checkOwner']], function () 
    {
        Route::post('/addAddress',[AddressController::class,'CreateAddress']);
        Route::get('/address/{id}',[AddressController::class,'show']);
        Route::delete('/deleteaddress/{id}',[AddressController::class,'destroy']);
        Route::put('/updateAddress/{id}',[AddressController::class,'update']);

        Route::post('/order',[OrderController::class,'store']);
        Route::get('/order/{id}', [OrderController::class, 'show']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/addToCart',[ShoppingCartController::class,'addToCart']);
        Route::delete('/RemoveItemFromCart',[ShoppingCartController::class,'removeFromCart']);
        Route::delete('/clearCart',[ShoppingCartController::class,'clearCart']);
        Route::get('/ShowCart',[ShoppingCartController::class,'show']);
    });
    
  
    Route::get('/image/{id}', [ImageController::class, 'show']);
    Route::get('/images', [ImageController::class, 'index']);

        Route::group(['middleware' => ['isAdmin']], function () 
        {    
            Route::post('/addcat',[CategoryController::class,'addCategory']);
            Route::delete('/deletecat/{id}',[CategoryController::class,'destroy']);
            Route::put('/updatecat/{id}',[CategoryController::class,'update']);

            Route::post('/admin/addProducts', [ProductController::class, 'store']); 
            Route::put('/admin/products/{id}', [ProductController::class, 'update']);
            Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']);

            Route::post('/admin/images',[ImageController::class,'store']);
            Route::delete('/admin/images/{id}', [ImageController::class, 'destroy']);
        });

});



