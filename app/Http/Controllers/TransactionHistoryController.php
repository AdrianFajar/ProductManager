<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $productCategory = ProductCategory::all();
        return view('transaction.history-transaction', [ 'product_category' => $productCategory ]);
    }

    public function show(Request $request)
    {
        $categoryId = Crypt::decrypt($request->history);
        $category = ProductCategory::where('category_id', $categoryId)->first();
        $transactionHistory = TransactionHistory::where('category_id', $categoryId)->get();

        return view('transaction.history-transaction-detail' , [ 'category' => $category->name, 'history' => $transactionHistory]);
    }
}
