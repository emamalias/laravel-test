<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    public function index() {
    	$path = storage_path() . "/app/products.json";
		$json = json_decode(file_get_contents($path), true); 
		return $json;
    }

    public function new(Request $request) {
    	$path = storage_path() . "/app/products.json";
		$products = json_decode(file_get_contents($path), true); 

		$dt = \Carbon\Carbon::now();

		$products[] = [
			'name'=>$request->get('name'),
			'price'=>$request->get('price'),
			'quantity'=>$request->get('quantity'),
			'created'=>$dt->toIso8601String(),
		];

		File::put($path, json_encode($products));
		
		return $products;
    }
}
