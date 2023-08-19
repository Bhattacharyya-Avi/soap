<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use SoapClient;

class ClientController extends Controller
{
    private $soap_instant;
    protected $soapWrapper;
    public function __construct(SoapWrapper $soapWrapper)
    {
        // $params = [
        //     'location' => 'http://soap.test',
        //     'uri' => 'http://soap.test/allProducts',
        //     'trace' => 1,
        // ];
        // $this->soap_instant = new SoapClient(null, $params);

        $this->soapWrapper = $soapWrapper;
        // dd($this->soapWrapper);
    }

    public function productList()
    {       
        try {
            // $products = $this->soap_instant->allProducts();
            // dd($products);
            // echo "<pre>";
            // print_r($products);
            // echo "</pre>";

            $this->soapWrapper->add('products',function($service){
                $service 
                // ->wsdl('http://soap.test/api/allProducts')
                ->trace(true);
            });
            // dd($this->soapWrapper);
            $result = $this->soapWrapper->call('products.allProducts');
            dd($result);
            dd($this->soapWrapper,$result);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}
