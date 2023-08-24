<?php

namespace App\Http\Controllers;

use SoapClient;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;
use Artisaninweb\SoapWrapper\SoapWrapper;

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
            // dd($this->soap_instant);
            // $products = $this->soap_instant->allProducts();
            // dd($products);
            // echo "<pre>";
            // print_r($products);
            // echo "</pre>";

            // $this->soapWrapper->add('products',function($service){
            //     $service 
            //     ->wsdl('http://soap.test/api/allProducts')
            //     ->trace(true);
            // });
            // dd($this->soapWrapper);
            // $result = $this->soapWrapper->call('products.allProducts');
            // dd($result);
            // dd($this->soapWrapper,$result);
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
        }
    }

    public function fetchProductDetails(Request $request)
    {
        // get attribute value
        $requestAttribute = $request->getContent();
        $attributeVal = $this->getFunctionNameAndAttribute($requestAttribute);
        // $url = 'http://localhost:8000/soap-server'; // Change this URL to your SOAP server URL
        $url = 'http://soap.test/api/soap-server'; // Change this URL to your SOAP server URL

        $soapClient = new SoapClient(null, [
            'location' => $url,
            'uri' => $request->url(),
            'trace' => 1,
        ]);
        // dd($soapClient);
        $productId = $attributeVal['id']; // The product ID you want to fetch
        // dd($productId);
        $response = $soapClient->getProductDetails($productId);
        // dd($response);
        $demoresult = ArrayToXml::convert($response);
        // dd($demoresult);
        $array = preg_split("/\r\n|\n|\r/", $demoresult); 

        $xmlVersion = $array[0];
        $envelope = '<SOAP-ENV:Envelope  SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" >';
        $header = $attributeVal['header'];
        $body = "<SOAP-ENV:Body>".$attributeVal['functionNameStart'].$array[1].$attributeVal['functionNameEnd']."</SOAP-ENV:Body>";
        $footer = '</SOAP-ENV:Envelope>';

        $responseContent = $xmlVersion . $envelope . $header . $body . $footer;

        return response($responseContent)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    public function getFunctionNameAndAttribute($requestXml)
    {
        // Parse the XML content
        $xml = simplexml_load_string($requestXml);
        // dd((string)$xml->children('SOAP-ENV', true)->Body);
        // Extract function name and attribute value
        $functionName = $xml->children('SOAP-ENV', true)->Body->children()->getName(); 
        $attributeValue = (string)$xml->children('SOAP-ENV', true)->Body->children()->$functionName->id;

        $data = [
            'id' => $attributeValue,
            'header' => '<SOAP-ENV:Header>' . $xml->children('SOAP-ENV', true)->Header . '</SOAP-ENV:Header>',
            'functionNameStart' => "<".$functionName."Response>",
            'functionNameEnd' => "</".$functionName."Response>",
        ];
        return $data;
    }
}
