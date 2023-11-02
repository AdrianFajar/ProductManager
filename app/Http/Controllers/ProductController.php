<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category_id = Crypt::decrypt($request->product_category);
        $product = Product::where('category_id', $category_id)->get();
    
        return view('product.product', [ 'product' => $product , 'product_category' => $category_id]);
    }

    public function create(Request $request)
    {
        $category_id = Crypt::decrypt($request->product_category);
        $productCategory = ProductCategory::where('category_id', $category_id)->first();
        
        return view('product.add-product', [ 'product_category' => $request->product_category, 'category' => $productCategory ] );
    }

    public function store(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $category_id = Crypt::decrypt($request->category);
        $name = $request->product_name;
        $description = $request->product_description;
        $stock = $request->stock;
        $imageName = time().'.'.$request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);

        Product::create([
            'name' => $name,
            'description' => $description,
            'stock' => $stock,
            'picture' => $imageName,
            'category_id' => $category_id,
        ]);

        return redirect()->back()->with('message', 'Produk Berhasil Ditambahkan!');
    }

    public function update(Request $request)
    {
        $product_id = Crypt::decrypt($request->product);
        
        $product = Product::find($product_id);
        $product->name = $request->product_name;
        $product->description = $request->product_description;
        $product->stock = $request->stock;

        if($request->hasFile('picture')){
            $destination = 'images/'.$product->picture;
            if(file_exists($destination)){
                unlink($destination);
            }
            $imageName = time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            $product->picture = $imageName;
        }

        $product->update();

        return redirect()->back()->with('message', 'Produk Berhasil Diubah!');
    }

    public function show(Request $request)
    {
        $product_id = Crypt::decrypt($request->product);
        $product = Product::find($product_id);

        return view('product.edit-product', [ 'product' => $product ]);
    }

    public function destroy(Request $request)
    {
        $product_id = Crypt::decrypt($request->product);

        $product = Product::find($product_id);
        $destination = 'images/'.$product->picture;
        unlink($destination);
        Product::destroy($product_id);

        return redirect()->back()->with('message', 'Produk Berhasil Dihapus!');
    }
}