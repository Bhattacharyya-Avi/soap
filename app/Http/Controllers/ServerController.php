<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SoapServer;
// soap server
$params = [
    'uri' => 'http://soap.test/',
];
$soapServer = new SoapServer(null,$params);
$soapServer->handle();
// end

class ServerController extends Controller
{
    
    public function allProducts()
    {
        $products = Product::all()->toArray();
        // $data = "<pre>".$products."</pre>";
        return $products;
    }
}
