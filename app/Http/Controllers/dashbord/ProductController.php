<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashbord\ProductStoreRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('closing_at')->paginate(20);
        return view('dashbord.products.index', compact('products'));
    }
    public function orders()
    {
        $orders =  Order::with('user')->withCount('products as product')->paginate(20);
        return view('dashbord.products.orders', compact('orders'));
    }
    public function create()
    {
        $categories =  ProductCategories::all();

        return view('dashbord.products.create', compact('categories'));
    }
    public function store(ProductStoreRequest $request)
    {

        $folder  = uniqid() . '_' . now()->timestamp;
        $productImageSource = Storage::getDriver()->getAdapter()->applyPathPrefix(explode('||', $request->image)[0]);
        $awardImageSource = Storage::getDriver()->getAdapter()->applyPathPrefix(explode('||', $request->award_image)[0]);
        $path_dest = Storage::getDriver()->getAdapter()->applyPathPrefix('public/images/products/' . $folder);

        File::move($productImageSource, $path_dest);
        File::move($awardImageSource, $path_dest);

        Product::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "image"   => 'storage/images/products/' . $folder . explode('||', $request->image)[1],
            "award_image"   => 'storage/images/products/' . $folder . explode('||', $request->award_image)[1],
            "description_en" => $request->description_en,
            "description_ar" => $request->description_ar,
            "product_category_id" => $request->category_id,
            "award_name_en" => $request->award_name_en,
            "award_name_ar" => $request->award_name_ar,
            "award_description_en" => $request->award_description_en,
            "award_description_ar" => $request->award_description_ar,
            "quantity" => $request->quantity,
            "coupon_per_unit" => $request->coupon_per_unit,
            "price"   => $request->price,
            "closing_at"   => $request->closing_at,
        ]);

        return redirect()->route('dashbord.products.index')->with('created', __('the product was created'));
    }

    public function edit($id)
    {
        $product   =  Product::findOrFail($id);
        $categories =  ProductCategories::all();

        return view('dashbord.products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $product =  Product::findOrFail($id);
        $product->update([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "description_en" => $request->description_en,
            "description_ar" => $request->description_ar,
            "award_name_en" => $request->award_name_en,
            "award_name_ar" => $request->award_name_ar,
            "award_description_en" => $request->award_description_en,
            "award_description_ar" => $request->award_description_ar,
            "product_category_id" => $request->category_id,
            "quantity" => $request->quantity,
            "coupon_per_unit" => $request->coupon_per_unit,
            "price"   => $request->price,
            "closing_at"   => $request->closing_at,
        ]);


        return redirect()->route('dashbord.products.index')->with('updated', __('the product was updated'));
    }
}
