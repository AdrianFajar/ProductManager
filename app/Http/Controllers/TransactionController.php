<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function stockIn()
    {
        $product = Product::all();
        return view('transaction.stock-in', [ 'product' => $product ]);
    }

    public function storeStockIn(Request $request)
    {   
        DB::transaction(function() use ($request)
        {
            foreach($request->product as $index => $p){
                $category = Product::where('name', $p)->pluck('category_id')->toArray();
                $product = Product::where('name', $p)->first();
                $product->stock = $product->stock + $request->total[$index];

                $product->update();

                TransactionHistory::create([
                    'category_id' => $category[0],
                    'name' => $p,
                    'total' => $request->total[$index],
                    'type' => "in"
                ]);
            }
        });

        return redirect('history')->with('message', 'Transaksi Berhasil Ditambahkan !');
    }

    public function stockOut()
    {
        $product = Product::all();
        return view('transaction.stock-out', [ 'product' => $product ]);
    }

    public function storeStockOut(Request $request)
    {   
        $result = DB::transaction(function() use ($request)
        {
            foreach($request->product as $index => $p){
                $category = Product::where('name', $p)->pluck('category_id')->toArray();
                $product = Product::where('name', $p)->first();
                $stock = $product->stock - $request->total[$index];
                $product->stock = $stock;
                $product->update();

                TransactionHistory::create([
                    'category_id' => $category[0],
                    'name' => $p,
                    'total' => $request->total[$index],
                    'type' => "out"
                ]);

                if($stock <= 0){
                    DB::rollBack();
                    $result = [ 
                        'status' => 'errors',
                        'message' => 'Transaksi Gagal Ditambahkan, harap cek stock produk '.$p.' !'
                    ];
                    
                    return $result;
                }else {
                    $result =  [ 
                        'status' => 'message',
                        'message' => 'Transaksi Berhasil Ditambahkan !'
                    ];
                }
            }    
            return $result;       
        });
        
        return redirect('history')->with($result["status"], $result["message"]);
    }
}
