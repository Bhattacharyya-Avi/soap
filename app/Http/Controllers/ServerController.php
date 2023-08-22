<?php

namespace App\Http\Controllers;

use SoapServer;
use SimpleXMLElement;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Service\ProductService;
use Spatie\ArrayToXml\ArrayToXml;
// soap server
// $params = [
//     'uri' => 'http://soap.test/api/',
// ];
// $soapServer = new SoapServer(null,$params);
// $soapServer->handle();
// end

class ServerController extends Controller
{
    
    // public function allProducts()
    // {
    //     $products = Product::select('name','price')->get()->toArray();
    //     // dd($products);
    //     $dataArray = [];
    //     foreach ($products as $key => $value) {
    //         // dd($key,$value);
    //         $arrayKey = "array".$key;
    //         $dataArray[$arrayKey] = $value;
    //     }
    //     // dd($dataArray);
    //     $demoresult = ArrayToXml::convert($dataArray);
    //     // dd($demoresult);

    //     // $xml = new SimpleXMLElement('<root/>'); 
    //     // array_walk_recursive($products, array ($xml, 'addChild'));
    //     // $result =  $xml->asXML();
    //     // dd($result);

    //     // dd($result);
    //     // $data = "<pre>".$result."</pre>";
    //     return $demoresult;
    // }

    // public function productDetails($id)
    // {
    //     $product = Product::where('id',$id)->get()->toArray();
    //     // dd($product);
    //     $demoresult = ArrayToXml::convert($product);
    // }

    public function handleSoapRequest(Request $request)
    {
        try {
            $soapServer = new SoapServer(null, [
                'uri' => $request->url(),
            ]);
    
            $soapServer->setClass(ProductService::class);
            $soapServer->handle();
        } catch (\Throwable $th) {
            dd($th->getMessage(),$th->getLine());
        }
        
       
    }
}
