<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request,Category $category = null,Category $subcategory = null)
    {
        $array_category = [1];
        if($subcategory){

            $array_category = $subcategory->getAllChildren()->pluck('id')->toArray();

            array_push($array_category, $subcategory->id);
        }
        else if($category){
            $array_category = $category->getAllChildren()->pluck('products');

            array_push($array_category, $category->id);
        }

        $products = Product::whereIn('category_id',$array_category)->get();
        if($request->input('price') == 'asc'){
            return $products->sortBy('price');
        }
        else if($request->input('price') == 'desc'){
            return $products->sortByDesc('price');
        }
        return $products;
    }
}
