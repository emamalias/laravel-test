<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
	protected $jsonPath;

	public function __construct() {
		$this->jsonPath = storage_path() . "/app/products.json";
	}

    public function index() {
		$json = json_decode(file_get_contents($this->jsonPath), true); 
		return $json;
    }

    public function new(Request $request) {
		$products = json_decode(file_get_contents($this->jsonPath), true); 

		$dt = \Carbon\Carbon::now();

		$products[] = [
			'id'=>str_random(40),
			'name'=>$request->get('name'),
			'price'=>$request->get('price'),
			'quantity'=>$request->get('quantity'),
			'created'=>$dt->toIso8601String(),
		];

		File::put($this->jsonPath, json_encode($products));
		
		return $products;
    }

    public function delete(Request $request, $id) {
		$products = json_decode(file_get_contents($this->jsonPath), true); 

		$key = array_search($id, array_column($products, 'id'));
		if($key || $key==0) {
			unset($products[$key]);
		}

		File::put($this->jsonPath, json_encode($products));

    	return $products;
    }
}
