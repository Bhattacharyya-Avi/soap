<?php

namespace App\Service;

class ProductService{

    public $soapClient;

    public function __construct()
    {
        
        $this->soapClient = new \SoapClient("http://example.com/weather-api?wsdl");
    }

    public function getWeather($city)
    {
        $response = $this->soapClient->getWeather(['city' => $city]);
        return $response->getWeatherResult;
    }
}