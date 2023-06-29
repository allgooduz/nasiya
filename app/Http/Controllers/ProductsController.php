<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\Helper;
use App\Product;
use App\SellerCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function products()
    {
        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        $products = Product::where('seller_id', $company->id)->paginate(200);
        $compact = compact('products');

        return view('merchant.products', $compact);
    }

    public function product($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        $product_images = '';
        if (!empty($product->api_images)) {
            $product_images = json_decode($product->api_images, true);
        }
        $compact = compact('product', 'categories', 'product_images');

        return view('merchant.product', $compact);
    }

    public function add_product()
    {
        return view("merchant.add_product");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'in_stock' => 'required'
        ]);

        Product::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'sku' => $request->sku,
            'in_stock' => $request->in_stock
        ]);

        $product = Product::find($id);

        if (!empty($request->images)) {
            $images = $request->file('images');
            $paths = $this->storeImages($images);
            $product->api_images = json_encode($paths);
            $product->save();

            // $this->sendPostRequestImages($id);
        };

        return redirect()->back();
    }

    public function storeImages($images)
    {
        $paths = [];

        foreach ($images as $image) {
            $path = $image->store('public/products');
            $path = str_replace("public", '', $path);
            // $path = "https://merchant.allgood.uz/storage".$path;
            $path = "http://allgoodmarketplace/storage".$path;
            array_push($paths, $path);
        }

        return $paths;
    }

    public function excelProducts(Request $request)
    {
        $request->validate([
            'products' => 'required|mimes:xlsx',
        ]);

        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getBearer()
        ];

        $photo = fopen($request->products, 'r');
        $response = Http::withHeaders($headers)->attach('products', $photo)->post('https://allgood.uz/api/merchant/upload/products/'.$company->id);

        $response = $response->json();

        return redirect()->back();
    }

    public function excelgetProductsget(Request $request)
    {
        $user = Auth::user();
        $company = SellerCompany::where('owner_id', $user->id)->first();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getBearer()
        ];

        $response = Http::withHeaders($headers)->post('https://allgood.uz/api/merchant/export/products');

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="test.xlsx"');
        header('Content-Length: ' . strlen($response->body()));
        header('Pragma: public');
        echo $response->body();
        exit();

        /*
        $response = Http::withHeaders($headers)->post('https://allgood.uz/api/merchant/export/products');
        $response = $response->json();
        */

        return dd($response);
    }

    public function getBearer()
    {
        if (!empty(Session::get('bearerToken'))) {
            $bearer_token = Session::get('bearerToken');
        } else {
            return redirect()->route('finance');
        }

        return $bearer_token;
    }

    public function sendPostRequestImages($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Retrieve the paths of the images
        $paths = json_decode($product->api_images, true);

        // Send a POST request to another website with the image paths
        $response = Http::post('https://allgood.uz/api/upload/images/'.$id, [
            'images' => $paths
        ]);

        // Return the response from the other website
        dd($response->body());
    }

    public function delete(Request $request)
    {
        $ids = request('check');
        Product::whereIn('id', $ids)->delete();

        return redirect()->back();
    }

    public function updateActive(Request $request)
    {
        $ids = request('check');

        Product::whereIn('id', $ids)->update([
            'is_active_from_seller' => 1
        ]);

        return redirect()->back();
    }

    public function updateUnactive(Request $request)
    {
        $ids = request('check');

        Product::whereIn('id', $ids)->update([
            'is_active_from_seller' => 2
        ]);

        return redirect()->back();
    }
}
