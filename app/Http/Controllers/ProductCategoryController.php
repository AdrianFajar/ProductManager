<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('product.category.category');
    }

    public function store(Request $request)
    {
        ProductCategory::create([
            'name' => $request->category_name,
            'description' => $request->category_description,
        ]);

        return redirect()->back()->with('message', 'Category Berhasil Ditambahkan!');
    }

    public function edit(Request $request)
    {
        $id = Crypt::decrypt($request->product_category);
        $product_category = ProductCategory::where('category_id', $id)->first();

        return view('product.category.category-edit', [ 'product_category' => $product_category ]);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->product_category);
        ProductCategory::where('category_id', $id)
        ->update([
            'name' => $request->category_name,
            'description' => $request->category_description,
        ]);

        return redirect()->back()->with('message', 'Category Berhasil Di Ubah!');
    }

    public function destroy(Request $request)
    {
        $id = Crypt::decrypt($request->product_category);
        Product::where('category_id', $id)->delete();
        ProductCategory::where('category_id', $id)->delete();
        
        return redirect()->back()->with('message', 'Category Berhasil Di Hapus!');
    }
}
