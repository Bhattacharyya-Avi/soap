<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Service\ProductService;
use Artisaninweb\SoapWrapper\SoapWrapper;

class ProductController extends Controller
{
    // public $soapWrapper;
    public $productService;

    // public function __construct(SoapWrapper $soapWrapper)
    // {
    //     $this->soapWrapper=$soapWrapper;
    // }

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $weatherData = $this->productService->getWeather($city);

        return response()->json([
            'weather' => $weatherData,
        ]);
    }

    public function product()
    {
        // Add a new service to the wrapper
            SoapWrapper::add(function ($service) {
                $service
                ->name('currency')
                ->wsdl('path/to/wsdl')
                ->trace(true);
            });
        $data = [
                'user' => 'username',
                'pass'   => 'password',
                ];
        // Using the added service
        SoapWrapper::service('currency', function ($service) use ($data) {
        
        var_dump($service->call('Login', [$data]));
        var_dump($service->call('Otherfunction'));
        });
    }

    public function holidaysOfYear()
    {
        if(!request('year')) {
            die("year required");
        }
        $this->soapWrapper->add('Holidays', function ($service) {
            $service ->wsdl('http://kayaposoft.com/enrico/ws/v2.0/index.php?wsdl')
                     ->trace(true);
        });
        $results = $this->soapWrapper->call('Holidays.getHolidaysForYear', [[
            'year' => request('year')
        ]]);
        dd($results);
        echo "<pre>";
        foreach ($results->holiday as $result) {
            echo "<strong>" . $result->name->text . "</strong>: " . $result->holidayType . "(" . $result->date->day . '/' . $result->date->month . '/' . $result->date->year . ")" . "<br/>";
        }
        echo "</pre>";
    }
}
