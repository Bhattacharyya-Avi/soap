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
        $products = Product::all();
        $data = "<pre>".$products."</pre>";
        return $data;

        // $params = [
        //     'uri' => 'http://soap.test/',
        // ];
        // $soapServer = new SoapServer(null,$params);
        // $soapServer->handle();
        //         $params = array('uri' => 'http://localhost/soap/server.php');
        // $soapServer = new SoapServer(null, $params);
        // $soapServer->setClass('server');
        // $soapServer->handle();
    }
}
