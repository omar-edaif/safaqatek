<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('closing_at')->paginate(20);
        return view('dashbord.products.index', compact('products'));
    }
    public function orders()
    {
        $orders =  Order::with('user')->withCount('products as product')->paginate(20);
        return view('dashbord.products.orders', compact('orders'));
    }
}
