<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\EPNProduct;

class EPNController extends Controller
{
    public function getEPNGoods(Request $request, $page) {
        $perPage = 16;
        $offset = ($page - 1) * $perPage;

        $goods = EPNProduct::skip($offset)->take($perPage)->get();

        return response()->json($goods);
    }
}
