<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class PaginationController extends Controller
{

    function fetch_data(Request $request)
    {
        if ($request->ajax())
        {
            $products = Products::paginate(6);

            return view('user.paginate', compact('products'))->render();
        }
    }
}
