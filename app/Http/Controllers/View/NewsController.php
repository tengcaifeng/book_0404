<?php

namespace App\Http\Controllers\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Product;
use App\Entity\Category;

class NewsController extends Controller
{
      public function show(){
          $show_name = Category::where('parent_id','1')->get();
          $product_11 = Product::where('category_id','11')->get();
          $product_12 = Product::where('category_id','12')->get();
          $product_13 = Product::where('category_id','13')->get();
          $product_14 = Product::where('category_id','14')->get();
          $product_15 = Product::where('category_id','15')->get();
          $product_16 = Product::where('category_id','16')->get();
          $product_17 = Product::where('category_id','17')->get();
            return view('cangxi_news')->with('show_name',$show_name)
                ->with('product_11',$product_11)
                ->with('product_12',$product_12)
                ->with('product_13',$product_13)
                ->with('product_14',$product_14)
                ->with('product_15',$product_15)
                ->with('product_16',$product_16)
                ->with('product_17',$product_17);
        }
    public function aboutgy(){
        $about_name = Category::where('parent_id','2')->get();
        $product_21 = Product::where('category_id','21')->get();
        $product_22 = Product::where('category_id','22')->get();
        $product_23 = Product::where('category_id','23')->get();
        return view('about_gy')->with('about_name',$about_name)
                                ->with('product_21',$product_21)
                                ->with('product_22',$product_22)
                                ->with('product_23',$product_23);
    }
}
