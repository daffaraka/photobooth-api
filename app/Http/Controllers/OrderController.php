<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pay()
    {
        $data['biaya'] = Biaya::first();
        return view('frontend.beranda',$data);
    }
}
