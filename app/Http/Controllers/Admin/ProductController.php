<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\PdtContent;
use App\Entity\pdtImages;
use Illuminate\Http\Request;
use App\Models\M3Result;

class ProductController extends Controller
{

  public function toProduct()
  {
    $products = Product::whereBetween('category_id',[11,17])->orderBy('category_id', 'asc')->get();
    foreach ($products as $product) {
      $product->category = Category::find($product->category_id);
    }

    return view('admin.product')->with('products', $products);
  }

    public function togk()
    {
        $products = Product::whereBetween('category_id',[21,23])->orderBy('category_id', 'asc')->get();
        foreach ($products as $product) {
            $product->category = Category::find($product->category_id);
        }

        return view('admin.gk')->with('products', $products);
    }

  public function toProductInfo(Request $request) {
    $id = $request->input('id', '');

    $product = Product::find($id);
    $product->category = Category::find($product->category_id);

    $pdt_content = PdtContent::where('product_id', $id)->first();


    $pdt_images = PdtImages::where('product_id', $id)->get();



    return view('admin.product_info')->with('product', $product)
                                     ->with('pdt_content', $pdt_content)
                                     ->with('pdt_images', $pdt_images);
  }

  public function toProductAdd() {
    $categories = Category::where('parent_id','=','1')->get();

    return view('admin.product_add')->with('categories', $categories);
  }

    public function togkAdd() {
        $categories = Category::where('parent_id','=','2')->get();
        return view('admin.product_add')->with('categories', $categories);
    }

  public function toProductEdit(Request $request) {
        $id = $request->input('id', '');
        $product = Product::find($id);
        $categories = Category::whereNotNull('parent_id')->get();
        $pdt_content = PdtContent::where('product_id', $id)->first();
        $category_row = Category::where('id',$product->category_id)->first();
        return view('admin/product_edit')->with('product', $product)
                                        ->with('pdt_content',$pdt_content)
                                        ->with('categories',$categories)
                                        ->with('category_row',$category_row);

    }

  /********************Service*********************/
  public function productAdd(Request $request)
  {
    $name = $request->input('name', '');
    $summary = $request->input('summary', '');
    $category_id = $request->input('category_id', '');
    $preview = $request->input('preview', '');
    $content = $request->input('content', '');

    $preview1 = $request->input('preview1', '');
    $preview2 = $request->input('preview2', '');
    $preview3 = $request->input('preview3', '');
    $preview4 = $request->input('preview4', '');
    $preview5 = $request->input('preview5', '');

    $product = new Product;
    $product->summary = $summary;
    $product->category_id = $category_id;
    $product->preview = $preview;
    $product->name = $name;
    $product->save();

    $pdt_content = new PdtContent;
    $pdt_content->product_id = $product->id;
    $pdt_content->content = $content;
    $pdt_content->save();

    if($preview1 != '') {
      $pdt_images = new PdtImages;
      $pdt_images->image_path = $preview1;
      $pdt_images->image_no = 1;
      $pdt_images->product_id = $product->id;
      $pdt_images->save();
    }
    if($preview2 != '') {
      $pdt_images = new PdtImages;
      $pdt_images->image_path = $preview2;
      $pdt_images->image_no = 2;
      $pdt_images->product_id = $product->id;
      $pdt_images->save();
    }
    if($preview3 != '') {
      $pdt_images = new PdtImages;
      $pdt_images->image_path = $preview3;
      $pdt_images->image_no = 3;
      $pdt_images->product_id = $product->id;
      $pdt_images->save();
    }
    if($preview4 != '') {
      $pdt_images = new PdtImages;
      $pdt_images->image_path = $preview4;
      $pdt_images->image_no = 4;
      $pdt_images->product_id = $product->id;
      $pdt_images->save();
    }
    if($preview5 != '') {
      $pdt_images = new PdtImages;
      $pdt_images->image_path = $preview5;
      $pdt_images->image_no = 5;
      $pdt_images->product_id = $product->id;
      $pdt_images->save();
    }

    $m3_result = new M3Result;
    $m3_result->status = 0;
    $m3_result->message = '添加成功';

    return $m3_result->toJson();
  }

    public function productDel(Request $request) {
        $id = $request->input('id', '');
        Product::find($id)->delete();
        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '删除成功';

        return $m3_result->toJson();
    }

    public function productEdit(Request $request) {
        $id = $request->input('id', '');
        $product = Product::find($id);

        $name = $request->input('name', '');
        $summary = $request->input('summary', '');
        $category_id = $request->input('category_id', '');
        $preview = $request->input('preview', '');

        $product->name = $name;
        $product->summary = $summary;
        $product->category_id = $category_id;
        $product->preview = $preview;
        $product->save();

        $PdtContent = PdtContent::where('product_id', $product->id)->first();
        $pdt_content = $request->input('content', '');
        $PdtContent->content = $pdt_content;
        $PdtContent->save();

        $m3_result = new M3Result;
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

}
