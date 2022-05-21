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
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderByDesc('closing_at')
            ->withCount('inOrders as sold_out')
            ->where(function ($query) use ($request) {
                if (!$request->input('search')) return $query;

                return $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('award_name_en', 'like', '%' . $request->input('search') . '%');
            })
            ->paginate(20);
        return view('dashbord.products.index', compact('products'));
    }
    public function orders()
    {
        $orders =  Order::with('user')->withCount('products as product')->latest()->paginate(20);
        return view('dashbord.products.orders', compact('orders'));
    }
    public function create()
    {
        $categories =  ProductCategories::all();

        return view('dashbord.products.create', compact('categories'));
    }
    public function store(ProductStoreRequest $request)
    {

        $productImageTmpPath = explode('||', $request->image)[0];
        $awardImageTmpPath = explode('||', $request->award_image)[0];
        $productImageName = explode('||', $request->image)[1];
        $awardImageName = explode('||', $request->award_image)[1];
        $productImageSource = Storage::getDriver()->getAdapter()->applyPathPrefix($productImageTmpPath);
        $awardImageSource = Storage::getDriver()->getAdapter()->applyPathPrefix($awardImageTmpPath);

        Product::create([
            "name_en" => $request->name_en,
            "name_ar" => $request->name_ar,
            "image"   => str_replace('public', 'storage', Storage::putFile('public/images/products', $productImageSource . $productImageName)),
            "award_image"   => str_replace('public', 'storage', Storage::putFile('public/images/products', $awardImageSource . $awardImageName)),
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
    public function update(Request $request)
    {

        $product = Product::findOrFail($request->route('id'));
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



        if ($request->input('image')) {

            $productImageTmpPath = explode('||', $request->image)[0];

            $productImageName = explode('||', $request->image)[1];

            $productImageSource = Storage::getDriver()->getAdapter()->applyPathPrefix($productImageTmpPath);

            $product->image =   str_replace('public', 'storage', Storage::putFile('public/images/products', $productImageSource . $productImageName));

            $product->save();
        }

        if ($request->input('award_image')) {


            $awardImageTmpPath = explode('||', $request->award_image)[0];

            $awardImageName = explode('||', $request->award_image)[1];

            $awardImageSource = Storage::getDriver()->getAdapter()->applyPathPrefix($awardImageTmpPath);

            $product->award_image = str_replace('public', 'storage', Storage::putFile('public/images/products', $awardImageSource . $awardImageName));

            $product->save();
        }





        return redirect()->route('dashbord.products.index')->with('updated', __('the product was updated'));
    }
    public function delete($id)
    {
        $product  =  Product::findOrFail($id);

        $product->delete();

        return redirect()->route('dashbord.products.index')->with('deleted', __('the product was deleted'));
    }
}
