<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function addProduct( Request $request){
        $product = new Product();
        $product -> name = $request->input('name');
        $product -> price = $request->input('price');
        $product -> description = $request->input('description');
        $product -> file_path = $request->file('file')->store('products');
        $product->save();
        return $product;
    }
    function showAllProducts(){
        return Product::all();
    }
    function deleteProduct($id){
        $result = Product::where('id' , $id)->delete();
        if($result){
            return ["result" => "Product has been deleted"];
        }
        else{
            return ["result" => "Operation Failed"];

        }

    }
    function getProduct($id){
        $result= Product::find($id);
        if($result){
            return $result;
        }
        elseif($result==null){
            return ["result" => "This Product Is not Found"];

        }
    }

    function updateProduct(Request $request, $id  )
    {    
        $product = Product::find($id);
        $product-> name= $request->input('name');
        $product-> price= $request->input('price');
        $product->description= $request->input('description');
        if($request->file('file'))
        {
            $product->file_path=$request->file('file')->store('products');
        }
        $product->save();
        return $product;
    }
function Search($key){
    return Product::where('name', 'like', "%$key%")->get();

}

}
