<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $product = \App\Models\Product::with('category')->get();
        return response()->json([
            'message'=>'List Product',
            'data'=>$product,
        ]);
    }
    //Fungsi with digunakan untuk melakukan eager loading
    //Eager Loading adalah teknik untuk memuat realasi model yang terkait dengan model utama dalam satu query
    //Dengan eager loading, kita dapat mengurangi jumlah queary yang dieksekusi ke database
    //Kita dapat mengakses data kategori dari setiap produk tanpa melakukan query tambahan
    //Contoh data yang dihasilkan
    // "data": [
    // {
    //   "id": 1,
    //   "name": "Product A",
    //   "category_id": 2,
    //   "category": { ==> sudah didapatkan karena menggunakan with
    //     "id": 2,
    //     "name": "Electronics"
    //   }
    // },
    // ]

}
