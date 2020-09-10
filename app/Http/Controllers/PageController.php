<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\ProductType;
class PageController extends Controller
{
    public function getIndex()
    {
        $productTypes = ProductType::all();
        return view('layouts.master',compact('productTypes'));
    }
}
