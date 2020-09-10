<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'uom', 'price', 'photo', 'promotion_price', 'product_type',
    ];
    public function newProduct()
    {
        $newproduct = DB::table('products')->orderByDesc('id', 'DESC')->get()->take(8);
        // dd($newproduct);
        return ($newproduct);
    }
    public function topProduct()
    {
        $count = DB::table('products')->count();
        // dd($count);
        $topProduct = DB::table('products')->orderBy('id', 'ASC')->get()->take($count - 8);
        return ($topProduct);
    }
}